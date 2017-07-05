<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {
	
	private $token = "COPY_YOUR_API_KEY_HERE";
	private $roles_filtered = ["Lead Link", "Rep Link", "Facilitator", "Secretary"];

	public function index()
	{
		// Create a stream
		$opts = [
		    "http" => [
		        "method" => "GET",
		        "header" => "X-Auth-Token: $this->token\r\n"
		    ]
		];
		
		$context = stream_context_create($opts);
		
		// Open the file using the HTTP headers set above
		$json = file_get_contents('https://api.glassfrog.com/api/v3/roles', false, $context);
		$ola = json_decode($json, true);
		$cercles = array();
		foreach($ola["linked"]["circles"] as $cercle)
		{
			$cercles[$cercle["id"]] = $cercle;
		}
		$vars["cercles"] = $cercles;
		
		$roles = array();
		foreach($ola["roles"] as $role)
		{
			if ( !count($role["links"]["people"]) && !empty($role["links"]["circle"]) && !in_array($role["name"], $this->roles_filtered) )
			{
				$cercle = empty($role["links"]["circle"]) ? "" : $cercles[$role["links"]["circle"]]["name"];
				$roles[$role["id"]] = ["role"=>$role["name"], "purpose"=>$role["name"], "circle"=>$cercle, "circle_id"=>$role["links"]["circle"], "role_id"=>$role["id"]];
			}
				
		}
		$vars["roles"] = $roles;
		$this->load->view('roles', $vars);
	}
}

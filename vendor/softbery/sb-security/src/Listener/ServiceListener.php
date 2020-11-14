<?php

/**
 * @Author: softb
 * @Date:   2020-10-10 02:26:12
 * @Last Modified by:   softb
 * @Last Modified time: 2020-10-10 03:18:38
 */

namespace Softbery\Security\Listener;

use Softbery\Security\Listener\Interface;

/**
 * 
 */
class ServiceListener implements ServiceListenerInterface
{
	protected listener=[];
	protected request;
	
	function __construct()
	{
		
	}

	
	public function RunService()
	{
		$base = new EventBase();
		$http = new EventHttp($base);

		// $http
	}

	/**
	 * @param string $path
	 */
	public function GetConfig(string $path)
	{

	}
}
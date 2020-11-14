<?php

/**
 * @Author: softb
 * @Date:   2020-10-10 02:29:57
 * @Last Modified by:   softb
 * @Last Modified time: 2020-10-10 02:48:22
 */
namespace Softbery\Security\Listener\Interface;

interface ServiceListenerInterface
{
	public function RunService(){}

	public function GetConfig(string path){}
}
<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Model\Tables;
use Application\Model\UsersTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module {
	const VERSION = '3.1.4dev';

	public function getConfig() {
		return include __DIR__ . '/../config/module.config.php';
	}

	public function getServiceConfig() {
		return array(
			'factories' => array(
				'UsersTableGateway' => function ($sm) {
					$dbAdapter = $sm->get(\Zend\Db\Adapter\Adapter::class);

					$resultSetPrototype = new ResultSet();
					$config = $sm->get('Config');
					$baseUrl = $config['view_manager']['base_url'];
					$userRowset = new Tables\User($baseUrl);
					$resultSetPrototype->setArrayObjectPrototype($userRowset);
					return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
				},
				'Application\Model\UsersTable' => function ($sm) {
					$tableGateway = $sm->get('UsersTableGateway');
					$table = new UsersTable($tableGateway);

					return $table;
				},
			),
		);
	}
}

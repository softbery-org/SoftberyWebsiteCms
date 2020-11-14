<?php
/**
 * @link      http://github.com/zendframework/Database for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Database;

use Database\Model\Article;
use Database\Model\ArticlesTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module {
	public $module;

	public function getConfig() {
		return include __DIR__ . '/../config/module.config.php';
	}

	public function getServiceConfig() {
		return array(
			'factories' => array(
				'ArticlesTableGateway' => function ($sm) {
					$dbAdapter = $sm->get(\Zend\Db\Adapter\Adapter::class);
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Article());

					return new TableGateway('article', $dbAdapter, null, $resultSetPrototype);
				},
				'Database\Model\ArticlesTable' => function ($sm) {
					$tableGateway = $sm->get('ArticlesTableGateway');
					$table = new ArticlesTable($tableGateway);

					return $table;
				},
			),
		);
	}

	public function getName() {
		return $this->namespace;
	}
}

<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
	'router' => [
		'routes' => [
			'home' => [
				'type' => Literal::class,
				'options' => [
					'route' => '/',
					'defaults' => [
						'controller' => Controller\IndexController::class,
						'action' => 'index',
					],
				],
			],
			'application' => [
				'type' => Segment::class,
				'options' => [
					'route' => '/application[/:action]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					],
					'defaults' => [
						'controller' => Controller\IndexController::class,
						'action' => 'index',
					],
				],
			],
		],
	],
	'controllers' => [
		'factories' => [
			Controller\IndexController::class => function ($sm) {
				$postService = $sm->get('Application\Model\UsersTable');

				return new Controller\IndexController($postService);
			},
		],
	],
	'view_manager' => [
		'display_not_found_reason' => true,
		'display_exceptions' => true,
		'doctype' => 'HTML5',
		'not_found_template' => 'error/404',
		'exception_template' => 'error/index',
		'template_map' => [
			'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
			'layout/administration' => __DIR__ . '/../../Administration/view/layout/layout-admin.phtml',
			'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
			'error/404' => __DIR__ . '/../view/error/404.phtml',
			'error/index' => __DIR__ . '/../view/error/index.phtml',
		],
		'template_path_stack' => [
			'application' => __DIR__ . '/../view',
		],
		'base_path' => '/public/',
		'base_url' => '/',
	],
];

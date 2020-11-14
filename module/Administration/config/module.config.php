<?php
namespace Administration;

// use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
	'controllers' => [
		'factories' => [
			Controller\AdministrationController::class => InvokableFactory::class,
		],
	],
	'router' => [
		'routes' => [
			'administration' => [
				'type' => Segment::class,
				'options' => [
					// Change this to something specific to your module
					'route' => '/administration[:action]',
					'defaults' => [
						'controller' => Controller\AdministrationController::class,
						'action' => 'index',
					],
				],
				'may_terminate' => true,
				'child_routes' => [
					// You can place additional routes that match under the
					// route defined above here.
				],
			],
		],
	],
	'view_manager' => [
		'tamplate_map' => [
			'layout/administration' => __DIR__ . '/../../Administration/view/layout/layout-admin.phtml',
			'administration/index/index' => __DIR__ . '/../../Administration/view/application/index/index.phtml',
		],
		'template_path_stack' => [
			'administration' => __DIR__ . '/../view',
		],
		'base_path' => '/public/backend/',
		'base_url' => '/',
	],
];

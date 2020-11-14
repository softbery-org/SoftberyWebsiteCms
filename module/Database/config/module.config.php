<?php
namespace Database;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
	'controllers' => [
		'factories' => [
			Controller\ArticleController::class => function ($sm) {
				$articlesService = $sm->get('Database\Model\ArticlesTable');
				return new Controller\ArticleController($articlesService);
			},
			// Form\QuestionForm::class =>
		],
	],
	'router' => [
		'routes' => [
			'article' => [
				'type' => Literal::class,
				'options' => [
					// Change this to something specific to your module
					'route' => '/article',
					'defaults' => [
						'controller' => Controller\ArticleController::class,
						'action' => 'index',
						'id' => 1,
					],
				],
				'may_terminate' => true,
				'child_routes' => [
				],
			],
			'articles' => [
				'type' => Segment::class,
				'options' => [
					// Change this to something specific to your module
					'route' => '/article[/:action[/:id]]',
					'defaults' => [
						'controller' => Controller\ArticleController::class,
						'action' => 'index',
						'id' => 1,
					],
				],
				'may_terminate' => true,
				'child_routes' => [
				],
			],
			'friendlyurl' => [
				'type' => Segment::class,
				'options' => [
					// Change this to something specific to your module
					'route' => '/article[/:friendly_url]',
					'defaults' => [
						'controller' => Controller\ArticleController::class,
						'action' => 'friendlyUrl',
						'friendly_url' => 'index.html',
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
			'layout/layout' => __DIR__ . '../../Application/view/layout/layout.phtml',
		],
		'template_path_stack' => [
			'article' => __DIR__ . '/../view',
		],
	],
];

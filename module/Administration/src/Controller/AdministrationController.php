<?php
/**
 * @link      http://github.com/zendframework/Administration for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class AdministrationController extends AbstractActionController {

	public function onDispatch(MvcEvent $e) {
		// Call the base class' onDispatch() first and grab the response
		$response = parent::onDispatch($e);

		// Set alternative layout
		$this->layout()->setTemplate('layout/administration');

		// Return the response
		return $response;
	}

	public function indexAction() {
		$view = new ViewModel();
		return $view;
	}
}

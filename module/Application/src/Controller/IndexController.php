<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Model\UsersTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
	private $usersTable = null;

	public function __construct(UsersTable $usersTable) {
		$this->usersTable = $usersTable;
	}

	public function indexAction() {
		// var_dump($this->usersTable);
		return new ViewModel();
	}
}

<?php

/**
 * @Author:   Softbery(C)
 * @Date:     2020-10-19 21:51:56
 * @Last 	  Modified by:   Softbery(C)
 * @Last 	  Modified time: 2020-10-19 21:51:56
 * @link      http://github.com/zendframework/Database for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Database\Controller;

use Database\Form\QuestionForm;
use Database\Model\ArticlesTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractActionController {

	private $articlesTable = null;
	private $_response;
	private $_params;
	private $_article;

	public function __construct(ArticlesTable $articlesTable) {
		$this->articlesTable = $articlesTable;
		$this->_response = $this->getResponse();
		$this->_params = $this->params();
	}

	public function indexAction() {
		$view = new ViewModel();
		$param = $this->params()->fromRoute();
		$id = $param['id'];
		$model = $this->articlesTable;
		$row = $model->getById($id);

		if (!$row) {
			$this->response->setStatusCode(404);
			throw new \Exception("IndexAction - ArticleController", 1);
		}

		$view->setVariable('id', $row->getId());
		$view->setVariable('title', $row->getTitle());
		$view->setVariable('content', $row->getContent());
		$view->setVariable('friendly_url', $row->getFriendlyUrl());

		return $view;
	}

	public function listAction() {
		$view = new ViewModel();
		$model = $this->articlesTable;
		$rows = $model->getAll();

		// foreach ($rows as $key => $value) {
		// 	echo $key . " " . $value->id . "<br\>";
		// 	echo $key . " " . $value->title . "<br\>";
		// 	echo $key . " " . $value->content . "<br\>";
		// }

		$view = array('vars' => $rows);
		return $view;
	}

	public function addAction() {
		$view = new ViewModel();
		$router = $this->params()->fromRoute();

		var_dump($router['controller']);

		return $view;
	}

	public function friendlyUrlAction() {
		$uriPath = $this->request->getUri()->getPath();
		$router = $this->params()->fromRoute();
		$model = $this->articlesTable;
		$row = $model->getByFriendlyUrl('/' . $router['friendly_url']);
		$view = new ViewModel();
		if ($row) {
			$view = array('id' => $row->id, 'title' => $row->title, 'content' => $row->content, 'friendly_url' => $row->friendly_url);
		} else {
			$this->response->setStatusCode(404);
			throw new \Exception("Brak friendly_url", 1);
		}

		return $view;
	}

	public function deleteAction() {

	}

	public function editAction() {
		$form = new QuestionForm();
		$view = new ViewModel();
		$param = $this->params()->fromRoute();
		$id = $param['id'];
		$model = $this->articlesTable;
		$row = $model->getById($id);
		$form->setData(array('question-form' => $row));
		$data = $form->addElements();
		// var_dump($data->getData());
		if (!$row) {
			$this->response->setStatusCode(404);
			throw new \Exception("EditAction - ArticleController", 1);
		}

		return new ViewModel(array('form' => $form));
	}

	public function searchAction() {

	}
}

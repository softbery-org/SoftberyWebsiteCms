<?php

/**
 * @Author: Softbery Group
 * @Date:   2020-10-19 21:56:20
 * @Last Modified by:   Softbery Group
 * @Last Modified time: 2020-10-20 02:46:48
 */
namespace Database\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * ArticlesTable
 */
class ArticlesTable {

	function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}

	public function getById($id) {
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();

		if (!$row) {
			$row = null;
			//throw new \Exception("Nie znaleziono artykułu: " . $id);
		}
		return $row;
		// $category_id;
		// $user_id;
		// $title;
		// $content;
		// $friendly_url;
		// $meta_title;
		// $meta_description;
		// $mata_keywords;
		// $visible;
		// $create_date;
	}

	public function getByFriendlyUrl($friendly_url) {
		$friendly_url = (string) $friendly_url;
		$rowset = $this->tableGateway->select(array('friendly_url' => $friendly_url));
		$row = $rowset->current();

		if (!$row) {
			$row = null;
			//throw new \Exception("Nie znaleziono artykułu: " . $friendly_url);
		}
		return $row;
		// $category_id;
		// $user_id;
		// $title;
		// $content;
		// $friendly_url;
		// $meta_title;
		// $meta_description;
		// $mata_keywords;
		// $visible;
		// $create_date;
	}

	public function getAll() {
		$rowset = $this->tableGateway->select();
		$rows = null;
		foreach ($rowset as $key => $value) {
			$rows[$key] = $value;
		}
		//$rows = $rowset->current();

		if (!$rows) {
			$rows = null;
			//throw new \Exception("Nie znaleziono artykułów.");
		}

		return $rows;
	}
}
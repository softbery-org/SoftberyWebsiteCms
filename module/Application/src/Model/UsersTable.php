<?php
namespace Application\Model;

use Application\Model\Tables\User;

class UsersTable {
	public function getById($id) {
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();

		if (!$row) {
			throw new \Exception('nie znaleziono użytkownika o id: ' . $id);
		}
		return $row;
	}

	public function getBy(array $params = array()) {
		$results = $this->tableGateway->select();

		return $results;
	}

	public function save(User $userModel, $extraData = []) {
		$data = $userModel->getArrayCopy();

		if (!empty($extraData)) {
			$data = array_merge($data, $extraData);
		}

		return saveRow($userModel, $data);
	}

	public function delete($id) {
		deleteRow($id);
	}
}
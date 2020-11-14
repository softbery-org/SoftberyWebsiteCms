<?php

namespace Application\Model\Tables;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator;
use Zend\Validator\StringLength;

class User extends AbstractModel implements InputFilterAwareInterface {
	public $login;
	public $password;
	public $salt;
	public $email;
	public $role;
	public $type;
	public $gender;
	public $status;

	private $inputFilter;

	public function exchangeArray($row) {
		$this->id = (!empty($row['id'])) ? $row['id'] : null;
		$this->login = (!empty($row['login'])) ? $row['login'] : null;
		$this->password = (!empty($row['password'])) ? $row['password'] : null;
		$this->salt = (!empty($row['salt'])) ? $row['salt'] : null;
		$this->type = (!empty($row['type'])) ? $row['type'] : null;
		$this->status = (!empty($row['status'])) ? $row['status'] : null;
		$this->email = (!empty($row['email'])) ? $row['email'] : null;
		$this->gender = (!empty($row['gender'])) ? $row['gender'] : null;
		$this->role = (!empty($row['role_id'])) ? $row['role_id'] : null;
	}

	public function getId() {
		return $this->id;
	}
	public function setId($value) {
		$this->id = $value;
	}

	public function getLogin() {
		return $this->login;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getSalt() {
		return $this->salt;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getRole() {
		return $this->role;
	}

	public function getRoles() {
		return [$this->getRole()];
	}

	public function getGender() {
		return $this->gender;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getType() {
		return $this->type;
	}
	/* Add the following methods: */
	public function getArrayCopy() {
		return [
			'id' => $this->getId(),
			'login' => $this->getLogin()(),
			'email' => $this->getEmail(),
			'gender' => $this->getGender(),
			'status' => $this->getStatus()(),
			'password' => $this->getPassword(),
			'salt' => $this->getSalt(),
			'role' => $this->getRole(),
			'type' => $this->getType(),
		];
	}

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new DomainException(sprintf(
			'%s does not allow injection of an alternate input filter',
			__CLASS__
		));
	}

	public function getInputFilter() {
		if ($this->inputFilter) {
			return $this->inputFilter;
		}

		$inputFilter = new InputFilter();

		$inputFilter->add([
			'name' => 'id',
			'required' => true,
			'filters' => [
				['name' => ToInt::class],
			],
		]);

		$inputFilter->add([
			'name' => 'username',
			'required' => true,
			'filters' => [
				['name' => StripTags::class],
				['name' => StringTrim::class],
			],
			'validators' => [
				[
					'name' => StringLength::class,
					'options' => [
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' => 100,
					],
				],
			],
		]);
		$inputFilter->add([
			'name' => 'email',
			'required' => true,
			'filters' => [
				['name' => StringTrim::class],
			],
			'validators' => [
				['name' => Validator\EmailAddress::class],
			],
		]);

		$this->inputFilter = $inputFilter;
		return $this->inputFilter;
	}
}

<?php
/**
 * @Author: Softbery Group
 * @Date:   2020-10-19 21:58:14
 * @Last Modified by:   Softbery Group
 * @Last Modified time: 2020-10-20 13:32:38
 */
namespace Database\Form;

use Zend\Form\Form;

/**
 * QuestionForm
 */
class QuestionForm extends Form {
	public function __construct($name = null) {
		// We will ignore the name provided to the constructor
		parent::__construct('question-form');
		$this->addElements();
		$this->addInputFilter();
	}

	private function addInputFilter() {
		// Get the default input filter attached to form model.
		$inputFilter = $this->getInputFilter();

		$inputFilter->add([
			'name' => 'email',
			'required' => true,
			'filters' => [
				['name' => 'StringTrim'],
			],
			'validators' => [
				[
					'name' => 'EmailAddress',
					'options' => [
						'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
						'useMxCheck' => false,
					],
				],
			],
		]
		);

		$inputFilter->add([
			'name' => 'subject',
			'required' => true,
			'filters' => [
				['name' => 'StringTrim'],
				['name' => 'StripTags'],
				['name' => 'StripNewlines'],
			],
			'validators' => [
				[
					'name' => 'StringLength',
					'options' => [
						'min' => 1,
						'max' => 128,
					],
				],
			],
		]
		);

		$inputFilter->add([
			'name' => 'body',
			'required' => true,
			'filters' => [
				['name' => 'StripTags'],
			],
			'validators' => [
				[
					'name' => 'StringLength',
					'options' => [
						'min' => 1,
						'max' => 4096,
					],
				],
			],
		]
		);
	}

	public function addElements() {
		$this->add([
			'name' => 'id',
			'type' => 'hidden',
		]);
		$this->add([
			'name' => 'title',
			'type' => 'text',
			'options' => [
				'label' => 'Title',
			],
		]);
		$this->add([
			'name' => 'artist',
			'type' => 'text',
			'options' => [
				'label' => 'Artist',
			],
		]);
		$this->add([
			'name' => 'submit',
			'type' => 'submit',
			'attributes' => [
				'value' => 'Go',
				'id' => 'submitbutton',
			],
		]);
	}
}
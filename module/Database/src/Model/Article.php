<?php

/**
 * @Author: Softbery Group
 * @Date:   2020-10-19 21:56:33
 * @Last Modified by:   Softbery Group
 * @Last Modified time: 2020-10-20 01:33:18
 */

namespace Database\Model;

/**
 * Article
 */
class Article {
	public $id;
	public $category_id;
	public $user_id;
	public $title;
	public $content;
	public $friendly_url;
	public $meta_title;
	public $meta_description;
	public $mata_keywords;
	public $visible;
	public $create_date;

	public function exchangeArray($row) {
		$this->id = (!empty($row['id'])) ? $row['id'] : null;
		$this->category_id = (!empty($row['category_id'])) ? $row['category_id'] : null;
		$this->user_id = (!empty($row['user_id'])) ? $row['user_id'] : null;
		$this->title = (!empty($row['title'])) ? $row['title'] : null;
		$this->content = (!empty($row['content'])) ? $row['content'] : null;
		$this->friendly_url = (!empty($row['friendly_url'])) ? $row['friendly_url'] : null;
		$this->meta_title = (!empty($row['meta_title'])) ? $row['meta_title'] : null;
		$this->meta_description = (!empty($row['meta_description'])) ? $row['meta_description'] : null;
		$this->mata_keywords = (!empty($row['mata_keywords'])) ? $row['mata_keywords'] : null;
		$this->visible = (!empty($row['visible'])) ? $row['visible'] : null;
		$this->create_date = (!empty($row['create_date'])) ? $row['create_date'] : null;
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getContent() {
		return $this->content;
	}

	public function getFriendlyUrl() {
		return $this->friendly_url;
	}
}
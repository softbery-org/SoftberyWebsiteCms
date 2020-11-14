<?php
/**
 * @link      http://github.com/zendframework/Administration for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administration;

class Module {
	const VERSION = "4.10.16.1331";

	public function getConfig() {
		return include __DIR__ . '/../config/module.config.php';
	}
}

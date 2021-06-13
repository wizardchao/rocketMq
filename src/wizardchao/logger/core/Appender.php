<?php
namespace wizardchao\logger\core;

use wizardchao\logger\LoggerConfig;

abstract class Appender {

	public abstract function init($config);

	public abstract function write($message);

	protected function getLogPath($config = []) {
		if (class_exists("Yaconf")) {
			$yaconfKey = $config['yaconfKey'] ?? "database.logger.path";
			$yaconf = new \Yaconf();
			$val = $yaconf::get($yaconfKey, "");
			if (!empty($val)) {
				return $val;
			}
		}

		if (isset($config['logDir'])) {
			return $config['logDir'];
		}

		if (defined("LOGGER_PATH")) {
			return LOGGER_PATH;
		} else if (defined("RUNTIME_PATH")) {
			return RUNTIME_PATH . "log";
		} else if (defined("ROOT_PATH")) {
			return ROOT_PATH . "runtime" . DIRECTORY_SEPARATOR . "log";
		} else {
			throw new \Exception("logger path is not config");
		}
	}
}
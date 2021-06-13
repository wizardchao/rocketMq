<?php
namespace wizardchao\logger;

class LoggerConfig {

	private static $config = null;

	/**
	 * @return null|array
	 * @throws \Exception
	 */
	public static function getConfig() {
		if (!is_null(self::$config)) {
			return self::$config;
		}

		if (!defined("ROOT_PATH")) {
			throw new \Exception("ROOT_PATH not config");
		}
		$configFileName = ROOT_PATH . "logger.json";
		if (file_exists($configFileName)) {
			self::$config = json_decode(file_get_contents($configFileName), true);
			if (self::$config == null) {
				throw new \Exception("logger.json is error");
			}
		} else {
			self::$config = [];
		}
		return self::$config;
	}
}
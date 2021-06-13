<?php
namespace wizardchao\logger;

use wizardchao\logger\core\LoggerHandler;

class LoggerFactory {

	private static $logger = [];

	private static $init = false;

	/**
	 * @var LoggerHandler
	 */
	private static $loggerHandler;

	public static function getLogger($loggerName) {
		self::init();
		if (isset(self::$logger[$loggerName])) {
			return self::$logger[$loggerName];
		}
		$logger = self::$logger[$loggerName] = new Logger($loggerName, self::$loggerHandler);
		return $logger;
	}

	/**
	 * @param $loggerName
	 * @param $config
	 * @return Logger
	 */
	public static function getLoggerByConfig($loggerName, $config) {
		return new Logger($loggerName, new LoggerHandler($config));
	}

	private static function init() {
		if (!self::$init) {
			$config = LoggerConfig::getConfig();
			self::$loggerHandler = new LoggerHandler($config);
			self::$init = true;
		}
	}
}
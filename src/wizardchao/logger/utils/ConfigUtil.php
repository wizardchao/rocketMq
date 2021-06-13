<?php
namespace wizardchao\logger\utils;

class ConfigUtil {

	public static function getAppName($config) {
		if (isset($config['appName'])) {
			return $config['appName'];
		} else if (defined("APP_NAME")) {
			return APP_NAME;
		} else if (defined("APP_ID")) {
			return APP_ID;
		} else {
			return "common";
		}
	}
}
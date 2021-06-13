<?php
namespace wizardchao\logger\utils;

class TimeUtil {

	/**
	 * @return int
	 */
	public static function getTimestamp() {
		return intval(microtime(true) * 1000);
	}

	/**
	 * @param $timestamp
	 * @return string
	 */
	public static function formatTimestamp($timestamp) {
		return date("Y-m-d H:i:s", substr($timestamp, 0, 10)) . "." .
		substr($timestamp, 10);
	}
}
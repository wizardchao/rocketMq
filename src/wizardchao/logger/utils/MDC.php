<?php
namespace wizardchao\logger\utils;

class MDC {

	/**
	 * @return string|null
	 */
	public static function get($key, $default = null) {
		return ContextUtil::get($key, $default);
	}

	public static function put($key, $value) {
		ContextUtil::put($key, $value);
	}

	public static function clear() {
		ContextUtil::delete();
	}
}
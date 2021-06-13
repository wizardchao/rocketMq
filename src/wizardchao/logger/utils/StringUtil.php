<?php
namespace wizardchao\logger\utils;

class StringUtil {

	public static function getRandomStr($str = "") {
		return md5($str . uniqid(mt_rand(), true) . rand(0, 1000000));
	}
}
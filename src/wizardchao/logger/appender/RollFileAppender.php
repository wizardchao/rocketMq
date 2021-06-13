<?php
namespace wizardchao\logger\appender;

use wizardchao\logger\core\Appender;
use wizardchao\logger\utils\ConfigUtil;

class RollFileAppender extends Appender {

	private $config = [];
	private $fileSize;
	private $fileName;
	private $defaultFileNamePattern = "flumelog-%s-%d{Y-m-d-H}.%i.log";
	private $filePattern = "";
	private $fileFormat = "";

	public function init($config) {
		$this->config = $config;
		$fileNamePattern = $config['fileNamePattern'] ?? $this->defaultFileNamePattern;
		$appName = strtolower(ConfigUtil::getAppName($config));
		$fileNamePattern = str_replace("%s", $appName, $fileNamePattern);
		$regex = '/.*(%d{(.*)}).*/';
		$arr = [];
		$num_matches = preg_match($regex, $fileNamePattern, $arr);
		if ($num_matches >= 1) {
			$this->filePattern = $arr[2];
			$this->fileFormat = $this->getFileFormat($this->filePattern);
			$fileNamePattern = str_replace($arr[1], $this->fileFormat, $fileNamePattern);
		}
		$fileDir = $this->getLogPath($config);
		$this->fileName = $fileDir . DIRECTORY_SEPARATOR . $fileNamePattern;
		$this->fileSize = (isset($config['fileSize']) ? intval($config['fileSize']) : 1000) * 1024 * 1024; // 默认1GB
	}

	public function write($message) {
		if (!empty($this->filePattern) && $this->getFileFormat($this->filePattern) != $this->fileFormat) {
			// 重新初始化
			$this->init($this->config);
		}
		$fileName = $this->getFileName($this->fileName);
		$message .= "\n";
		try {
			file_put_contents($fileName, $message, FILE_APPEND | LOCK_EX);
		} catch (\Throwable $e) {
		}
	}

	private function getFileFormat($filePattern) {
		return date($filePattern);
	}

	/**
	 * 格式化获取日志文件
	 * @param $fileName
	 * @return string
	 */
	private function getFileName($fileName) {
		if (strpos($fileName, "%i") === false) {
			// 无需切割文件
			return $fileName;
		}
		$fileName = str_replace("%i", "%s", $fileName);
		$i = 0;
		while (true) {
			$fileNameFormat = sprintf($fileName, $i);
			if (!is_file($fileNameFormat)) {
				return $fileNameFormat;
			} else if ($i >= 9) {
				// 最多产生10个文件
				return $fileNameFormat;
			} else {
				$fileSize = filesize($fileNameFormat);
				if ($fileSize < $this->fileSize) {
					return $fileNameFormat;
				}
			}
			$i++;
		}
	}
}
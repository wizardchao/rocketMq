<?php
namespace wizardchao\logger\core;

use wizardchao\logger\appender\RollFileAppender;
use wizardchao\logger\bean\ILoggingEvent;
use wizardchao\logger\bean\LoggerLevel;
use wizardchao\logger\driver\flume\JsonLogConverter;
use wizardchao\logger\utils\TimeUtil;

class LoggerHandler {

	/**
	 * @var ClassicConverter
	 */
	private $classicConverter;

	/**
	 * @var Appender
	 */
	private $appender;

	private $loggerLevel = [];

	private $writeLevel = 1;

	private $config;

	public function __construct($config) {
		if (isset($config['appender'])) {
			$this->appender = new $config['appender'];
		} else {
			$this->appender = new RollFileAppender();
		}
		$this->appender->init($config);
		if (isset($config['classicConverter'])) {
			$this->classicConverter = new $config['classicConverter'];
		} else {
			$this->classicConverter = new JsonLogConverter();
		}
		$this->loggerLevel = [
			LoggerLevel::$DEBUG => 0,
			LoggerLevel::$INFO => 1,
			LoggerLevel::$WARN => 2,
			LoggerLevel::$ERROR => 3,
		];
		isset($config['level']) && $this->writeLevel = $config['level'];
		$this->config = $config;
	}

	public function handle($loggerName, $level, $message, $throwable, ...$args) {
		$writeLevel = $this->loggerLevel[$level];
		if ($writeLevel < $this->writeLevel) {
			return;
		}

		$iLoggingEvent = new ILoggingEvent();
		$iLoggingEvent->setLevel($level);
		$iLoggingEvent->setLoggerName($loggerName);
		$iLoggingEvent->setMessage($message);
		$iLoggingEvent->setFormattedMessage($this->formatMessage($message, ...$args));
		$iLoggingEvent->setTimestamp(TimeUtil::getTimestamp());
		$iLoggingEvent->setConfig($this->config);
		$content = $this->classicConverter->convert($iLoggingEvent);
		$this->appender->write($content);
	}

	private function formatMessage($message, ...$args) {
		if (func_num_args() > 1) {
			return sprintf(str_replace("{}", "%s", $message), ...$args);
		} else {
			return $message;
		}
	}
}
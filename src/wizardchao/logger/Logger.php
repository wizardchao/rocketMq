<?php
namespace wizardchao\logger;

use wizardchao\logger\bean\LoggerLevel;
use wizardchao\logger\core\LoggerHandler;

class Logger {

	private $loggerName;

	/**
	 * @var LoggerHandler
	 */
	private $loggerHandler;

	public function __construct($loggerName, LoggerHandler $loggerHandler) {
		$this->loggerName = $loggerName;
		$this->loggerHandler = $loggerHandler;
	}

	public function debug($message, ...$args) {
		$this->loggerHandler->handle($this->loggerName, LoggerLevel::$DEBUG, $message, null, ...$args);
	}

	public function info($message, ...$args) {
		$this->loggerHandler->handle($this->loggerName, LoggerLevel::$INFO, $message, null, ...$args);
	}

	public function warn($message, ...$args) {
		$this->loggerHandler->handle($this->loggerName, LoggerLevel::$WARN, $message, null, ...$args);
	}

	public function warnWithException($message, \Throwable $throwable, ...$args) {
		$this->loggerHandler->handle($this->loggerName, LoggerLevel::$WARN, $message, $throwable, ...$args);
	}

	public function error($message, ...$args) {
		$this->loggerHandler->handle($this->loggerName, LoggerLevel::$ERROR, $message, null, ...$args);
	}

	public function errorWithException($message, \Throwable $throwable, ...$args) {
		$this->loggerHandler->handle($this->loggerName, LoggerLevel::$ERROR, $message, $throwable, ...$args);
	}
}
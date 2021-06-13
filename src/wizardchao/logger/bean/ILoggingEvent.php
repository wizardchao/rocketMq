<?php
namespace wizardchao\logger\bean;

class ILoggingEvent {

	private $loggerName;

	private $message;

	private $formattedMessage;

	private $level;

	private $timestamp;

	private $config;

	/**
	 * @return mixed
	 */
	public function getLoggerName() {
		return $this->loggerName;
	}

	/**
	 * @param mixed $loggerName
	 */
	public function setLoggerName($loggerName) {
		$this->loggerName = $loggerName;
	}

	/**
	 * @return mixed
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param mixed $message
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * @return mixed
	 */
	public function getFormattedMessage() {
		return $this->formattedMessage;
	}

	/**
	 * @param mixed $formattedMessage
	 */
	public function setFormattedMessage($formattedMessage) {
		$this->formattedMessage = $formattedMessage;
	}

	/**
	 * @return mixed
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @param mixed $level
	 */
	public function setLevel($level) {
		$this->level = $level;
	}

	/**
	 * @return mixed
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * @param mixed $timestamp
	 */
	public function setTimestamp($timestamp) {
		$this->timestamp = $timestamp;
	}

	/**
	 * @return mixed
	 */
	public function getConfig() {
		return $this->config;
	}

	/**
	 * @param mixed $config
	 */
	public function setConfig($config) {
		$this->config = $config;
	}
}
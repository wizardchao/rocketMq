<?php
namespace wizardchao\logger\driver\flume\bean;

class ResponseError extends ColumnBean {

	protected $errorMsg;

	protected $exception;

	protected $file;

	protected $line;

	protected $trace;

	/**
	 * @return mixed
	 */
	public function getErrorMsg() {
		return $this->errorMsg;
	}

	/**
	 * @param mixed $errorMsg
	 */
	public function setErrorMsg($errorMsg) {
		$this->errorMsg = $errorMsg;
	}

	/**
	 * @return mixed
	 */
	public function getException() {
		return $this->exception;
	}

	/**
	 * @param mixed $exception
	 */
	public function setException($exception) {
		$this->exception = $exception;
	}

	/**
	 * @return mixed
	 */
	public function getFile() {
		return $this->file;
	}

	/**
	 * @param mixed $file
	 */
	public function setFile($file) {
		$this->file = $file;
	}

	/**
	 * @return mixed
	 */
	public function getLine() {
		return $this->line;
	}

	/**
	 * @param mixed $line
	 */
	public function setLine($line) {
		$this->line = $line;
	}

	/**
	 * @return mixed
	 */
	public function getTrace() {
		return $this->trace;
	}

	/**
	 * @param mixed $trace
	 */
	public function setTrace($trace) {
		$this->trace = $trace;
	}
}

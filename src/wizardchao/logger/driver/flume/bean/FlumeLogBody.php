<?php
namespace wizardchao\logger\driver\flume\bean;

class FlumeLogBody extends ColumnBean {

	protected $addTime;

	protected $logType;

	protected $appName;

	protected $level = "200";

	protected $requestId;

	protected $ip;

	protected $instanceId;

	protected $var1;

	protected $var2;

	protected $var3;

	protected $requestUri;

	protected $content;

	protected $traceId;

	protected $duration;

	/**
	 * @return mixed
	 */
	public function getAddTime() {
		return $this->addTime;
	}

	/**
	 * @param mixed $addTime
	 */
	public function setAddTime($addTime) {
		$this->addTime = $addTime;
	}

	/**
	 * @return mixed
	 */
	public function getLogType() {
		return $this->logType;
	}

	/**
	 * @param mixed $logType
	 */
	public function setLogType($logType) {
		$this->logType = $logType;
	}

	/**
	 * @return mixed
	 */
	public function getAppName() {
		return $this->appName;
	}

	/**
	 * @param mixed $appName
	 */
	public function setAppName($appName) {
		$this->appName = $appName;
	}

	/**
	 * @return string
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @param string $level
	 */
	public function setLevel($level) {
		$this->level = $level;
	}

	/**
	 * @return mixed
	 */
	public function getRequestId() {
		return $this->requestId;
	}

	/**
	 * @param mixed $requestId
	 */
	public function setRequestId($requestId) {
		$this->requestId = $requestId;
	}

	/**
	 * @return mixed
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * @param mixed $ip
	 */
	public function setIp($ip) {
		$this->ip = $ip;
	}

	/**
	 * @return mixed
	 */
	public function getInstanceId() {
		return $this->instanceId;
	}

	/**
	 * @param mixed $instanceId
	 */
	public function setInstanceId($instanceId) {
		$this->instanceId = $instanceId;
	}

	/**
	 * @return mixed
	 */
	public function getVar1() {
		return $this->var1;
	}

	/**
	 * @param mixed $var1
	 */
	public function setVar1($var1) {
		$this->var1 = $var1;
	}

	/**
	 * @return mixed
	 */
	public function getVar2() {
		return $this->var2;
	}

	/**
	 * @param mixed $var2
	 */
	public function setVar2($var2) {
		$this->var2 = $var2;
	}

	/**
	 * @return mixed
	 */
	public function getVar3() {
		return $this->var3;
	}

	/**
	 * @param mixed $var3
	 */
	public function setVar3($var3) {
		$this->var3 = $var3;
	}

	/**
	 * @return mixed
	 */
	public function getRequestUri() {
		return $this->requestUri;
	}

	/**
	 * @param mixed $requestUri
	 */
	public function setRequestUri($requestUri) {
		$this->requestUri = $requestUri;
	}

	/**
	 * @return mixed
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param mixed $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @return mixed
	 */
	public function getTraceId() {
		return $this->traceId;
	}

	/**
	 * @param mixed $traceId
	 */
	public function setTraceId($traceId) {
		$this->traceId = $traceId;
	}

	/**
	 * @return mixed
	 */
	public function getDuration() {
		return $this->duration;
	}

	/**
	 * @param mixed $duration
	 */
	public function setDuration($duration) {
		$this->duration = $duration;
	}
}

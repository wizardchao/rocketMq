<?php
namespace wizardchao\rocketmq\consumer;

use Closure;
use wizardchao\rocketmq\remoting\callback\InvokeCallback;
use wizardchao\rocketmq\remoting\RemotingCommand;

class PullMessageCallback implements InvokeCallback {
	/**
	 * @var Closure
	 */
	private $pullback;

	public function __construct(Closure $pullback) {
		$this->pullback = $pullback;
	}

	function operationComplete(RemotingCommand $response) {
		$pullback = $this->pullback;
		$pullback($response);
	}
}
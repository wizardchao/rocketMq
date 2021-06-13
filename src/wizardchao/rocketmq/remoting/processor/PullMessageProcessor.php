<?php
namespace wizardchao\rocketmq\remoting\processor;

use wizardchao\rocketmq\consumer\PullResultExt;
use wizardchao\rocketmq\entity\PullStatus;
use wizardchao\rocketmq\exception\RocketMQClientException;
use wizardchao\rocketmq\remoting\AbstractRemotingClient;
use wizardchao\rocketmq\remoting\InvokeCallback;
use wizardchao\rocketmq\remoting\RemotingCommand;
use wizardchao\rocketmq\remoting\ResponseCode;

class PullMessageProcessor implements Processor {

	private function processPullResponse(RemotingCommand $response) {
		$pullStatus = PullStatus::NO_NEW_MSG;
		switch ($response->getCode()) {
		case ResponseCode::$SUCCESS:
			$pullStatus = PullStatus::FOUND;
			break;
		case ResponseCode::$PULL_NOT_FOUND:
			$pullStatus = PullStatus::NO_NEW_MSG;
			break;
		case ResponseCode::$PULL_RETRY_IMMEDIATELY:
			$pullStatus = PullStatus::NO_MATCHED_MSG;
			break;
		case ResponseCode::$PULL_OFFSET_MOVED:
			$pullStatus = PullStatus::OFFSET_ILLEGAL;
			break;
		default:
			throw new RocketMQClientException($response->getCode(), $response->getRemark());
		}

	}

	function execute(AbstractRemotingClient $client, RemotingCommand $response, InvokeCallback $invokeCallback = null) {

	}

	function exception(\Exception $e) {
		// TODO: Implement exception() method.
	}
}
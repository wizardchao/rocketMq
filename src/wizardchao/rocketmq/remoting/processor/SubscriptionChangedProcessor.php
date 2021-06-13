<?php
namespace wizardchao\rocketmq\remoting\processor;

use wizardchao\rocketmq\MQAsyncClientInstance;
use wizardchao\rocketmq\remoting\AbstractRemotingClient;
use wizardchao\rocketmq\remoting\InvokeCallback;
use wizardchao\rocketmq\remoting\RemotingCommand;

class SubscriptionChangedProcessor implements Processor {
	/**
	 * @var MQAsyncClientInstance
	 */
	private $mqClientFactory;

	private $doRebalanceComplated = false;

	/**
	 * SubscriptionChangedProcessor constructor.
	 * @param MQAsyncClientInstance $mqClientFactory
	 */
	public function __construct(MQAsyncClientInstance $mqClientFactory) {
		$this->mqClientFactory = $mqClientFactory;
	}

	function execute(AbstractRemotingClient $client, RemotingCommand $remotingCommand, InvokeCallback $invokeCallback = null) {
		if (!$this->doRebalanceComplated) {
			$this->mqClientFactory->doRebalance();
			$this->doRebalanceComplated = true;
		}
	}

	function exception(\Exception $e) {
		// TODO: Implement exception() method.
	}

}
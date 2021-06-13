<?php
namespace wizardchao\rocketmq;

use wizardchao\rocketmq\entity\TopicRouteData;
use wizardchao\rocketmq\remoting\header\namesrv\GetRouteInfoRequestHeader;
use wizardchao\rocketmq\remoting\MessageDecoder;
use wizardchao\rocketmq\remoting\MessageEncoder;
use wizardchao\rocketmq\remoting\NettyClient;
use wizardchao\rocketmq\remoting\RemotingCommand;
use wizardchao\rocketmq\remoting\RequestCode;
use wizardchao\rocketmq\util\MQClientUtil;

class MQClient {
	/**
	 * @var NettyClient
	 */
	private $nettyClient;

	public function __construct() {
		$this->nettyClient = new NettyClient();
	}

	/**
	 * @param RemotingCommand $requestCommand
	 * @return RemotingCommand
	 * @throws exception\RocketMQClientException
	 */
	public function sendMessage(RemotingCommand $requestCommand) {
		$byteBuf = MessageEncoder::encode($requestCommand);
		$result = $this->nettyClient->send($byteBuf);
		$remotingCommand = MessageDecoder::decode($result);
		return $remotingCommand;
	}

	public function connect($addr) {
		$this->nettyClient->connect($addr, 10);
	}

	public function shutdown() {
		$this->nettyClient->shutdown();
	}
}
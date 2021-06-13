<?php
namespace wizardchao\rocketmq\remoting;

use wizardchao\rocketmq\core\ResponseFuture;
use wizardchao\rocketmq\remoting\callback\InvokeCallback;

abstract class AbstractRemotingClient {
	protected $addr;

	protected $client = null;

	abstract function connect();

	abstract function isConnected();

	abstract function send(RemotingCommand $remotingCommand, ResponseFuture $responseFuture = null);

	abstract function close();

	abstract function getAddr();
}
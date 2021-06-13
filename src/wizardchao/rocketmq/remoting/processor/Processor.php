<?php
namespace wizardchao\rocketmq\remoting\processor;

use wizardchao\rocketmq\remoting\AbstractRemotingClient;
use wizardchao\rocketmq\remoting\InvokeCallback;
use wizardchao\rocketmq\remoting\RemotingCommand;

interface Processor {
	function execute(AbstractRemotingClient $client, RemotingCommand $remotingCommand);

	function exception(\Exception $e);
}
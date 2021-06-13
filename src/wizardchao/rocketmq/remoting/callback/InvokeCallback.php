<?php
namespace wizardchao\rocketmq\remoting\callback;

use wizardchao\rocketmq\remoting\AbstractRemotingClient;
use wizardchao\rocketmq\remoting\RemotingCommand;

interface InvokeCallback {
	function operationComplete(RemotingCommand $remotingCommand);
}
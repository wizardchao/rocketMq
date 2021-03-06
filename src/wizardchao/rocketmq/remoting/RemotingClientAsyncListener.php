<?php
namespace wizardchao\rocketmq\remoting;

interface RemotingClientAsyncListener {

	function onConnect($client);

	function onReceive($client, $data);

	function onClose($client);

	function onError($client);
}
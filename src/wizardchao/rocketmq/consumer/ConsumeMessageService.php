<?php
namespace wizardchao\rocketmq\consumer;

use wizardchao\rocketmq\entity\MessageExt;
use wizardchao\rocketmq\entity\MessageQueue;
use wizardchao\rocketmq\remoting\body\ConsumeMessageDirectlyResult;

interface ConsumeMessageService {
	function start();

	function shutdown(int $awaitTerminateMillis);

	function updateCorePoolSize(int $corePoolSize);

	function incCorePoolSize();

	function decCorePoolSize();

	function getCorePoolSize();

	/**
	 * @param MessageExt $msg
	 * @param string $brokerName
	 * @return ConsumeMessageDirectlyResult
	 */
	function consumeMessageDirectly(MessageExt $msg, string $brokerName);

	/**
	 * @param array $msgs
	 * @param ProcessQueue $processQueue
	 * @param MessageQueue $messageQueue
	 * @param bool $dispathToConsume
	 * @return mixed
	 */
	function submitConsumeRequest(array $msgs, ProcessQueue $processQueue, MessageQueue $messageQueue, bool $dispathToConsume);

	function setConsumeMessageQueueCapacity(int $consumeMessageQueueCapacity);
}
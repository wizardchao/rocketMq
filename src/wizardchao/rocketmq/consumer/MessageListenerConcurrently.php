<?php
namespace wizardchao\rocketmq\consumer;

use wizardchao\rocketmq\consumer\listener\ConsumeConcurrentlyContext;
use wizardchao\rocketmq\consumer\listener\ConsumeConcurrentlyStatus;
use wizardchao\rocketmq\entity\MessageExt;

interface MessageListenerConcurrently extends MessageListener {
	/**
	 * @param MessageExt[] $msgs
	 * @param ConsumeConcurrentlyContext $context
	 * @return string
	 */
	function consumeMessage(array $msgs, ConsumeConcurrentlyContext $context);
}
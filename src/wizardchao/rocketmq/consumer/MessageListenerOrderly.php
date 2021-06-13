<?php
namespace wizardchao\rocketmq\consumer;

use wizardchao\rocketmq\consumer\listener\ConsumeOrderlyContext;
use wizardchao\rocketmq\consumer\listener\ConsumeOrderlyStatus;
use wizardchao\rocketmq\entity\MessageExt;

interface MessageListenerOrderly extends MessageListener {
	/**
	 * @param MessageExt[] $msgs
	 * @param ConsumeOrderlyContext $context
	 * @return ConsumeOrderlyStatus
	 */
	function consumeMessage(array $msgs, ConsumeOrderlyContext $context);
}
<?php
namespace wizardchao\rocketmq\producer;

use wizardchao\rocketmq\entity\Message;
use wizardchao\rocketmq\entity\SendResult;

interface MQProducerFallback {
	function beforeSendMessage(Message $message);

	function afterSendMessage(Message $message, SendResult $sendResult);
}
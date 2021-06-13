<?php
namespace wizardchao\rocketmq\producer;

use wizardchao\rocketmq\entity\Message;
use wizardchao\rocketmq\entity\MessageExt;
use wizardchao\rocketmq\entity\SendResult;

interface TransactionListener {

	/**
	 * 执行本地事务
	 * @param Message $msg
	 * @param SendResult $sendResult
	 * @param $arg
	 * @return mixed
	 */
	function executeLocalTransaction(Message $msg, SendResult $sendResult, $arg);

	/**
	 * 回查事务状态
	 * @param MessageExt $msg
	 * @return LocalTransactionState
	 */
	function checkLocalTransaction(MessageExt $msg);
}
<?php
namespace wizardchao\rocketmq\remoting\body;

class ConsumeMessageDirectlyResult {
	private $order = false;
	private $autoCommit = true;
	private $consumeResult;
	private $remark;
	private $spentTimeMills;
}
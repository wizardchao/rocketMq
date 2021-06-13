<?php
namespace wizardchao\rocketmq\remoting\heartbeat;

use wizardchao\rocketmq\core\Column;

class ProducerData extends Column {
	protected $groupName;

	/**
	 * @return mixed
	 */
	public function getGroupName() {
		return $this->groupName;
	}

	/**
	 * @param mixed $groupName
	 */
	public function setGroupName($groupName) {
		$this->groupName = $groupName;
	}
}
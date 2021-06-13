<?php
namespace wizardchao\logger\driver\flume\bean;

class FlumeLogSet extends ColumnBean {

	protected $_index;

	protected $_type;

	protected $_id;

	protected $routing;

	/**
	 * @return mixed
	 */
	public function get_index() {
		return $this->_index;
	}

	/**
	 * @param mixed $index
	 */
	public function set_index($index) {
		$this->_index = $index;
	}

	/**
	 * @return mixed
	 */
	public function get_type() {
		return $this->_type;
	}

	/**
	 * @param mixed $type
	 */
	public function set_type($type) {
		$this->_type = $type;
	}

	/**
	 * @return mixed
	 */
	public function get_id() {
		return $this->_id;
	}

	/**
	 * @param mixed $id
	 */
	public function set_id($id) {
		$this->_id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getRouting() {
		return $this->routing;
	}

	/**
	 * @param mixed $routing
	 */
	public function setRouting($routing) {
		$this->routing = $routing;
	}

}

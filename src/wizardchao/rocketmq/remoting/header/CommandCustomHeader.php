<?php
namespace wizardchao\rocketmq\remoting\header;

interface CommandCustomHeader {
	/**
	 * @return array
	 */
	function getHeader();
}
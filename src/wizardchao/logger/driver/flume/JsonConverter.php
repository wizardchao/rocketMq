<?php
namespace wizardchao\logger\driver\flume;

use wizardchao\logger\bean\ILoggingEvent;
use wizardchao\logger\core\ClassicConverter;

class JsonConverter implements ClassicConverter {

	public function convert(ILoggingEvent $iLoggingEvent) {
		return $iLoggingEvent->getFormattedMessage();
	}
}
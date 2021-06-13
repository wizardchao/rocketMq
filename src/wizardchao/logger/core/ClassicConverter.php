<?php
namespace wizardchao\logger\core;

use wizardchao\logger\bean\ILoggingEvent;

interface ClassicConverter {

	function convert(ILoggingEvent $ILoggingEvent);
}
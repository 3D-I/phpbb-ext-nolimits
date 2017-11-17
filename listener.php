<?php

/**
* @package   s9e\nolimits
* @copyright Copyright (c) 2017 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\nolimits;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return [
			'core.text_formatter_s9e_configure_after' => 'onConfigure',
			'core.text_formatter_s9e_parser_setup'    => 'onParserSetup'
		];
	}

	public function onConfigure($event)
	{
		foreach ($event['configurator']->tags as $tag)
		{
			$tag->nestingLimit = PHP_INT_MAX;
			$tag->tagLimit     = PHP_INT_MAX;
		}
		foreach ($event['configurator']->plugins as $plugin)
		{
			$plugin->setRegexpLimit(PHP_INT_MAX);
		}
	}

	public function onParserSetup($event)
	{
		$event['parser']->get_parser()->maxFixingCost = PHP_INT_MAX;
	}
}
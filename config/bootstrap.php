<?php
/**
* li3_css
*
* Copyright 2010, Fahad Ibnay Heylaal <contact@fahad19.com>
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @author Fahad Ibnay Heylaal <contact@fahad19.com>
* @copyright Copyright 2010, Fahad Ibnay Heylaal <contact@fahad19.com>
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/
use lithium\action\Dispatcher;

require_once 'css_parser.php';

Dispatcher::applyFilter('run', function($self, $params, $chain) {
	if (!strstr($params['request']->url, '.css')) {
		return $chain->next($self, $params, $chain);
	}
	$output = $chain->next($self, $params, $chain);

	$parser = new CssParser();
	$parser->load_string($output);
	$parser->parse();

	foreach ($parser->parsed['css'] AS $selector => $properties) {
		// extend
		if (isset($parser->parsed['css'][$selector]['extend'])) {
			$extendSelectors = explode(',', $parser->parsed['css'][$selector]['extend']);
			foreach ($extendSelectors AS $extendSelector) {
				$extendSelector = trim($extendSelector);
				if (isset($parser->parsed['css'][$extendSelector])) {
					$parser->parsed['css'][$selector] = array_merge(
						$parser->parsed['css'][$selector],
						$parser->parsed['css'][$extendSelector]
					);
				}
			}
			unset($parser->parsed['css'][$selector]['extend']);
		}
	}
	
	$output = $parser->glue();
	return $output;
});

?>
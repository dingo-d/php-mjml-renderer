<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer;

use MadeByDenis\PhpMjmlRenderer\Parser\MjmlParser;

/**
 * Parser factory
 *
 * Creates a shared parser instance.
 *
 * @since 1.0.0
 */
final class ParserFactory
{
	/**
	 * Creates a Parser instance
	 *
	 * @return Parser The parser instance.
	 *
	 */
	public static function create(): Parser
	{
		static $instance = null;

		if ($instance === null) {
			$instance = new Parser\MjmlParser();
		}

		return $instance;
	}
}

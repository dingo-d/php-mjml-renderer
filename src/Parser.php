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

/**
 * Parser interface
 *
 * @since 1.0.0
 */
interface Parser
{
	/**
	 * Parses MJML into node tree
	 *
	 * @param string $sourceCode The MJML source code to parse.
	 *
	 * @return Node[] Array of node objects with some details about the elements.
	 */
	public function parse(string $sourceCode);
}

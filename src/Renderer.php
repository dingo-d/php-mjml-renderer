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
 * Render interface
 *
 * @since 1.0.0
 */
interface Renderer
{
	/**
	 * Renders MJML to HTML
	 *
	 * @param string $content The MJML content.
	 *
	 * @return string The generated HTML.
	 */
	public function render(string $content): string;
}

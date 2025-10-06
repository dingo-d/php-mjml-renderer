<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements;

/**
 * Element interface
 *
 * @since 1.0.0
 */
interface Element
{
	public function render(): string;

	/**
	 * @return array<string, array<string, mixed>>
	 */
	public function getStyles(): array;
}

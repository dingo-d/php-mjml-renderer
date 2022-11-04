<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Parser;

/**
 * Node interface
 *
 * @since 1.0.0
 */
interface Node
{
	/**
	 * Get the identifier of the current tag
	 *
	 * Example: mj-body
	 *
	 * @return string
	 */
	public function getTag(): string;

	/**
	 * Get the name of the current tag
	 *
	 * Example: column (for mj-column)
	 *
	 * @return string
	 */
	public function getTagName(): string;

	/**
	 * Check if the current tag is self closing or not
	 *
	 * @return bool
	 */
	public function isSelfClosing(): bool;

	/**
	 * Get all attributes assigned to a current element
	 *
	 * To-do: could be attributes object?
	 *
	 * @return array<mixed>
	 */
	public function getAttributes(): array;

	/**
	 * Get the content of the element
	 *
	 * Could be a string in case there is just a string content,
	 * or an array of node elements.
	 *
	 * @return Node[]|string
	 */
	public function getInnerContent();
}

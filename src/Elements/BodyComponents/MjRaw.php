<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

/**
 * Mjml Raw Element
 *
 * Displays raw HTML that is not going to be parsed by the MJML engine.
 * Anything left inside this tag should be raw, responsive HTML.
 *
 * @link https://documentation.mjml.io/#mj-raw
 *
 * @since 1.0.0
 */
class MjRaw extends AbstractElement
{
	public const string TAG_NAME = 'mj-raw';

	public const bool ENDING_TAG = true;

	/**
	 * List of allowed attributes on the element
	 *
	 * mj-raw has no attributes - it only passes through content
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [];

	protected array $defaultAttributes = [];

	/**
	 * Override getContent to preserve raw content without trimming
	 */
	protected function getContent(): string
	{
		return $this->content;
	}

	public function render(): string
	{
		// Return content as-is without any processing
		return $this->getContent();
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		// No styles needed for raw HTML passthrough
		return [];
	}
}

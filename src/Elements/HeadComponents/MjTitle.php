<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

/**
 * Mjml Title Element
 *
 * @link https://documentation.mjml.io/#mj-title
 *
 * @since 1.0.0
 */
class MjTitle extends AbstractElement
{
	public const string TAG_NAME = 'mj-title';

	public const bool ENDING_TAG = true;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [];

	protected array $defaultAttributes = [];

	public function render(): string
	{
		$content = $this->getContent();

		return "<title>$content</title>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

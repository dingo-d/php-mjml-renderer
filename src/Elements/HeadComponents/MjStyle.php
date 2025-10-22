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
 * Mjml Style Element
 *
 * @link https://documentation.mjml.io/#mj-style
 *
 * @since 1.0.0
 */
class MjStyle extends AbstractElement
{
	public const string TAG_NAME = 'mj-style';

	public const bool ENDING_TAG = true;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'inline' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'whether styles should be inlined',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [];

	public function render(): string
	{
		$content = $this->getContent();
		$inline = $this->getAttribute('inline');

		// For now, we'll always render as a style tag in head
		// Inline styles would require processing during body rendering
		return "<style type=\"text/css\">$content</style>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

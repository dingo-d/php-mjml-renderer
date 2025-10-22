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
 * Mjml Font Element
 *
 * @link https://documentation.mjml.io/#mj-font
 *
 * @since 1.0.0
 */
class MjFont extends AbstractElement
{
	public const string TAG_NAME = 'mj-font';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'name' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'font name',
			'default_value' => '',
		],
		'href' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'font url',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [];

	public function render(): string
	{
		$name = $this->getAttribute('name');
		$href = $this->getAttribute('href');

		if (!$href) {
			return '';
		}

		// Render as a link tag for non-MSO clients
		return "<!--[if !mso]><!--><link href=\"$href\" rel=\"stylesheet\" type=\"text/css\"><!--<![endif]-->";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

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
use MadeByDenis\PhpMjmlRenderer\Elements\Helpers\ConditionalTag;

/**
 * Mjml Body Element
 *
 * @link https://documentation.mjml.io/#mj-body
 *
 * @since 1.0.0
 */
class MjBody extends AbstractElement
{
	use ConditionalTag;

	public const TAG_NAME = 'mj-body';

	public const ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'body background color',
			'default_value' => 'n/a',
		],
		'width' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'The width of the element',
			'default_value' => '600px',
		],
	];

	protected array $defaultAttributes = [
		'width' => '600px',
	];

	public function render(): string
	{
		$context = $this->getContext(); // To be set with the bg color setter.

		// Fetch from globals.
		$globalData = $this->getGlobalAttributes();
		$lang = $globalData['lang'];
		$dir = $globalData['dir'];

		$htmlAttributes = $this->getHtmlAttributes([
			'class' => $this->getAttribute('css-class'),
			'style' => 'div',
			$lang,
			$dir,
		]);

		// Set bg color.

		$content = $this->renderChildren();

		return "<div $htmlAttributes>$content</div>";
	}

	public function getChildContext(): array
	{
		return [
			...$this->context,
			'containerWidth' => $this->getAttribute('width'),
		];
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'div' => [
				'background-color' => $this->getAttribute('background-color'),
			]
		];
	}
}

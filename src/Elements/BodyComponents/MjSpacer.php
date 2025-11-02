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
 * Mjml Spacer Element
 *
 * @link https://documentation.mjml.io/#mj-spacer
 *
 * @since 1.0.0
 */
class MjSpacer extends AbstractElement
{
	public const string TAG_NAME = 'mj-spacer';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'container-background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'inner element background color',
			'default_value' => '',
		],
		'css-class' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'class name added to root HTML element',
			'default_value' => '',
		],
		'height' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'spacer height',
			'default_value' => '20px',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'supports up to 4 parameters',
			'default_value' => '',
		],
		'padding-top' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'top offset',
			'default_value' => '',
		],
		'padding-bottom' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'bottom offset',
			'default_value' => '',
		],
		'padding-left' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'left offset',
			'default_value' => '',
		],
		'padding-right' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'right offset',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [
		'height' => '20px',
	];

	public function render(): string
	{
		$divAttributes = $this->getHtmlAttributes([
			'style' => 'div',
		]);

		return "<div $divAttributes>&nbsp;</div>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'div' => [
				'height' => $this->getAttribute('height'),
				'line-height' => $this->getAttribute('height'),
			],
		];
	}
}

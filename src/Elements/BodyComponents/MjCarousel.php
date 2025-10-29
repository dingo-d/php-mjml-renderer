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
 * Mjml Carousel Element
 *
 * Displays an interactive image carousel with navigation.
 *
 * @link https://documentation.mjml.io/#mj-carousel
 *
 * @since 1.0.0
 */
class MjCarousel extends AbstractElement
{
	public const string TAG_NAME = 'mj-carousel';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'align' => [
			'unit' => 'string',
			'type' => 'alignment',
			'description' => 'horizontal alignment',
			'default_value' => 'center',
		],
		'border-radius' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'border radius',
			'default_value' => '',
		],
		'container-background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'column background color',
			'default_value' => '',
		],
		'icon-width' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'width of icons',
			'default_value' => '44px',
		],
		'left-icon' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon on the left',
			'default_value' => 'https://i.imgur.com/xTh3hln.png',
		],
		'right-icon' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon on the right',
			'default_value' => 'https://i.imgur.com/os7o9kz.png',
		],
		'thumbnails' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'display or not thumbnails (visible/hidden)',
			'default_value' => 'visible',
		],
	];

	protected array $defaultAttributes = [
		'align' => 'center',
		'icon-width' => '44px',
		'left-icon' => 'https://i.imgur.com/xTh3hln.png',
		'right-icon' => 'https://i.imgur.com/os7o9kz.png',
		'thumbnails' => 'visible',
	];

	public function render(): string
	{
		$divAttributes = $this->getHtmlAttributes([
			'style' => 'div',
		]);

		$children = $this->getChildren() ?? [];
		$content = $this->renderChildren($children, []);

		return "<div $divAttributes>$content</div>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'div' => [
				'text-align' => $this->getAttribute('align'),
				'border-radius' => $this->getAttribute('border-radius'),
			],
		];
	}
}

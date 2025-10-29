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
 * Mjml Accordion Element
 *
 * Accordion is an interactive component to stack content in tabs,
 * so the information is collapsed and only the titles are visible.
 *
 * @link https://documentation.mjml.io/#mj-accordion
 *
 * @since 1.0.0
 */
class MjAccordion extends AbstractElement
{
	public const string TAG_NAME = 'mj-accordion';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'border' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'border',
			'default_value' => '2px solid black',
		],
		'container-background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'background color of the cell',
			'default_value' => '',
		],
		'css-class' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'class name added to root HTML element',
			'default_value' => '',
		],
		'font-family' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'font family',
			'default_value' => 'Ubuntu, Helvetica, Arial, sans-serif',
		],
		'icon-align' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon alignment (top/middle/bottom)',
			'default_value' => 'middle',
		],
		'icon-height' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'icon height',
			'default_value' => '32px',
		],
		'icon-position' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon position (left/right)',
			'default_value' => 'right',
		],
		'icon-unwrapped-url' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon when accordion is unwrapped',
			'default_value' => 'https://i.imgur.com/bIXv1bk.png',
		],
		'icon-wrapped-url' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon when accordion is wrapped',
			'default_value' => 'https://i.imgur.com/w4uTygT.png',
		],
		'icon-width' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'icon width',
			'default_value' => '32px',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'supports up to 4 parameters',
			'default_value' => '10px 25px',
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
		'padding-top' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'top offset',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [
		'border' => '2px solid black',
		'font-family' => 'Ubuntu, Helvetica, Arial, sans-serif',
		'icon-align' => 'middle',
		'icon-height' => '32px',
		'icon-position' => 'right',
		'icon-unwrapped-url' => 'https://i.imgur.com/bIXv1bk.png',
		'icon-wrapped-url' => 'https://i.imgur.com/w4uTygT.png',
		'icon-width' => '32px',
		'padding' => '10px 25px',
	];

	public function render(): string
	{
		$children = $this->getChildren() ?? [];
		$content = $this->renderChildren($children, []);

		return $content;
	}

	/**
	 * Gets the context for child elements.
	 *
	 * @return array<string, mixed>
	 */
	public function getChildContext(): array
	{
		return [
			...$this->context,
			'border' => $this->getAttribute('border'),
			'font-family' => $this->getAttribute('font-family'),
			'icon-align' => $this->getAttribute('icon-align'),
			'icon-height' => $this->getAttribute('icon-height'),
			'icon-position' => $this->getAttribute('icon-position'),
			'icon-unwrapped-url' => $this->getAttribute('icon-unwrapped-url'),
			'icon-wrapped-url' => $this->getAttribute('icon-wrapped-url'),
			'icon-width' => $this->getAttribute('icon-width'),
		];
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

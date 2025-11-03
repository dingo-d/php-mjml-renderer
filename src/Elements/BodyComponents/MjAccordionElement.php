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
 * Individual accordion item that contains title and text.
 *
 * @link https://documentation.mjml.io/#mj-accordion-element
 *
 * @since 1.0.0
 */
class MjAccordionElement extends AbstractElement
{
	public const string TAG_NAME = 'mj-accordion-element';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'background color',
			'default_value' => '',
		],
		'border' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'border',
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
			'default_value' => '',
		],
		'icon-align' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon alignment (top/middle/bottom)',
			'default_value' => '',
		],
		'icon-height' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'icon height',
			'default_value' => '',
		],
		'icon-position' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon position (left/right)',
			'default_value' => '',
		],
		'icon-unwrapped-url' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon when accordion is unwrapped',
			'default_value' => '',
		],
		'icon-wrapped-url' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'icon when accordion is wrapped',
			'default_value' => '',
		],
		'icon-width' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'icon width',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [];

	public function render(): string
	{
		$divAttributes = $this->getHtmlAttributes([
			'class' => $this->getAttribute('css-class'),
			'style' => 'div',
		]);

		$children = $this->getChildren() ?? [];
		$content = $this->renderChildren($children, []);

		return "<div $divAttributes>$content</div>";
	}

	/**
	 * Gets the context for child elements.
	 *
	 * @return array<string, mixed>
	 */
	public function getChildContext(): array
	{
		$fontFamily = $this->getAttribute('font-family') ?:
			$this->context['font-family'] ?? 'Ubuntu, Helvetica, Arial, sans-serif';

		return [
			...$this->context,
			'background-color' => $this->getAttribute('background-color') ?:
				$this->context['background-color'] ?? '',
			'border' => $this->getAttribute('border') ?: $this->context['border'] ?? '',
			'font-family' => $fontFamily,
			'icon-align' => $this->getAttribute('icon-align') ?:
				$this->context['icon-align'] ?? 'middle',
			'icon-height' => $this->getAttribute('icon-height') ?:
				$this->context['icon-height'] ?? '32px',
			'icon-position' => $this->getAttribute('icon-position') ?:
				$this->context['icon-position'] ?? 'right',
			'icon-unwrapped-url' => $this->getAttribute('icon-unwrapped-url') ?:
				$this->context['icon-unwrapped-url'] ?? '',
			'icon-wrapped-url' => $this->getAttribute('icon-wrapped-url') ?:
				$this->context['icon-wrapped-url'] ?? '',
			'icon-width' => $this->getAttribute('icon-width') ?:
				$this->context['icon-width'] ?? '32px',
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
				'border' => $this->getAttribute('border'),
			],
		];
	}
}

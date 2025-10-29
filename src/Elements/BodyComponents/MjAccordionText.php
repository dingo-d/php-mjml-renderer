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
 * Mjml Accordion Text Element
 *
 * Collapsible content for accordion items.
 *
 * @link https://documentation.mjml.io/#mj-accordion-text
 *
 * @since 1.0.0
 */
class MjAccordionText extends AbstractElement
{
	public const string TAG_NAME = 'mj-accordion-text';

	public const bool ENDING_TAG = true;

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
		'color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'text color',
			'default_value' => '#000000',
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
		'font-size' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'font size',
			'default_value' => '13px',
		],
		'font-weight' => [
			'unit' => 'number',
			'type' => 'number',
			'description' => 'font weight',
			'default_value' => '',
		],
		'letter-spacing' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'letter spacing',
			'default_value' => 'none',
		],
		'line-height' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'line height',
			'default_value' => '1',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'supports up to 4 parameters',
			'default_value' => '16px',
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
		'color' => '#000000',
		'font-size' => '13px',
		'letter-spacing' => 'none',
		'line-height' => '1',
		'padding' => '16px',
	];

	public function render(): string
	{
		$tdAttributes = $this->getHtmlAttributes([
			'class' => $this->getAttribute('css-class'),
			'style' => 'td',
		]);

		$content = $this->getContent();

		return "<td $tdAttributes>$content</td>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		$fontFamily = $this->getAttribute('font-family') ?:
			$this->context['font-family'] ?? 'Ubuntu, Helvetica, Arial, sans-serif';

		return [
			'td' => [
				'background-color' => $this->getAttribute('background-color'),
				'color' => $this->getAttribute('color'),
				'font-family' => $fontFamily,
				'font-size' => $this->getAttribute('font-size'),
				'font-weight' => $this->getAttribute('font-weight'),
				'letter-spacing' => $this->getAttribute('letter-spacing'),
				'line-height' => $this->getAttribute('line-height'),
				'padding' => $this->getAttribute('padding'),
				'padding-bottom' => $this->getAttribute('padding-bottom'),
				'padding-left' => $this->getAttribute('padding-left'),
				'padding-right' => $this->getAttribute('padding-right'),
				'padding-top' => $this->getAttribute('padding-top'),
			],
		];
	}
}

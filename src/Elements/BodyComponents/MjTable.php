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
 * Mjml Table Element
 *
 * @link https://documentation.mjml.io/#mj-table
 *
 * @since 1.0.0
 */
class MjTable extends AbstractElement
{
	public const string TAG_NAME = 'mj-table';

	public const bool ENDING_TAG = true;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'align' => [
			'unit' => 'string',
			'type' => 'alignment',
			'description' => 'table alignment',
			'default_value' => 'left',
		],
		'border' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'css border definition',
			'default_value' => 'none',
		],
		'cellpadding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'space between cells',
			'default_value' => '0',
		],
		'cellspacing' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'space between cell and border',
			'default_value' => '0',
		],
		'color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'text color',
			'default_value' => '#000000',
		],
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
		'font-family' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'font',
			'default_value' => 'Ubuntu, Helvetica, Arial, sans-serif',
		],
		'font-size' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'text size',
			'default_value' => '13px',
		],
		'line-height' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'space between lines',
			'default_value' => '22px',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'supports up to 4 parameters',
			'default_value' => '10px 25px',
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
		'role' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'ARIA role attribute',
			'default_value' => 'presentation',
		],
		'table-layout' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'auto/fixed/initial/inherit',
			'default_value' => 'auto',
		],
		'width' => [
			'unit' => 'px,%',
			'type' => 'measure',
			'description' => 'table width',
			'default_value' => '100%',
		],
	];

	protected array $defaultAttributes = [
		'align' => 'left',
		'border' => 'none',
		'cellpadding' => '0',
		'cellspacing' => '0',
		'color' => '#000000',
		'font-family' => 'Ubuntu, Helvetica, Arial, sans-serif',
		'font-size' => '13px',
		'line-height' => '22px',
		'padding' => '10px 25px',
		'role' => 'presentation',
		'table-layout' => 'auto',
		'width' => '100%',
	];

	public function render(): string
	{
		$tableAttributes = $this->getHtmlAttributes([
			'style' => 'table',
		]);

		$content = $this->getContent();

		return "<table $tableAttributes>$content</table>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'table' => [
				'color' => $this->getAttribute('color'),
				'font-family' => $this->getAttribute('font-family'),
				'font-size' => $this->getAttribute('font-size'),
				'line-height' => $this->getAttribute('line-height'),
				'table-layout' => $this->getAttribute('table-layout'),
				'width' => $this->getAttribute('width'),
				'border' => $this->getAttribute('border'),
			],
		];
	}
}

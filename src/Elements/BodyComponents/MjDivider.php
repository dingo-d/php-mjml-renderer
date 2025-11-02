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
 * Mjml Divider Element
 *
 * @link https://documentation.mjml.io/#mj-divider
 *
 * @since 1.0.0
 */
class MjDivider extends AbstractElement
{
	public const string TAG_NAME = 'mj-divider';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'border-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'divider color',
			'default_value' => '#000000',
		],
		'border-style' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'dashed/dotted/solid',
			'default_value' => 'solid',
		],
		'border-width' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'divider width',
			'default_value' => '4px',
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
		'width' => [
			'unit' => 'px,%',
			'type' => 'measure',
			'description' => 'divider width',
			'default_value' => '100%',
		],
	];

	protected array $defaultAttributes = [
		'border-color' => '#000000',
		'border-style' => 'solid',
		'border-width' => '4px',
		'padding' => '10px 25px',
		'width' => '100%',
	];

	public function render(): string
	{
		$pAttributes = $this->getHtmlAttributes([
			'style' => 'p',
		]);

		return "<p $pAttributes></p>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'p' => [
				'border-top' => $this->getAttribute('border-width') . ' ' .
					$this->getAttribute('border-style') . ' ' .
					$this->getAttribute('border-color'),
				'font-size' => '1px',
				'margin' => '0px auto',
				'width' => $this->getAttribute('width'),
			],
		];
	}
}

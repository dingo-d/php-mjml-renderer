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
 * Mjml Wrapper Element
 *
 * Wrapper enables to wrap multiple sections together and provide
 * a full-width background.
 *
 * @link https://documentation.mjml.io/#mj-wrapper
 *
 * @since 1.0.0
 */
class MjWrapper extends AbstractElement
{
	public const string TAG_NAME = 'mj-wrapper';

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
			'description' => 'wrapper background color',
			'default_value' => '',
		],
		'background-url' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper background image url',
			'default_value' => '',
		],
		'background-repeat' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper background repeat value',
			'default_value' => 'repeat',
		],
		'background-size' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper background size',
			'default_value' => 'auto',
		],
		'background-position' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper background position',
			'default_value' => 'top center',
		],
		'background-position-x' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper background position x value',
			'default_value' => '',
		],
		'background-position-y' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper background position y value',
			'default_value' => '',
		],
		'border' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper border format',
			'default_value' => 'none',
		],
		'border-bottom' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper border bottom',
			'default_value' => '',
		],
		'border-left' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper border left',
			'default_value' => '',
		],
		'border-radius' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'wrapper border radius',
			'default_value' => '',
		],
		'border-right' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper border right',
			'default_value' => '',
		],
		'border-top' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'wrapper border top',
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
			'type' => 'string',
			'description' => 'supports up to 4 parameters',
			'default_value' => '20px 0',
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
		'text-align' => [
			'unit' => 'string',
			'type' => 'alignment',
			'description' => 'left/right/center/justify',
			'default_value' => 'center',
		],
	];

	protected array $defaultAttributes = [
		'background-repeat' => 'repeat',
		'background-size' => 'auto',
		'background-position' => 'top center',
		'border' => 'none',
		'padding' => '20px 0',
		'text-align' => 'center',
	];

	public function render(): string
	{
		$tableAttributes = $this->getHtmlAttributes([
			'align' => 'center',
			'class' => $this->getAttribute('css-class'),
			'background' => $this->getAttribute('background-url'),
			'border' => '0',
			'cellpadding' => '0',
			'cellspacing' => '0',
			'role' => 'presentation',
			'style' => 'table',
		]);

		$tdAttributes = $this->getHtmlAttributes([
			'style' => 'td',
		]);

		$children = $this->getChildren() ?? [];
		$content = $this->renderChildren($children, []);

		return "<table $tableAttributes>
			<tbody>
				<tr>
					<td $tdAttributes>
						$content
					</td>
				</tr>
			</tbody>
		</table>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		$background = $this->getAttribute('background-url') ?
			[
				'background' => $this->getBackground(),
				'background-position' => $this->getAttribute('background-position'),
				'background-repeat' => $this->getAttribute('background-repeat'),
				'background-size' => $this->getAttribute('background-size'),
			] :
			[
				'background' => $this->getAttribute('background-color'),
				'background-color' => $this->getAttribute('background-color'),
			];

		return [
			'table' => array_merge($background, [
				'width' => '100%',
				'border-radius' => $this->getAttribute('border-radius'),
			]),
			'td' => [
				'border' => $this->getAttribute('border'),
				'border-bottom' => $this->getAttribute('border-bottom'),
				'border-left' => $this->getAttribute('border-left'),
				'border-right' => $this->getAttribute('border-right'),
				'border-top' => $this->getAttribute('border-top'),
				'direction' => 'ltr',
				'font-size' => '0px',
				'padding' => $this->getAttribute('padding'),
				'padding-bottom' => $this->getAttribute('padding-bottom'),
				'padding-left' => $this->getAttribute('padding-left'),
				'padding-right' => $this->getAttribute('padding-right'),
				'padding-top' => $this->getAttribute('padding-top'),
				'text-align' => $this->getAttribute('text-align'),
			],
		];
	}

	private function getBackground(): string
	{
		$bgUrl = $this->getAttribute('background-url');
		$bgSize = $this->getAttribute('background-size');

		$backgroundParts = [];

		if ($this->getAttribute('background-color')) {
			$backgroundParts[] = $this->getAttribute('background-color');
		}

		if ($bgUrl) {
			$backgroundParts[] = "url('$bgUrl')";
			$backgroundParts[] = $this->getAttribute('background-position');
			$backgroundParts[] = "/ $bgSize";
			$backgroundParts[] = $this->getAttribute('background-repeat');
		}

		return implode(' ', array_filter($backgroundParts));
	}
}

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
 * Mjml Hero Element
 *
 * Displays a hero image with text overlay.
 *
 * @link https://documentation.mjml.io/#mj-hero
 *
 * @since 1.0.0
 */
class MjHero extends AbstractElement
{
	public const string TAG_NAME = 'mj-hero';

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
			'description' => 'hero background color',
			'default_value' => '#ffffff',
		],
		'background-height' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'height of the image used',
			'default_value' => '',
		],
		'background-position' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'background image position',
			'default_value' => 'center center',
		],
		'background-url' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'background image url',
			'default_value' => '',
		],
		'background-width' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'width of the image used',
			'default_value' => '',
		],
		'border-radius' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'border radius',
			'default_value' => '',
		],
		'height' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'hero section height',
			'default_value' => '',
		],
		'mode' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'fluid-height or fixed-height',
			'default_value' => 'fluid-height',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'supports up to 4 parameters',
			'default_value' => '0px',
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
		'vertical-align' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'content vertical alignment (top/middle/bottom)',
			'default_value' => 'top',
		],
		'width' => [
			'unit' => 'px',
			'type' => 'string',
			'description' => 'hero container width',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [
		'background-color' => '#ffffff',
		'background-position' => 'center center',
		'mode' => 'fluid-height',
		'padding' => '0px',
		'vertical-align' => 'top',
	];

	public function render(): string
	{
		$divAttributes = $this->getHtmlAttributes([
			'style' => 'div',
		]);

		$tableAttributes = $this->getHtmlAttributes([
			'background' => $this->getAttribute('background-url'),
			'border' => '0',
			'cellpadding' => '0',
			'cellspacing' => '0',
			'role' => 'presentation',
			'style' => 'table',
		]);

		$trAttributes = $this->getHtmlAttributes([
			'style' => 'tr',
		]);

		$tdAttributes = $this->getHtmlAttributes([
			'style' => 'td',
		]);

		$children = $this->getChildren() ?? [];
		$content = $this->renderChildren($children, []);

		return "<div $divAttributes>
			<table $tableAttributes>
				<tbody>
					<tr $trAttributes>
						<td $tdAttributes>
							$content
						</td>
					</tr>
				</tbody>
			</table>
		</div>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		$isFixedHeight = $this->getAttribute('mode') === 'fixed-height';
		$height = $this->getAttribute('height');

		return [
			'div' => [
				'margin' => '0 auto',
				'max-width' => $this->getAttribute('width'),
				'border-radius' => $this->getAttribute('border-radius'),
			],
			'table' => [
				'width' => '100%',
				'background-color' => $this->getAttribute('background-color'),
				'background-position' => $this->getAttribute('background-position'),
				'background-repeat' => 'no-repeat',
				'background-size' => 'cover',
				'border-radius' => $this->getAttribute('border-radius'),
			],
			'tr' => [
				'vertical-align' => $this->getAttribute('vertical-align'),
			],
			'td' => array_merge(
				[
					'padding' => $this->getAttribute('padding'),
					'padding-bottom' => $this->getAttribute('padding-bottom'),
					'padding-left' => $this->getAttribute('padding-left'),
					'padding-right' => $this->getAttribute('padding-right'),
					'padding-top' => $this->getAttribute('padding-top'),
				],
				$isFixedHeight && $height ? ['height' => $height] : []
			),
		];
	}
}

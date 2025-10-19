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
 * Mjml Section Element
 *
 * @link https://documentation.mjml.io/#mj-section
 *
 * @since 1.0.0
 */
class MjSection extends AbstractElement
{
	use ConditionalTag;

	public const string TAG_NAME = 'mj-section';

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
			'description' => 'section background color',
			'default_value' => '#FFFFFF',
		],
		'background-url' => [
			'unit' => 'string',
			'type' => 'url',
			'description' => 'section background image url',
			'default_value' => '',
		],
		'background-repeat' => [
			'unit' => 'string',
			'type' => 'backgroundRepeat', // To-do: create a new validator for this.
			'description' => 'section background repeat value',
			'default_value' => 'repeat',
		],
		'background-size' => [
			'unit' => 'string',
			'type' => 'backgroundSize', // To-do: create a new validator for this.
			'description' => 'section background size',
			'default_value' => 'auto',
		],
		'background-position' => [
			'unit' => 'string',
			'type' => 'backgroundPosition', // To-do: create a new validator for this.
			'description' => 'section background position',
			'default_value' => 'top center',
		],
		'background-position-x' => [
			'unit' => 'string',
			'type' => 'backgroundPosition',
			'description' => 'section background position x value',
			'default_value' => '',
		],
		'background-position-y' => [
			'unit' => 'string',
			'type' => 'backgroundPosition',
			'description' => 'section background position y value',
			'default_value' => '',
		],
		'border' => [
			'unit' => 'string',
			'type' => 'border', // To-do: create a new validator for this.
			'description' => 'section border format',
			'default_value' => 'none',
		],
		'border-bottom' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'section border bottom format',
			'default_value' => '',
		],
		'border-left' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'section border bottom format',
			'default_value' => '',
		],
		'border-radius' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'section border radius format',
			'default_value' => '',
		],
		'border-right' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'section border right format',
			'default_value' => '',
		],
		'border-top' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'section border top format',
			'default_value' => '',
		],
		'css-class' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'class name, added to the root HTML element created',
			'default_value' => '',
		],
		'direction' => [
			'unit' => 'string',
			'type' => 'direction', // To-do: create a new validator for this.
			'description' => 'set the display order of direct children',
			'default_value' => 'ltr',
		],
		'full-width' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'make the section full-width',
			'default_value' => '',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'supports up to 4 parameters',
			'default_value' => '20px 0',
		],
		'padding-bottom' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'bottom offset',
			'default_value' => '0',
		],
		'padding-left' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'left offset',
			'default_value' => '0',
		],
		'padding-right' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'right offset',
			'default_value' => '0',
		],
		'padding-top' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'top offset',
			'default_value' => 'initial',
		],
		'text-align' => [
			'unit' => 'string',
			'type' => 'alignment',
			'description' => 'left/right/center/justify',
			'default_value' => 'center',
		],
		'text-padding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'supports up to 4 parameters',
			'default_value' => '4px 4px 4px 0',
		],
	];

	protected array $defaultAttributes = [
		'background-repeat' => 'repeat',
		'background-size' => 'auto',
		'background-position' => 'top center',
		'direction' => 'ltr',
		'padding' => '20px 0',
		'text-align' => 'center',
		'text-padding' => '4px 4px 4px 0',
	];

	public function render(): string
	{
		return $this->isFullWidth() ? $this->renderFullWidth() : $this->renderSimple();
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
			'containerWidth' => $this->getAttribute('width'),
		];
	}

	/**
	 * @return array<string, array<string, mixed>>
	 */
	public function getStyles(): array
	{
		['containerWidth' => $containerWidth] = $this->getChildContext();
		$fullWidth = $this->isFullWidth();

		$background = $this->getAttribute('background-url') ?
			[
				'background' => $this->getBackground(),
				'background-position' => $this->getBackgroundString(),
				'background-repeat' => $this->getAttribute('background-repeat'),
				'background-size' => $this->getAttribute('background-size'),
			] :
			[
				'background' => $this->getAttribute('background-color'),
				'background-color' => $this->getAttribute('background-color'),
			];

		return [
			'div' => [
				'fullWidth' => $fullWidth ? [] : $background,
				'margin' => '0px auto',
				'border-radius' => $this->getAttribute('border-radius'),
				'max-width' => $containerWidth,
			],
			'innerDiv' => [
				'line-height' => 0,
				'font-size' => 0,
			],
			'tableFullwidth' => [
				'fullWidth' => $fullWidth ? $background : [],
				'width' => '100%',
				'border-radius' => $this->getAttribute('border-radius'),
			],
			'table' => [
				'fullWidth' => $fullWidth ? [] : $background,
				'width' => '100%',
				'border-radius' => $this->getAttribute('border-radius'),
			],
			'td' => [
				'border' => $this->getAttribute('border'),
				'border-bottom' => $this->getAttribute('border-bottom'),
				'border-left' => $this->getAttribute('border-left'),
				'border-right' => $this->getAttribute('border-right'),
				'border-top' => $this->getAttribute('border-top'),
				'direction' => $this->getAttribute('direction'),
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

	private function isFullWidth(): bool
	{
		return $this->getAttribute('full-width') === 'full-width';
	}

	private function hasBackground(): bool
	{
		return $this->getAttribute('background-url') != null;
	}

	private function renderFullWidth(): string
	{
		$innerContent = "{$this->renderBefore()}
			{$this->renderSection()}
			{$this->renderAfter()}";

		$content = $this->hasBackground() ?
			$this->renderWithBackground($innerContent) :
			$innerContent;

		$tableAttributes = $this->getHtmlAttributes([
			'align' => 'center',
			'class' => $this->getAttribute('css-class'),
			'background' => $this->getAttribute('background-url'),
			'border' => '0',
			'cellpadding' => '0',
			'cellspacing' => '0',
			'role' => 'presentation',
			'style' => 'tableFullwidth',
		]);

		return "<table $tableAttributes>
			<tbody>
				<tr>
					<td>$content</td>
				</tr>
			</tbody>
		</table>";
	}

	private function renderSimple(): string
	{
		$section = $this->renderSection();

		return
			$this->renderBefore() .
			$this->hasBackground() ? $this->renderWithBackground($section) : $section .
				$this->renderAfter();
	}

	private function renderSection(): string
	{
		$hasBackground = $this->hasBackground();

		$sectionAttributes = $this->getHtmlAttributes([
			'class' => $this->isFullWidth() ? null : $this->getAttribute('css-class'),
			'style' => 'div',
		]);

		$innerDivAttributes = $this->getHtmlAttributes(['style' => 'innerDiv']);

		$tableAttributes = $this->getHtmlAttributes([
			'align' => 'center',
			'background' => $this->isFullWidth() ? null : $this->getAttribute('background-url'),
			'border' => '0',
			'cellpadding' => '0',
			'cellspacing' => '0',
			'role' => 'presentation',
			'style' => 'table',
		]);

		$tdAttributes = $this->getHtmlAttributes([
			'style' => 'td',
		]);

		$bgWrapperOpener = $hasBackground ? "<div $innerDivAttributes>" : '';
		$bgWrapperCloser = $hasBackground ? '</div>' : '';

		// Get child nodes.
		$children = $this->getChildren() ?? [];
		$content = $this->renderWrappedChildren($children);

		return "
			<div $sectionAttributes>
				$bgWrapperOpener
					<table $tableAttributes>
						<tbody>
						<tr>
							<td $tdAttributes>
							<!--[if mso | IE]>
								<table role='presentation' border='0' cellpadding='0' cellspacing='0'>
							<![endif]-->
								$content
							<!--[if mso | IE]>
								</table>
							<![endif]-->
							</td>
						</tr>
						</tbody>
					</table>
				$bgWrapperCloser
			</div>
		";
	}

	private function renderBefore(): string
	{
		['containerWidth' => $containerWidth] = $this->getChildContext();

		$bgColorAttr = $this->getAttribute('background-color') ?
			['bgcolor' => $this->getAttribute('background-color')] :
			[];

		$tableAttributes = [
			'align' => 'center',
			'border' => '0',
			'cellpadding' => '0',
			'cellspacing' => '0',
			'class' => $this->suffixCssClasses($this->getAttribute('css-class'), 'outlook'),
			'role' => 'presentation',
			'style' => ['width' => $containerWidth],
			'width' => (int)$containerWidth,
		];

		$tableAttributes = $this->getHtmlAttributes($tableAttributes + $bgColorAttr);

		return "<!--[if mso | IE]>
			<table $tableAttributes>
				<tr>
					<td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
		<![endif]-->";
	}

	private function renderAfter(): string
	{
		return "<!--[if mso | IE]>
					</td>
				</tr>
			</table>
		<![endif]-->";
	}

	/**
	 * Renders children wrapped in conditional tags for Outlook/IE.
	 *
	 * @param array<int, \MadeByDenis\PhpMjmlRenderer\Node> $children Child elements to render.
	 *
	 * @throws \Exception
	 * @return string
	 */
	private function renderWrappedChildren(array $children): string
	{
		$content = $this->renderChildren($children, []);

//		${this.renderChildren(children, {
//	        renderer: (component) =>
//	          component.constructor.isRawElement()
//		          ? component.render()
//		          : "
//	          <!--[if mso | IE]>
//	            <td
//	              ${component.gethtmlAttributes({
//	                align: component.getAttribute('align'),
//	                class: suffixCssClasses(
//		component.getAttribute('css-class'),
//	                  'outlook',
//	                ),
//	                style: 'tdOutlook',
//	              })}
//	            >
//	          <![endif]-->
//	            ${component.render()}
//	          <!--[if mso | IE]>
//	            </td>
//	          <![endif]-->
//	    ",
//	      })}

		return "<!--[if mso | IE]>
			<tr>
			<![endif]-->
				$content
			<!--[if mso | IE]>
			</tr>
		<![endif]-->";
	}

	private function renderWithBackground(string $content): string
	{
		$fullWidth = $this->isFullWidth();
		['containerWidth' => $containerWidth] = $this->getChildContext();

		$isPercentage = fn($str) => preg_match('/^\d+(\.\d+)?%$/', $str);

		$vSizeAttributes = [];
		['posX' => $bgPosX, 'posY' => $bgPosY] = $this->getBackgroundPosition();

		switch ($bgPosX) {
			case 'left':
				$bgPosX = '0%';
				break;
			case 'center':
				$bgPosX = '50%';
				break;
			case 'right':
				$bgPosX = '100%';
				break;
			default:
				if (!$isPercentage($bgPosX)) {
					$bgPosX = '50%';
				}
				break;
		}

		switch ($bgPosY) {
			case 'top':
				$bgPosY = '0%';
				break;
			case 'center':
				$bgPosY = '50%';
				break;
			case 'bottom':
				$bgPosY = '100%';
				break;
			default:
				if (!$isPercentage($bgPosY)) {
					$bgPosY = '0%';
				}
				break;
		}

		[[$vOriginX, $vPosX], [$vOriginY, $vPosY]] = array_map(
			function ($coordinate) use ($bgPosX, $bgPosY, $isPercentage) {
				$isX = $coordinate === 'x';
				$bgRepeat = $this->getAttribute('background-repeat') === 'repeat';

				$pos = $isX ? $bgPosX : $bgPosY;

				if ($isPercentage($pos)) {
					preg_match('/^(\d+(\.\d+)?)%$/', $pos, $percentages);
					$percentageValue = $percentages[1]; // Check if this match is correct!
					$decimal = (int)$percentageValue / 100;

					if ($bgRepeat) {
						$pos = $decimal;
						$origin = $decimal;
					} else {
						$pos = (-50 + $decimal * 100) / 100;
						$origin = (-50 + $decimal * 100) / 100;
					}
				} elseif ($bgRepeat) {
					$origin = $isX ? '0.5' : '0';
					$pos = $isX ? '0.5' : '0';
				} else {
					$origin = $isX ? '0' : '-0.5';
					$pos = $isX ? '0' : '-0.5';
				}

				return [$origin, $pos];
			},
			['x', 'y']
		);

		if (
			$this->getAttribute('background-size') === 'cover' ||
			$this->getAttribute('background-size') === 'contain'
		) {
			$vSizeAttributes = [
				'size' => '1,1',
				'aspect' =>
					$this->getAttribute('background-size') === 'cover' ?
						'atleast' :
						'atmost',
			];
		} elseif ($this->getAttribute('background-size') !== 'auto') {
			$bgSplit = explode(' ', $this->getAttribute('background-size'));

			if (count($bgSplit) === 1) {
				$vSizeAttributes = [
					'size' => $this->getAttribute('background-size'),
					'aspect' => 'atmost',
				];
			} else {
				$vSizeAttributes = [
					'size' => implode(',', $bgSplit),
				];
			}
		}

		$vmlType = $this->getAttribute('background-repeat') === 'no-repeat' ? 'frame' : 'tile';

		if ($this->getAttribute('background-size') === 'auto') {
			$vmlType = 'tile';
			[[$vOriginX, $vPosX], [$vOriginY, $vPosY]] = [
				[0.5, 0.5],
				[0, 0],
			];
		}

		$vRectAttributes = $this->gethtmlAttributes([
			'style' => $fullWidth ?
				['mso-width-percent' => '1000'] :
				['width' => $containerWidth],
			'xmlns:v' => 'urn:schemas-microsoft-com:vml',
			'fill' => 'true',
			'stroke' => 'false',
		]);

		$vFillAttributes = $this->gethtmlAttributes([
			'origin' => "$vOriginX, $vOriginY",
			'position' => "$vPosX, $vPosY",
			'src' => $this->getAttribute('background-url'),
			'color' => $this->getAttribute('background-color'),
			'type' => $vmlType,
			...$vSizeAttributes,
		]);

		return "<!--[if mso | IE]>
			<v:rect $vRectAttributes>
				<v:fill $vFillAttributes/>
				<v:textbox style='mso-fit-shape-to-text:true' inset='0,0,0,0'>
					<![endif]-->
						$content
					<!--[if mso | IE]>
				</v:textbox>
			</v:rect>
		<![endif]-->";
	}

	private function getBackground(): string
	{
		$bgUrl = $this->getAttribute('background-url');
		$bgSize = $this->getAttribute('background-size');

		$backgroundParts = [$this->getAttribute('background-color')];

		if ($this->hasBackground()) {
			$backgroundParts[] = "url('$bgUrl')";
			$backgroundParts[] = $this->getBackgroundString();
			$backgroundParts[] = "/ $bgSize";
			$backgroundParts[] = $this->getAttribute('background-repeat');
		}

		return $this->makeBackgroundString($backgroundParts);
	}

	private function getBackgroundString(): string
	{
		['posX' => $posX, 'posY' => $posY] = $this->getBackgroundPosition();

		return "$posX $posY";
	}

	/**
	 * Gets the background position x and y values, considering individual overrides.
	 *
	 * @return array<string, mixed>
	 */
	private function getBackgroundPosition(): array
	{
		['x' => $x, 'y' => $y] = $this->parseBackgroundPosition();

		return [
			'posX' => $this->getAttribute('background-position-x') ?? $x,
			'posY' => $this->getAttribute('background-position-y') ?? $y,
		];
	}

	/**
	 * Parses the background-position attribute into x and y components.
	 *
	 * @return array<string, string>
	 */
	private function parseBackgroundPosition(): array
	{
		$posSplit = explode(' ', $this->getAttribute('background-position'));

		if (count($posSplit) === 1) {
			$val = $posSplit[0];

			if (in_array($val, ['top', 'bottom'], true)) {
				return [
					'x' => 'center',
					'y' => $val,
				];
			}

			return [
				'x' => $val,
				'y' => 'center',
			];
		}

		if (count($posSplit) === 2) {
			$val1 = $posSplit[0];
			$val2 = $posSplit[1];

			if (
				in_array($val1, ['top', 'bottom'], true) ||
				($val1 === 'center' && in_array($val2, ['left', 'right'], true))
			) {
				return [
					'x' => $val2,
					'y' => $val1,
				];
			}

			return [
				'x' => $val1,
				'y' => $val2,
			];
		}

		// Default.
		return [
			'x' => 'center',
			'y' => 'top',
		];
	}

	/**
	 * @param array<int|string, string> $array Array of background properties.
	 */
	private function makeBackgroundString(array $array): string
	{
		return implode(' ', array_filter($array));
	}
}

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
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Elements\Helpers\ConditionalTag;

/**
 * Mjml Column Element
 *
 * @link https://documentation.mjml.io/#mj-column
 *
 * @since 1.0.0
 */
class MjColumn extends AbstractElement
{
	use ConditionalTag;

	public const string TAG_NAME = 'mj-column';

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
			'description' => 'column background color',
			'default_value' => '#FFFFFF',
		],
		'border' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column border format',
			'default_value' => 'none',
		],
		'border-bottom' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column border bottom format',
			'default_value' => '',
		],
		'border-left' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column border bottom format',
			'default_value' => '',
		],
		'border-radius' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'column border radius format',
			'default_value' => '',
		],
		'border-right' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column border right format',
			'default_value' => '',
		],
		'border-top' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column border top format',
			'default_value' => '',
		],
		'direction' => [
			'unit' => 'string',
			'type' => 'direction',
			'description' => 'set the display order of direct children',
			'default_value' => 'ltr',
		],
		'inner-background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'column background color',
			'default_value' => 'none',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'supports up to 4 parameters',
			'default_value' => '0',
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
		'inner-border' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column inner border format',
			'default_value' => 'none',
		],
		'inner-border-bottom' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column inner border bottom format',
			'default_value' => 'none',
		],
		'inner-border-left' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column inner border left format',
			'default_value' => 'none',
		],
		'inner-border-radius' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'column inner border radius format',
			'default_value' => 'none',
		],
		'inner-border-right' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column inner border right format',
			'default_value' => 'none',
		],
		'inner-border-top' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'column inner border top format',
			'default_value' => 'none',
		],
		'vertical-align' => [
			'unit' => 'string',
			'type' => 'verticalAlign',
			'description' => 'column vertical alignment',
			'default_value' => 'top',
		],
		'width' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'The width of the element',
			'default_value' => '600px',
		],
	];

	protected array $defaultAttributes = [
		'direction' => 'ltr',
		'vertical-align' => 'top',
	];

	public function render(): string
	{
		$columnClass = $this->getColumnClass();
		$classesName = "$columnClass mj-outlook-group-fix";
		$classAttribute = $this->getAttribute('css-class');

		if ($this->getAttribute('css-class')) {
			$classesName .= " $classAttribute";
		}

		$columnAttributes = $this->getHtmlAttributes([
			'class' => $classesName,
			'style' => 'div',
		]);

		$content = $this->hasGutter() ? $this->renderGutter() : $this->renderColumn();

		return "<div $columnAttributes>
			$content
		</div>";
	}

	public function getChildContext(): array
	{
		['containerWidth' => $parentWidth] = $this->context;

		$children = $this->getChildren() ?? [];
		$nonRawSiblings = count(array_filter($children, function ($child) {
			// Check if the child is a raw element by creating the element and checking
			$element = ElementFactory::create($child);
			return !$element->isRawElement();
		}));

		$innerBorders = $this->getShorthandBorderValue('left', 'inner-border') + $this->getShorthandBorderValue(
			'right',
			'inner-border'
		);

		$containerWidth = (float)$parentWidth / $nonRawSiblings;
		$containerWidth = $this->getAttribute('width') ?? "{$containerWidth}px";

		['borders' => $borders, 'paddings' => $paddings]  = $this->getBoxWidths();

		$allPaddings = $paddings + $borders + $innerBorders;

		['unit' => $unit, 'parsedWidth' => $parsedWidth] = $this->widthParser($containerWidth, [
			'parseFloatToInt' => false,
		]);

		if ($unit === '%') {
			$width = ((float)$parentWidth * (float)$parsedWidth) / 100 - $allPaddings;
		} else {
			$width = (float)$parsedWidth - $allPaddings;
		}

		$containerWidth = "{$width}px";

		return [
			...$this->context,
			'containerWidth' => $containerWidth,
		];
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		$tableStyle = [
			'background-color' => $this->getAttribute('background-color'),
			'border' => $this->getAttribute('border'),
			'border-bottom' => $this->getAttribute('border-bottom'),
			'border-left' => $this->getAttribute('border-left'),
			'border-radius' => $this->getAttribute('border-radius'),
			'border-right' => $this->getAttribute('border-right'),
			'border-top' => $this->getAttribute('border-top'),
			'vertical-align' => $this->getAttribute('vertical-align'),
		];

		return [
			'div' => [
				'font-size' => '0px',
				'text-align' => 'left',
				'direction' => $this->getAttribute('direction'),
				'display' => 'inline-block',
				'vertical-align' => $this->getAttribute('vertical-align'),
				'width' => $this->getMobileWidth(),
			],
			'table' => [
				...$this->hasGutter()
					? [
						'background-color' => $this->getAttribute('inner-background-color'),
						'border' => $this->getAttribute('inner-border'),
						'border-bottom' => $this->getAttribute('inner-border-bottom'),
						'border-left' => $this->getAttribute('inner-border-left'),
						'border-radius' => $this->getAttribute('inner-border-radius'),
						'border-right' => $this->getAttribute('inner-border-right'),
						'border-top' => $this->getAttribute('inner-border-top'),
					]
					: $tableStyle,
			],
			'tdOutlook' => [
				'vertical-align' => $this->getAttribute('vertical-align'),
				'width' => $this->getWidthAsPixel(),
			],
			'gutter' => [
				...$tableStyle,
				'padding' => $this->getAttribute('padding'),
				'padding-top' => $this->getAttribute('padding-top'),
				'padding-right' => $this->getAttribute('padding-right'),
				'padding-bottom' => $this->getAttribute('padding-bottom'),
				'padding-left' => $this->getAttribute('padding-left'),
			],
		];
	}

	private function renderGutter(): string
	{
		$tableAttributes = $this->getHtmlAttributes([
			'border' => '0',
			'cellpadding' => '0',
			'cellspacing' => '0',
			'role' => 'presentation',
			'width' => '100%',
		]);

		$gutterAttributes = $this->getHtmlAttributes([
			'style' => 'gutter',
		]);

		$column = $this->renderColumn();

		return "<table $tableAttributes>
			<tbody>
				<tr>
					<td $gutterAttributes>
					$column
					</td>
				</tr>
			</tbody>
		</table>";
	}

	private function renderColumn(): string
	{

		$children = $this->getChildren() ?? [];

		$tableAttributes = $this->getHtmlAttributes([
			'border' => '0',
			'cellpadding' => '0',
			'cellspacing' => '0',
			'role' => 'presentation',
			'style' => 'table',
			'width' => '100%',
		]);

		$content = $this->renderChildren($children, []);

		return "<table $tableAttributes>
			<tbody>
				$content
			</tbody>
		</table>";


//		${this.renderChildren(children, {
//            renderer: (component) =>
//              component.constructor.isRawElement()
//                ? component.render()
//                : `
//              <tr>
//                <td
//                  ${component.htmlAttributes({
//                    align: component.getAttribute('align'),
//                    class: component.getAttribute('css-class'),
//                    style: {
//                      background: component.getAttribute(
//                        'container-background-color',
//                      ),
//                      'font-size': '0px',
//                      padding: component.getAttribute('padding'),
//                      'padding-top': component.getAttribute('padding-top'),
//                      'padding-right': component.getAttribute('padding-right'),
//                      'padding-bottom':
//                        component.getAttribute('padding-bottom'),
//                      'padding-left': component.getAttribute('padding-left'),
//                      'word-break': 'break-word',
//                    },
//                  })}
//                >
//                  ${component.render()}
//                </td>
//              </tr>
//            `,
//          })}
	}

	private function getMobileWidth(): string
	{
		return '100%';
//		const { containerWidth } = this.context
//		const { nonRawSiblings } = this.props
//		const width = this.getAttribute('width')
//		const mobileWidth = this.getAttribute('mobileWidth')
//
//		if (mobileWidth !== 'mobileWidth') {
//		  return '100%'
//		}
//		if (width === undefined) {
//		  return `${parseInt(100 / nonRawSiblings, 10)}%`
//		}
//
//		const { unit, parsedWidth } = widthParser(width, {
//		  parseFloatToInt: false,
//		})
//
//		switch (unit) {
//		  case '%':
//		    return width
//		  case 'px':
//		  default:
//		    return `${(parsedWidth / parseInt(containerWidth, 10)) * 100}%`
//		}
	}

	private function getWidthAsPixel(): string
	{
		['containerWidth' => $containerWidth] = $this->context;

		$widthString = $this->getParsedWidth(true);
		if (!is_string($widthString)) {
			throw new \RuntimeException('getParsedWidth with toString=true must return a string');
		}

		['unit' => $unit, 'parsedWidth' => $parsedWidth] = $this->widthParser($widthString, [
			'parseFloatToInt' => false,
		]);

		if ($unit === '%') {
			$pixelValue = ((float)$containerWidth * (float)$parsedWidth) / 100;

			return "{$pixelValue}px";
		}

		return "{$parsedWidth}px";
	}

	/**
	 * @return array<int, string|int|float>|string
	 */
	private function getParsedWidth(bool $toString = false): array | string
	{
		$children = $this->getChildren() ?? [];
		$nonRawSiblings = count(array_filter($children, function ($child) {
			// Get the element from the node, then check if it's raw.
			$element = ElementFactory::create($child);
			return !$element->isRawElement();
		}));

		$percentage = 100 / $nonRawSiblings;

		$width = $this->getAttribute('width') ?? "$percentage%";

		['unit' => $unit, 'parsedWidth' => $parsedWidth] = $this->widthParser($width, [
			'parseFloatToInt' => false,
		]);

		if ($toString) {
			return "$parsedWidth$unit";
		}

		return [
			$unit,
			$parsedWidth,
		];
	}

	private function getColumnClass(): string
	{
		$parsedWidthResult = $this->getParsedWidth();
		if (!is_array($parsedWidthResult)) {
			throw new \RuntimeException('getParsedWidth must return an array when toString is false');
		}
		[$unit, $parsedWidth] = $parsedWidthResult;

		$formattedClassNb = str_replace('.', '-', (string)$parsedWidth);

		$className = match ((string)$unit) {
			'%' => "mj-column-per-$formattedClassNb",
			default => "mj-column-px-$formattedClassNb",
		};

		$this->addMediaQuery($className, (string)$parsedWidth, (string)$unit);

		return $className;
	}

	private function hasGutter(): bool
	{
		$attributes = ['padding', 'padding-bottom', 'padding-left', 'padding-right', 'padding-top'];

		return array_reduce($attributes, function ($carry, $attr) {
			return $carry || $this->getAttribute($attr) !== null;
		}, false);
	}
}

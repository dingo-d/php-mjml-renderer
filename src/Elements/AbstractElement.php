<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements;

use MadeByDenis\PhpMjmlRenderer\Elements\Helpers\{BodyHelpers, CssClasses, JsonHelper};
use MadeByDenis\PhpMjmlRenderer\Validation\TypeValidator;

/**
 * Mjml Text Element
 *
 * @link https://documentation.mjml.io/#mj-text
 *
 * @since 1.0.0
 */
abstract class AbstractElement implements Element
{
	use JsonHelper;
	use CssClasses;
	use BodyHelpers;

	public const TAG_NAME = '';
	public const ENDING_TAG = false;

	protected bool $rawElement = false;

	/**
	 * @var array<string, string>
	 */
	protected array $defaultAttributes = [];

	/**
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [];

	/**
	 * @var array<string, string>
	 */
	protected array $attributes = [];

	/**
	 * @var array<string, mixed>
	 */
	protected array $properties = [];

	/**
	 * @var array<int, \MadeByDenis\PhpMjmlRenderer\Node>|null
	 */
	protected ?array $children;

	/**
	 * @var array<string, mixed>
	 */
	protected array $context = [];
	protected string $content = '';
	protected ?string $absoluteFilePath = null;

	/**
	 * @var array<string, mixed>
	 */
	private array $globalAttributes = [
		'backgroundColor' => '',
		'beforeDoctype' => '',
		'breakpoint' => '480px',
		'classes' => [],
		'classesDefault' => [],
		'defaultAttributes' => [],
		'htmlAttributes' => [],
		'fonts' => '',
		'inlineStyle' => [],
		'headStyle' => [],
		'componentsHeadStyle' => [],
		'headRaw' => [],
		'mediaQueries' => [],
		'preview' => '',
		'style' => [],
		'title' => '',
		'forceOWADesktop' => false,
		'lang' => 'und',
		'dir' => 'auto',
	];

	/**
	 * @param array<string, mixed>|null $attributes
	 * @param array<int, \MadeByDenis\PhpMjmlRenderer\Node>|null $childNodes
	 */
	public function __construct(?array $attributes = [], string $content = '', ?array $childNodes = [])
	{
		$this->attributes = $this->formatAttributes(
			$this->defaultAttributes,
			$this->allowedAttributes,
			$attributes,
		);

		$this->content = $content;
		$this->children = $childNodes;
	}

	public function isEndingTag(): bool
	{
		return static::ENDING_TAG;
	}

	public function getTagName(): string
	{
		return static::TAG_NAME;
	}

	public function isRawElement(): bool
	{
		return $this->rawElement;
	}

	/**
	 * Get the allowed attribute info
	 *
	 * @param string $attributeName Name of the attribute.
	 * @param string $attributeProperty Name of attribute property.
	 *
	 * @return array<string, string>|string Array of properties in case the specific property is empty, property value if not.
	 *
	 */
	public function getAllowedAttributeData(string $attributeName, string $attributeProperty = ''): array | string
	{
		if (!isset($this->allowedAttributes[$attributeName])) {
			throw new \OutOfBoundsException(
				"Attribute {$attributeName} doesn't exist in the allowed attributes array."
			);
		}

		if (empty($attributeProperty)) {
			return $this->allowedAttributes[$attributeName];
		}

		if (!isset($this->allowedAttributes[$attributeName][$attributeProperty])) {
			throw new \OutOfBoundsException(
				"Property {$attributeProperty} doesn't exist in the  {$attributeName} allowed attribute array."
			);
		}

		return $this->allowedAttributes[$attributeName][$attributeProperty];
	}

	/**
	 * @return array<string, mixed>
	 */
	public function getChildContext(): array
	{
		return $this->context;
	}

	/**
	 * Set the rendering context for this element
	 *
	 * @param array<string, mixed> $context
	 * @return void
	 */
	public function setContext(array $context): void
	{
		$this->context = $context;
	}

	/**
	 * @param string $attributeName
	 * @return mixed|null
	 */
	public function getAttribute(string $attributeName): mixed
	{
		return $this->attributes[$attributeName] ?? null;
	}

	/**
	 * Return the globally set attributes
	 *
	 * @return array<string, mixed>
	 */
	public function getGlobalAttributes(): array
	{
		return $this->globalAttributes;
	}

	public function setGlobalAttributes(string $attribute, mixed $value): void
	{
		$this->globalAttributes[$attribute] = $value;
	}

	// To-do: Override the globally set attributes if we override some from the CLI or some options.

	/**
	 * @return array<int, \MadeByDenis\PhpMjmlRenderer\Node>|null
	 */
	protected function getChildren(): ?array
	{
		return $this->children;
	}

	protected function getContent(): string
	{
		return trim($this->content);
	}

	/**
	 * @param array<int|string, mixed> $attributes
	 *
	 * @return string|null
	 */
	protected function getHtmlAttributes(array $attributes): ?string
	{
		// $style is fetched from the $attributes array.
		// If it's not empty, it's passed to the $this->styles() method.
		$style = $attributes['style'] ?? '';

		$specialAttributes = [
			'style' => $this->styles($style),
			'default' => $this->defaultAttributes,
		];

		// Remove numerical keys from the array.
		$attributes = array_filter($attributes, fn($key) => !is_numeric($key), ARRAY_FILTER_USE_KEY);

		$nonEmpty = array_filter($attributes, fn($element) => !empty($element));

		$attrOut = '';

		array_walk($nonEmpty, function ($val, $key) use (&$attrOut, $specialAttributes) {
			$value = isset($specialAttributes[$key]) ?
				$specialAttributes[$key] :
				$val;

			if (is_array($value)) {
				$value = implode('; ', array_map(function ($val, $key) {
					return "$key: $val";
				}, $value, array_keys($value)));
			}

			$attrOut .= "$key=\"$value\" ";
		});

		return trim($attrOut);
	}

	abstract public function getStyles(): array;

	/**
	 * @param string|array<string, mixed> $styles
	 */
	protected function styles(string|array $styles): string
	{
		$stylesArray = [];

		if (!empty($styles)) {
			if (is_string($styles)) {
				$stylesArray = $this->getStyles()[$styles];
			} else {
				$stylesArray = $styles;
			}
		}

		$styles = '';

		array_walk($stylesArray, function ($val, $key) use (&$styles) {
			if (!empty($val)) {
				if (is_array($val)) {
					$val = implode(' ', $val);
				}

				$styles .= "$key:$val;";
			}
		});

		return trim($styles);
	}

	protected function getShorthandAttrValue(string $attribute, string $direction): int
	{
		$mjAttributeDirection = $this->getAttribute("$attribute-$direction");
		$mjAttribute = $this->getAttribute($attribute);

		if ($mjAttributeDirection) {
			return (int)$mjAttributeDirection;
		}

		if (!$mjAttribute) {
			return 0;
		}

		return $this->shorthandParser($mjAttribute, $direction);
	}

	protected function getShorthandBorderValue(string $direction, string $attribute = 'border'): int
	{
		$borderDirection = $this->getAttribute("$attribute-$direction");
		$border = $this->getAttribute($attribute);

		return $this->borderParser($borderDirection ?: ($border ?: '0'));
	}

	/**
	 * Render children elements
	 *
	 * @param array<int, \MadeByDenis\PhpMjmlRenderer\Node> $children
	 * @param array<string, mixed> $options
	 *
	 * @throws \Exception
	 * @return string
	 */
	protected function renderChildren(array $children, array $options = []): string
	{
		$children = $children ?: $this->children;

		if ($this->isRawElement()) {
			return implode("\n", array_map(function ($child) {
				return $this->jsonToXML($child);
			}, $children ?? []));
		}

		$output = '';

		// Get the child context from this element
		$childContext = $this->getChildContext();

		foreach ($children ?? [] as $child) {
			// Render child components with the parent's child context
			$output .= ElementFactory::create($child, $childContext)->render();
		}

		return $output;
	}

	/**
	 * @return array<string, int>
	 */
	protected function getBoxWidths(): array
	{

		['containerWidth' => $containerWidth] = $this->context;

		$parsedWidth = (int)$containerWidth;

		$paddings =
			$this->getShorthandAttrValue('padding', 'right') +
			$this->getShorthandAttrValue('padding', 'left');

		$borders =
			$this->getShorthandBorderValue('right') +
			$this->getShorthandBorderValue('left');

		return [
			'totalWidth' => $parsedWidth,
			'borders' => $borders,
			'paddings' => $paddings,
			'box' => $parsedWidth - $paddings - $borders,
		];
	}

	/**
	 * @param string|int|float $width
	 * @param array<string, mixed> $options
	 * @return array<string, string|int|float>
	 */
	protected function widthParser(string|int|float $width, array $options = []): array
	{
		$defaultOptions = [
			'parseFloatToInt' => true,
		];

		$options = $options + $defaultOptions;

		$widthUnit = preg_match('/[\d.,]*(\D*)$/', (string)$width, $matches) ? $matches[1] : 'px';

		$parseFloatToInt = $options['parseFloatToInt'];

		$unitParsers = [
			'default' => 'intval',
			'px' => 'intval',
			'%' => $parseFloatToInt ? 'intval' : 'floatval',
		];

		$parser = $unitParsers[$widthUnit] ?? $unitParsers['default'];

		return [
			'parsedWidth' => $parser($width),
			'unit' => $widthUnit,
		];
	}

	/**
	 * @param array<string, string> $defaultAttributes
	 * @param array<string, array<string, string>> $allowedAttributes
	 * @param array<string, mixed>|null $passedAttributes
	 * @return array<string, string>
	 */
	private function formatAttributes(
		array $defaultAttributes,
		array $allowedAttributes,
		?array $passedAttributes = []
	): array {
		/*
		 * Check if the attributes are of the proper format based on the allowed attributes.
		 * For instance, if you pass a non string value to the 'align' attribute, you should get an error.
		 * Otherwise you'd get an array of attributes like:
		 *
		 * [
		 *     'background-repeat' => 'repeat',
		 *     'background-size' => 'auto',
		 *     'background-position' => 'top center',
		 *     'direction' => 'ltr',
		 *     'padding' => '20px 0',
		 *     'text-align' => 'center',
		 *     'text-padding' => '4px 4px 4px 0'
		 * ]
		 */

		// Check if the passedAttributes is empty or not, if it is, return the default attributes.
		if (empty($passedAttributes)) {
			return $defaultAttributes;
		}

		// 1. Check if the $passedAttributes are of the proper format based on the $allowedAttributes.
		$result = [];

		// Append `mj-class` to the allowed attributes.
		$allowedAttributes['mj-class'] = [
			'unit' => 'string',
			'description' => 'class name, added to the root HTML element created',
			'default_value' => 'n/a',
		];

		foreach ($passedAttributes as $attrName => $attrVal) {
			if (!isset($allowedAttributes[$attrName])) {
				throw new \InvalidArgumentException(
					"Attribute {$attrName} is not allowed."
				);
			}

			$typeConfig = $allowedAttributes[$attrName];
			$validator = new TypeValidator();

			$typeValue = $typeConfig['type'];

			if (!$validator->getValidator($typeValue)->isValid($attrVal)) {
				throw new \InvalidArgumentException(
					"Attribute {$attrName} must be of type {$typeValue}, {$attrVal} given."
				);
			}

			$result[$attrName] = $attrVal;
		}

		// 2. Check what attributes are the same in the $defaultAttributes and override them, and return them.
		return $result + $defaultAttributes;
	}

	private function shortHandParser(string $cssValue, string $direction): int
	{
		// Convert to PHP.
		$splittedCssValue = preg_split('/\s+/', trim($cssValue), 4);

		if ($splittedCssValue === false || count($splittedCssValue) === 0) {
			return 0;
		}

		switch (count($splittedCssValue)) {
			case 2:
				$directions = ['top' => 0, 'bottom' => 0, 'left' => 1, 'right' => 1];
				break;
			case 3:
				$directions = ['top' => 0, 'left' => 1, 'right' => 1, 'bottom' => 2];
				break;
			case 4:
				$directions = ['top' => 0, 'right' => 1, 'bottom' => 2, 'left' => 3];
				break;
			case 1:
			default:
				return (int)$cssValue;
		}

		return (int)($splittedCssValue[$directions[$direction]] ?? 0);
	}

	private function borderParser(string $border): int
	{
		preg_match('/(?:^| )(\d+)/', $border, $matches);
		return isset($matches[1]) ? (int)$matches[1] : 0;
	}
}

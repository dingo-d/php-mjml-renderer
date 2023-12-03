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

/**
 * Mjml Text Element
 *
 * @link https://documentation.mjml.io/#mj-text
 *
 * @since 1.0.0
 */
abstract class AbstractElement implements Element
{
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

	protected array $children = [];

	protected array $properties = [];

	protected array $globalAttributes = [];

	protected string $context = '';
	protected string $content = '';
	protected ?string $absoluteFilePath = null;

	public function __construct(?array $attributes = [], ?string $content = null)
	{
		$this->attributes = $this->formatAttributes(
			$this->defaultAttributes,
			$this->allowedAttributes,
			$attributes,
		);

		$this->content = $content;
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
	 * @throws \OutOfBoundsException In case attribute name is wrong or property doesn't exist.
	 */
	public function getAllowedAttributeData(string $attributeName, string $attributeProperty = '')
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

	public function getChildContext(): string
	{
		return $this->context;
	}

	/**
	 * @param string $attributeName
	 * @return mixed|null
	 */
	public function getAttribute(string $attributeName)
	{
		return $this->attributes[$attributeName] ?? null;
	}

	protected function getContent(): string
	{
		return trim($this->content);
	}

	/**
	 * @param array<string, string> $attributes
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

		$nonEmpty = array_filter($attributes, fn($element) => !empty($element));

		$attrOut = '';

		array_walk($nonEmpty, function ($val, $key) use (&$attrOut, $specialAttributes) {
			$value = !empty($specialAttributes[$key]) ?
				$specialAttributes[$key] :
				$specialAttributes['default'];

			$attrOut .= "$key=\"$value\"";
		});

		return trim($attrOut);
	}

	abstract public function getStyles(): array;

	protected function styles($styles): string
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
				$styles .= "$key:$val;";
			}
		});

		return trim($styles);
	}

	private function formatAttributes(array $defaultAttributes, array $allowedAttributes, ?array $passedAttributes = []): array
	{
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

		// 2. Check what attributes are the same in the $defaultAttributes and override them.
		// 3. Return all the attributes.


		$result = [];




//
//		foreach ($attributes as $attrName => $attrVal) {
//			if ($allowedAttributes && isset($allowedAttributes[$attrName])) {
//				$typeConfig = $allowedAttributes[$attrName];
//				$TypeConstructor = initializeType($typeConfig);
//
//				if ($TypeConstructor) {
//					$type = new $TypeConstructor($attrVal);
//					$result[$attrName] = $type->getValue();
//				}
//			} else {
//				$result[$attrName] = $attrVal;
//			}
//		}
//
//		return $result;
//
//
//
//
//
//
//
//
//		return [];
	}
}

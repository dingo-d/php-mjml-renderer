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
	protected array $defaultAttributes = [];
	protected array $allowedAttributes = [];
	private array $attributes = [];
	private array $children = [];
	private array $properties = [];
	private array $globalAttributes = [];
	private string $context = '';
	private string $content = '';
	private ?string $absoluteFilePath = null;

	public function __construct()
	{
		$this->attributes = $this->formatAttributes(
			$this->defaultAttributes,
			$this->allowedAttributes,
		);

		return $this;
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

	public function getAttribute(string $attributeName)
	{
		return $this->attributes[$attributeName];
	}

	protected function getContent(): string
	{
		return trim($this->content);
	}

	protected function getHtmlAttributes(array $attributes): string
	{
		$specialAttributes = [
			'style' => fn($style) => $this->styles($style),
			'default' => $this->defaultAttributes,
		];

		$nonEmpty = array_filter($attributes, fn($element) => !empty($element));

		array_walk($nonEmpty, function ($val, $key) use (&$attrOut, $specialAttributes) {
			$value = (!empty($specialAttributes[$key]) ?
				$specialAttributes[$key] :
				$specialAttributes['default'])[$val];

			$attrOut .= " $key=\"$value\"";
		});

		return $attrOut;
	}

	abstract public function getStyles(): array;

	protected function styles($styles)
	{
		$stylesArray = [];

		if (!empty($styles)) {
			if (is_string($styles)) {
				$stylesArray = $this->getStyles()[$styles];
			} else {
				$stylesArray = $styles;
			}
		}

		array_walk($stylesArray, function ($val, $key) use (&$styles) {
			if (!empty($val)) {
				$styles .= " $key=\"$val\"";
			}
		});

		return $styles;
	}

	private function formatAttributes(array $attributes, array $allowedAttributes): array
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
		
		return [];
	}
}

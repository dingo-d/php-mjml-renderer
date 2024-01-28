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

	protected array $globalAttributes = [
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
	 * @var array<mixed, mixed>
	 */
	protected array $context = [];
	protected string $content = '';
	protected ?string $absoluteFilePath = null;

	public function __construct(?array $attributes = [], string $content = '')
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

	public function getChildContext(): array
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

	/**
	 * Return the globally set attributes
	 *
	 * @return array<string, mixed>
	 */
	public function getGlobalAttributes(): array
	{
		return $this->globalAttributes;
	}

	// To-do: Override the globally set attributes if we override some from the CLI or some options.

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

	protected function renderChildren($children, $options = []) {

		$children = $children ?? $this->children;

		//    const {
//      props = {},
//      renderer = component => component.render(),
//      attributes = {},
//      rawXML = false,
//    } = options
//
//    children = children || this.props.children
//
//    if (rawXML) {
//      return children.map(child => jsonToXML(child)).join('\n')
//    }
//
//    const sibling = children.length
//
//    const rawComponents = filter(this.context.components, c => c.isRawElement())
//    const nonRawSiblings = children.filter(
//      child => !find(rawComponents, c => c.getTagName() === child.tagName),
//    ).length
//
//    let output = ''
//    let index = 0
//
//    forEach(children, children => {
//      const component = initComponent({
//        name: children.tagName,
//        initialDatas: {
//          ...children,
//          attributes: {
//            ...attributes,
//            ...children.attributes,
//          },
//          context: this.getChildContext(),
//          props: {
//            ...props,
//            first: index === 0,
//            index,
//            last: index + 1 === sibling,
//            sibling,
//            nonRawSiblings,
//          },
//        },
//      })
//
//      if (component !== null) {
//        output += renderer(component)
//      }
//
//      index++ // eslint-disable-line no-plusplus
//    })

    return $output;
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

			if (!$validator->getValidator($typeValue)->isValid($validator, $attrVal)) {
				throw new \InvalidArgumentException(
					"Attribute {$attrName} must be of type {$typeValue}, {$attrVal} given."
				);
			}

			$result[$attrName] = $attrVal;
		}

		// 2. Check what attributes are the same in the $defaultAttributes and override them, and return them.
		return $result + $defaultAttributes;
	}
}

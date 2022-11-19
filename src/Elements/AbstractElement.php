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
	public const COMPONENT_NAME = '';
	public const ENDING_TAG = false;

	public function isEndingTag(): bool
	{
		return static::ENDING_TAG;
	}

	public function getComponentName(): string
	{
		return static::COMPONENT_NAME;
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
			throw new \OutOfBoundsException("Attribute {$attributeName} doesn't exist in the allowed attributes array.");
		}

		if (empty($attributeProperty)) {
			return $this->allowedAttributes[$attributeName];
		}

		if (!isset($this->allowedAttributes[$attributeName][$attributeProperty])) {
			throw new \OutOfBoundsException("Property {$attributeProperty} doesn't exist in the  {$attributeName} allowed attribute array.");
		}

		return $this->allowedAttributes[$attributeName][$attributeProperty];
	}
}

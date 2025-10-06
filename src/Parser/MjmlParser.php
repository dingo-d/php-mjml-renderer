<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Parser;

use MadeByDenis\PhpMjmlRenderer\Node;
use MadeByDenis\PhpMjmlRenderer\Parser;
use RuntimeException;
use SimpleXMLElement;

use function simplexml_load_string;

/**
 * MJML Parser
 *
 * Parses the source code and returns an array of MjmlNode elements
 *
 * @since 1.0.0
 */
final class MjmlParser implements Parser
{
	public function parse(string $sourceCode): Node
	{
		libxml_use_internal_errors(true);
		$simpleXmlElement = simplexml_load_string($sourceCode);

		// Validate the source code.
		if ($simpleXmlElement === false) {
			libxml_clear_errors();
			throw new RuntimeException('Badly formatted MJML code.');
		}

		libxml_use_internal_errors(false);

		$parser = function (
			SimpleXMLElement $element,
			?Node $parentNode = null,
			array $children = []
		) use (&$parser) {
			$parentNode = new MjmlNode(
				$element->getName(),
				$this->getAttributesArray($element->attributes()),
				null,
				false,
				null
			);

			// Single element.
			if (count($element->children()) === 0) {
				return $this->parseSingleElement($element);
			}

			foreach ($element as $nodeName => $nodeContent) {
				$innerParentNode = new MjmlNode(
					$nodeName,
					$this->getAttributesArray($element->attributes()),
					null,
					false,
					null
				);

				if (!isset($children[$nodeName])) {
					$children[$nodeName] = [];
				}

				assert(is_array($children[$nodeName]));

				if (count($nodeContent->children()) < 2) {
					$children[$nodeName][] = $parser($nodeContent, $innerParentNode);
					continue;
				}

				$children[$nodeName][] = $parser($nodeContent, $innerParentNode);
			}

			unset($innerParentNode, $nodeName, $nodeContent);

			/** @var array<int, array<int, Node>> $childrenValues */
			$childrenValues = array_values($children);
			$childrenFiltered = array_merge(...$childrenValues);

			$parentNode->setChildren($childrenFiltered);

			return $parentNode;
		};

		return $parser($simpleXmlElement);
	}

	private function parseSingleElement(SimpleXMLElement $element): Node
	{
		$attributes = $element->attributes();
		$xml = $element->asXML();

		if (!empty($xml) && str_contains($xml, '/>')) {
			$isSelfClosing = true;
			$value = null;
		} else {
			$isSelfClosing = false;
			$value = trim((string)$element); // should we trim?
		}

		return new MjmlNode(
			$element->getName(),
			$this->getAttributesArray($element->attributes()),
			$value,
			$isSelfClosing,
			null
		);
	}

	/**
	 * Converts SimpleXMLElement attributes to an associative array
	 *
	 * @param ?object $attributes The attributes object from SimpleXMLElement.
	 *
	 * @return ?array<string, string> Associative array of attributes or null if no attributes exist.
	 */
	private function getAttributesArray(?object $attributes): ?array
	{
		if ($attributes === null || count((array)$attributes) === 0) {
			return null;
		}

		$attributesArray = (array)$attributes;

		if (!isset($attributesArray['@attributes'])) {
			return null;
		}

		/** @var array<string, string> $result */
		$result = $attributesArray['@attributes'];

		return $result;
	}
}

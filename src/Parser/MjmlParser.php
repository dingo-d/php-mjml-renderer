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

/**
 * MJML Parser
 *
 * Parses the source code and returns an array of MjmlNode elements
 *
 * @since 1.0.0
 */
final class MjmlParser implements Parser
{
	public function parse(string $sourceCode)
	{
		// Parse the code.
		$simpleXmlElement = \simplexml_load_string($sourceCode);

		// Validate the source code.
		if ($simpleXmlElement === false) {
			throw new \RuntimeException('Badly formatted MJML code.');
		}

		$parser = function (
			\SimpleXMLElement $element,
			?Node $parentNode = null,
			?array $children = []
		) use (&$parser) {
			$attributes = $element->attributes();

			$parentNode = new MjmlNode(
				$element->getName(),
				!empty($attributes) ? ((array)$attributes)['@attributes'] : null,
				null,
				false,
				null
			);

			// Single element.
			if (count($element->children()) === 0) {
				return $this->parseSingleElement($element);
			}

			foreach ($element as $nodeName => $nodeContent) {
				$parentAttributes = $element->attributes();

				$innerParentNode = new MjmlNode(
					$nodeName,
					!empty($parentAttributes) ? ((array)$parentAttributes)['@attributes'] : null,
					null,
					false,
					null
				);

				if (count($nodeContent->children()) < 2) {
					$children[$nodeName][] = $parser($nodeContent, $innerParentNode);
					continue;
				}

				$children[$nodeName][] = $parser($nodeContent, $innerParentNode);
			}

			unset($parentAttributes, $innerParentNode, $nodeName, $nodeContent);

			$childrenFiltered = array_merge(...array_values($children ?? []));

			$parentNode->setChildren($childrenFiltered);

			return $parentNode;
		};

		return [$parser($simpleXmlElement)];
	}

	private function parseSingleElement(\SimpleXMLElement $element): Node
	{
		$attributes = $element->attributes();
		$xml = $element->asXML();

		if (!empty($xml) && strpos($xml, '/>') !== false) {
			$isSelfClosing = true;
			$value = null;
		} else {
			$isSelfClosing = false;
			$value = trim((string) $element); // should we trim?
		}

		return new MjmlNode(
			$element->getName(),
			!empty($attributes) ? ((array)$attributes)['@attributes'] : null,
			$value,
			$isSelfClosing,
			null
		);
	}
}

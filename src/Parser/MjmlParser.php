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

use MadeByDenis\PhpMjmlRenderer\Parser;

/**
 * MJML Parser
 *
 * Parses the source code and returns an array of MjmlNode elements
 *
 * @since 1.0.0
 */
class MjmlParser implements Parser
{
	public function parse(string $sourceCode)
	{
		// Parse the code.
		$simpleXmlElement = \simplexml_load_string($sourceCode);

		// Validate the source code.
		if ($simpleXmlElement === false) {
			throw new \RuntimeException('Badly formatted MJML code.');
		}

		$parser = static function (\SimpleXMLElement $simpleXmlElement, array $collection = []) use (&$parser) {
			$nodes = $simpleXmlElement->children();
			$attributes = $simpleXmlElement->attributes() ?? [];

			if (count($attributes) !== 0) {
				foreach ($attributes as $attrName => $attrValue) {
					$collection['attributes'][$attrName] = strval($attrValue);
				}
			}

			if ($nodes instanceof \SimpleXMLElement && $nodes->count() === 0) {
				// Check if tag is self-closing.
				if (strpos($simpleXmlElement->asXML(), '/>') !== false) {
					$collection['isSelfClosing'] = true;
				}

				$collection['value'] = trim((string) $simpleXmlElement); // should we trim?
				return $collection;
			}

			foreach ($nodes as $nodeName => $nodeValue) {
				$childrenNodes = $nodeValue->xpath('../' . $nodeName) ?? [];
				if ($childrenNodes !== false && count($childrenNodes) < 2) {
					$collection[$nodeName] = $parser($nodeValue);
					continue;
				}

				$collection[$nodeName][] = $parser($nodeValue);
			}

			return $collection;
		};

		return [
			$simpleXmlElement->getName() => $parser($simpleXmlElement)
		];
	}
}

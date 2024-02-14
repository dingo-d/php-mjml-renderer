<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Renderer;

use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\ParserFactory;
use MadeByDenis\PhpMjmlRenderer\Renderer;

/**
 * Render class
 *
 * The class will render the MJML content to HTML string
 * according to the official MJML package.
 *
 * @link https://github.com/mjmlio/mjml
 *
 * @since 1.0.0
 */
class MjmlRenderer implements Renderer
{
	public function render(string $content): string
	{
		// Parse content.
		$parser = ParserFactory::create();

		$parsedContent = $parser->parse($content);

		$contentRender = function ($nodeElement, $content) use (&$contentRender) {
			if (!$nodeElement->hasChildren()) {
				$content .= ElementFactory::create($nodeElement)->render();

				return $content;
			}

			foreach ($nodeElement->getChildren() as $childNode) {
				if ($childNode->hasChildren()) {
					$contentRender($childNode, $content);
				} else {
					$content .= ElementFactory::create($childNode)->render();
				}
			}

			return $content;
		};

		return $contentRender($parsedContent, '');
	}
}

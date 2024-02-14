<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\Helpers;

trait ConditionalTag
{
	protected string $startConditionalTag = '<!--[if mso | IE]>';
	protected string $startMsoConditionalTag = '<!--[if mso]>';
	protected string $endConditionalTag = '<![endif]-->';
	protected string $startNegationConditionalTag = '<!--[if !mso | IE]><!-->';
	protected string $startMsoNegationConditionalTag = '<!--[if !mso><!-->';
	protected string $endNegationConditionalTag = '<!--<![endif]-->';

	protected function conditionalTag(string $content, bool $negation = false): string
	{
		$tagStart = $negation ? $this->startNegationConditionalTag : $this->startConditionalTag;
		$tagEnd = $negation ? $this->endNegationConditionalTag : $this->endConditionalTag;

		return "$tagStart $content $tagEnd";
	}

	protected function msoConditionalTag(string $content, bool $negation = false): string
	{
		$tagStart = $negation ? $this->startMsoNegationConditionalTag : $this->startMsoConditionalTag;
		$tagEnd = $negation ? $this->endNegationConditionalTag : $this->endConditionalTag;

		return "$tagStart $content $tagEnd";
	}
}

<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\Helpers;

use MadeByDenis\PhpMjmlRenderer\Node;

trait JsonHelper
{
	public function jsonToXML(?Node $node): string
	{
		$tagName = $node?->getTag();
		$attributes = $node?->getAttributes() ?? [];
		$children = $node?->getChildren();
		$content = $node?->getInnerContent();

		if ($tagName === null) {
			return '';
		}

		$subNode = !empty($children) ? implode("\n", array_map([$this, 'jsonToXML'], $children)) : $content;

		$stringAttrs = array_reduce(array_keys($attributes), function ($carry, $attr) use ($attributes) {
			return $carry . "{$attr}=\"{$attributes[$attr]}\" ";
		}, '');

		$stringAttrs = trim($stringAttrs);

		return $stringAttrs === '' ?
			"<{$tagName}>{$subNode}</{$tagName}>" :
			"<{$tagName} {$stringAttrs}>{$subNode}</{$tagName}>";
	}
}

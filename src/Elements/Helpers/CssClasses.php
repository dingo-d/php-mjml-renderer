<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\Helpers;

trait CssClasses
{
	public function suffixCssClasses(string $classes, string $suffix): string
	{
		return $classes ?
			implode(' ', array_map(function ($className) use ($suffix) {
				return $className . '-' . $suffix;
			}, explode(' ', $classes))) : '';
	}
}

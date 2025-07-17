<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\Helpers;

trait BodyHelpers
{
	protected function addMediaQuery($className, $parsedWidth, $unit): void
	{
		$this->setGlobalAttributes('mediaQueries', [
			$className => [
				'width' => "{$parsedWidth}{$unit} !important;",
				'max-width' => "{$parsedWidth}{$unit};",
			]
		]);
	}

	protected function setBackgroundColor($color): void
	{
		$this->setGlobalAttributes('backgroundColor', $color);
	}

	protected function addHeadStyle($identifier, $headStyle): void
	{
		$this->setGlobalAttributes('headStyle', [
			$identifier => $headStyle
		]);
	}

	protected function addComponentHeadStyle($headStyle): void
	{
		$this->setGlobalAttributes('componentsHeadStyle', $headStyle);
	}
}

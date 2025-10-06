<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\Helpers;

trait BodyHelpers
{
	protected function addMediaQuery(string $className, string $parsedWidth, string $unit): void
	{
		$this->setGlobalAttributes('mediaQueries', [
			$className => [
				'width' => "{$parsedWidth}{$unit} !important;",
				'max-width' => "{$parsedWidth}{$unit};",
			]
		]);
	}

	protected function setBackgroundColor(?string $color): void
	{
		$this->setGlobalAttributes('backgroundColor', $color);
	}

	protected function addHeadStyle(string $identifier, ?string $headStyle): void
	{
		$this->setGlobalAttributes('headStyle', [
			$identifier => $headStyle
		]);
	}

	protected function addComponentHeadStyle(?string $headStyle): void
	{
		$this->setGlobalAttributes('componentsHeadStyle', $headStyle);
	}
}

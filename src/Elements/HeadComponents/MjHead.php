<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjHead extends AbstractElement
{
	public const string TAG_NAME = 'mj-head';
	public const bool ENDING_TAG = false;

	protected array $allowedAttributes = [];
	protected array $defaultAttributes = [];

	public function render(): string
	{
		$children = $this->getChildren() ?? [];
		return $this->renderChildren($children, []);
	}

	public function getStyles(): array
	{
		return [];
	}
}

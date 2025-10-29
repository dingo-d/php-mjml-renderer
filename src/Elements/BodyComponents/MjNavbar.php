<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjNavbar extends AbstractElement
{
	public const string TAG_NAME = 'mj-navbar';
	public const bool ENDING_TAG = false;

	protected array $allowedAttributes = [
		'align' => ['unit' => 'string', 'type' => 'string', 'default_value' => 'center'],
		'base-url' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
	];

	protected array $defaultAttributes = ['align' => 'center'];

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

<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjFont extends AbstractElement
{
	public const string TAG_NAME = 'mj-font';
	public const bool ENDING_TAG = false;

	protected array $allowedAttributes = [
		'name' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
		'href' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
	];

	protected array $defaultAttributes = [];

	public function render(): string
	{
		$href = $this->getAttribute('href');
		$name = $this->getAttribute('name');

		if (!$href) {
			return '';
		}

		return "<link href='$href' rel='stylesheet' type='text/css'>";
	}

	public function getStyles(): array
	{
		return [];
	}
}

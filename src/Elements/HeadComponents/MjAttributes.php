<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjAttributes extends AbstractElement
{
	public const string TAG_NAME = 'mj-attributes';
	public const bool ENDING_TAG = false;

	protected array $allowedAttributes = [];
	protected array $defaultAttributes = [];

	public function render(): string
	{
		return '';
	}

	public function getStyles(): array
	{
		return [];
	}
}

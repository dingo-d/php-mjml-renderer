<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjTitle extends AbstractElement
{
	public const string TAG_NAME = 'mj-title';
	public const bool ENDING_TAG = true;

	protected array $allowedAttributes = [];
	protected array $defaultAttributes = [];

	public function render(): string
	{
		return '<title>' . $this->getContent() . '</title>';
	}

	public function getStyles(): array
	{
		return [];
	}
}

<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjPreview extends AbstractElement
{
	public const string TAG_NAME = 'mj-preview';
	public const bool ENDING_TAG = true;

	protected array $allowedAttributes = [];
	protected array $defaultAttributes = [];

	public function render(): string
	{
		$content = $this->getContent();
		return "<div style='display:none;max-height:0px;overflow:hidden;'>$content</div>";
	}

	public function getStyles(): array
	{
		return [];
	}
}

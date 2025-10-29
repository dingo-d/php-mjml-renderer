<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjStyle extends AbstractElement
{
	public const string TAG_NAME = 'mj-style';
	public const bool ENDING_TAG = true;

	protected array $allowedAttributes = [
		'inline' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
	];

	protected array $defaultAttributes = [];

	public function render(): string
	{
		$content = $this->getContent();
		$inline = $this->getAttribute('inline');

		if ($inline === 'inline') {
			return $content;
		}

		return "<style type='text/css'>$content</style>";
	}

	public function getStyles(): array
	{
		return [];
	}
}

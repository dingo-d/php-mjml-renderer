<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\Utilities;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjInclude extends AbstractElement
{
	public const string TAG_NAME = 'mj-include';
	public const bool ENDING_TAG = false;

	protected array $allowedAttributes = [
		'path' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
		'type' => ['unit' => 'string', 'type' => 'string', 'default_value' => 'mjml'],
	];

	protected array $defaultAttributes = [
		'type' => 'mjml',
	];

	public function render(): string
	{
		$path = $this->getAttribute('path');
		$type = $this->getAttribute('type');

		if (!$path || !file_exists($path)) {
			return '';
		}

		$content = file_get_contents($path);

		if ($content === false) {
			return '';
		}

		if ($type === 'css') {
			return "<style>$content</style>";
		}

		if ($type === 'html') {
			return $content;
		}

		return $content;
	}

	public function getStyles(): array
	{
		return [];
	}
}

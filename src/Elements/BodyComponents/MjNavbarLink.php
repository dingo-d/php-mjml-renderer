<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjNavbarLink extends AbstractElement
{
	public const string TAG_NAME = 'mj-navbar-link';
	public const bool ENDING_TAG = true;

	protected array $allowedAttributes = [
		'color' => ['unit' => 'color', 'type' => 'color', 'default_value' => '#000000'],
		'font-family' => [
			'unit' => 'string',
			'type' => 'string',
			'default_value' => 'Ubuntu, Helvetica, Arial, sans-serif',
		],
		'font-size' => ['unit' => 'px', 'type' => 'string', 'default_value' => '13px'],
		'href' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
		'padding' => ['unit' => 'px', 'type' => 'string', 'default_value' => '15px 10px'],
		'target' => ['unit' => 'string', 'type' => 'string', 'default_value' => '_blank'],
	];

	protected array $defaultAttributes = [
		'color' => '#000000',
		'font-size' => '13px',
		'padding' => '15px 10px',
		'target' => '_blank',
	];

	public function render(): string
	{
		$href = $this->getAttribute('href');
		$target = $this->getAttribute('target');
		$aAttributes = $this->getHtmlAttributes(['style' => 'a']);
		$content = $this->getContent();
		return "<a href='$href' target='$target' $aAttributes>$content</a>";
	}

	public function getStyles(): array
	{
		return ['a' => [
			'color' => $this->getAttribute('color'),
			'font-family' => $this->getAttribute('font-family'),
			'font-size' => $this->getAttribute('font-size'),
			'padding' => $this->getAttribute('padding'),
			'text-decoration' => 'none',
		]];
	}
}

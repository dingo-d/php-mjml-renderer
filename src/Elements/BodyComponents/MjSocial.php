<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjSocial extends AbstractElement
{
	public const string TAG_NAME = 'mj-social';
	public const bool ENDING_TAG = false;

	protected array $allowedAttributes = [
		'align' => ['unit' => 'string', 'type' => 'alignment', 'default_value' => 'center'],
		'border-radius' => ['unit' => 'px', 'type' => 'string', 'default_value' => '3px'],
		'color' => ['unit' => 'color', 'type' => 'color', 'default_value' => '#333333'],
		'font-family' => [
			'unit' => 'string',
			'type' => 'string',
			'default_value' => 'Ubuntu, Helvetica, Arial, sans-serif',
		],
		'font-size' => ['unit' => 'px', 'type' => 'string', 'default_value' => '13px'],
		'icon-size' => ['unit' => 'px', 'type' => 'string', 'default_value' => '20px'],
		'mode' => ['unit' => 'string', 'type' => 'string', 'default_value' => 'horizontal'],
		'padding' => ['unit' => 'px', 'type' => 'string', 'default_value' => '10px 25px'],
	];

	protected array $defaultAttributes = [
		'align' => 'center',
		'border-radius' => '3px',
		'color' => '#333333',
		'font-size' => '13px',
		'icon-size' => '20px',
		'mode' => 'horizontal',
		'padding' => '10px 25px',
	];

	public function render(): string
	{
		$children = $this->getChildren() ?? [];
		$content = $this->renderChildren($children, []);
		$divAttributes = $this->getHtmlAttributes(['style' => 'div']);
		return "<div $divAttributes>$content</div>";
	}

	public function getChildContext(): array
	{
		return [
			...$this->context,
			'border-radius' => $this->getAttribute('border-radius'),
			'color' => $this->getAttribute('color'),
			'font-family' => $this->getAttribute('font-family'),
			'font-size' => $this->getAttribute('font-size'),
			'icon-size' => $this->getAttribute('icon-size'),
		];
	}

	public function getStyles(): array
	{
		return ['div' => ['text-align' => $this->getAttribute('align')]];
	}
}

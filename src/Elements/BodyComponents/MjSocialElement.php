<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjSocialElement extends AbstractElement
{
	public const string TAG_NAME = 'mj-social-element';
	public const bool ENDING_TAG = true;

	protected array $allowedAttributes = [
		'align' => ['unit' => 'string', 'type' => 'alignment', 'default_value' => 'left'],
		'background-color' => ['unit' => 'color', 'type' => 'color', 'default_value' => ''],
		'border-radius' => ['unit' => 'px', 'type' => 'string', 'default_value' => ''],
		'color' => ['unit' => 'color', 'type' => 'color', 'default_value' => ''],
		'font-family' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
		'font-size' => ['unit' => 'px', 'type' => 'string', 'default_value' => ''],
		'href' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
		'icon-size' => ['unit' => 'px', 'type' => 'string', 'default_value' => ''],
		'name' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
		'padding' => ['unit' => 'px', 'type' => 'string', 'default_value' => '4px'],
		'src' => ['unit' => 'string', 'type' => 'string', 'default_value' => ''],
		'target' => ['unit' => 'string', 'type' => 'string', 'default_value' => '_blank'],
	];

	protected array $defaultAttributes = [
		'align' => 'left',
		'padding' => '4px',
		'target' => '_blank',
	];

	public function render(): string
	{
		$href = $this->getAttribute('href');
		$target = $this->getAttribute('target');
		$src = $this->getAttribute('src');
		$iconSize = $this->getAttribute('icon-size') ?: $this->context['icon-size'] ?? '20px';
		$content = $this->getContent();

		$aAttributes = $this->getHtmlAttributes(['style' => 'a']);
		$icon = $src ? "<img src='$src' width='$iconSize' height='$iconSize' />" : '';

		return "<a href='$href' target='$target' $aAttributes>$icon $content</a>";
	}

	public function getStyles(): array
	{
		$color = $this->getAttribute('color') ?: $this->context['color'] ?? '#333333';
		$fontFamily = $this->getAttribute('font-family') ?:
			$this->context['font-family'] ?? 'Ubuntu, Helvetica, Arial, sans-serif';

		return ['a' => [
			'color' => $color,
			'font-family' => $fontFamily,
			'padding' => $this->getAttribute('padding'),
			'text-decoration' => 'none',
		]];
	}
}

<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

/**
 * Mjml Group Element
 *
 * Group allows you to prevent columns from stacking on mobile.
 * To do so, wrap the columns inside a group component.
 *
 * @link https://documentation.mjml.io/#mj-group
 *
 * @since 1.0.0
 */
class MjGroup extends AbstractElement
{
	public const string TAG_NAME = 'mj-group';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'width' => [
			'unit' => 'px,%',
			'type' => 'string',
			'description' => 'group width',
			'default_value' => '100%',
		],
		'vertical-align' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'vertical alignment (top/middle/bottom)',
			'default_value' => 'top',
		],
		'background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'background color for the group',
			'default_value' => '',
		],
		'direction' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'set the display order of direct children (ltr/rtl)',
			'default_value' => 'ltr',
		],
		'css-class' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'class name added to root HTML element',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [
		'width' => '100%',
		'vertical-align' => 'top',
		'direction' => 'ltr',
	];

	public function render(): string
	{
		$children = $this->getChildren() ?? [];
		$content = $this->renderChildren($children, []);

		return $content;
	}

	/**
	 * Gets the context for child elements.
	 *
	 * @return array<string, mixed>
	 */
	public function getChildContext(): array
	{
		return [
			...$this->context,
			'containerWidth' => $this->getAttribute('width'),
		];
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'td' => [
				'background-color' => $this->getAttribute('background-color'),
				'direction' => $this->getAttribute('direction'),
				'font-size' => '0px',
				'text-align' => 'center',
				'vertical-align' => $this->getAttribute('vertical-align'),
			],
		];
	}
}

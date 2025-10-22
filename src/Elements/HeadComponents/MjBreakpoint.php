<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

/**
 * Mjml Breakpoint Element
 *
 * @link https://documentation.mjml.io/#mj-breakpoint
 *
 * @since 1.0.0
 */
class MjBreakpoint extends AbstractElement
{
	public const string TAG_NAME = 'mj-breakpoint';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'width' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'breakpoint width',
			'default_value' => '480px',
		],
	];

	protected array $defaultAttributes = [
		'width' => '480px',
	];

	public function render(): string
	{
		// mj-breakpoint doesn't render any HTML
		// It's processed by mj-head to set responsive breakpoint
		return '';
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

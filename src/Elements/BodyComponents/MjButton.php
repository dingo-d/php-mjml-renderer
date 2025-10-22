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
 * Mjml Button Element
 *
 * @link https://documentation.mjml.io/#mj-button
 *
 * @since 1.0.0
 */
class MjButton extends AbstractElement
{
	public const string TAG_NAME = 'mj-button';

	public const bool ENDING_TAG = true;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'align' => [
			'unit' => 'string',
			'type' => 'alignment',
			'description' => 'horizontal alignment',
			'default_value' => 'center',
		],
		'background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'button background color',
			'default_value' => '#414141',
		],
		'border' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'css border format',
			'default_value' => 'none',
		],
		'border-bottom' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'css bottom border format',
			'default_value' => '',
		],
		'border-left' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'css left border format',
			'default_value' => '',
		],
		'border-radius' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'border radius',
			'default_value' => '3px',
		],
		'border-right' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'css right border format',
			'default_value' => '',
		],
		'border-top' => [
			'unit' => 'string',
			'type' => 'border',
			'description' => 'css top border format',
			'default_value' => '',
		],
		'color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'text color',
			'default_value' => '#ffffff',
		],
		'container-background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'button container background color',
			'default_value' => '',
		],
		'css-class' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'class name added to root HTML element',
			'default_value' => '',
		],
		'font-family' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'font name',
			'default_value' => 'Ubuntu, Helvetica, Arial, sans-serif',
		],
		'font-size' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'text size',
			'default_value' => '13px',
		],
		'font-style' => [
			'unit' => 'string',
			'type' => 'fontStyle',
			'description' => 'normal/italic/oblique',
			'default_value' => '',
		],
		'font-weight' => [
			'unit' => 'number',
			'type' => 'number',
			'description' => 'text thickness',
			'default_value' => 'normal',
		],
		'height' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'button height',
			'default_value' => '',
		],
		'href' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'link when button is clicked',
			'default_value' => '',
		],
		'inner-padding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'inner button padding',
			'default_value' => '10px 25px',
		],
		'letter-spacing' => [
			'unit' => 'px,em',
			'type' => 'measure',
			'description' => 'letter spacing',
			'default_value' => '',
		],
		'line-height' => [
			'unit' => 'px,%',
			'type' => 'measure',
			'description' => 'line height on link',
			'default_value' => '120%',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'supports up to 4 parameters',
			'default_value' => '10px 25px',
		],
		'padding-bottom' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'bottom offset',
			'default_value' => '',
		],
		'padding-left' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'left offset',
			'default_value' => '',
		],
		'padding-right' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'right offset',
			'default_value' => '',
		],
		'padding-top' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'top offset',
			'default_value' => '',
		],
		'rel' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'link rel attribute',
			'default_value' => '',
		],
		'target' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'link target',
			'default_value' => '_blank',
		],
		'text-align' => [
			'unit' => 'string',
			'type' => 'alignment',
			'description' => 'text alignment',
			'default_value' => 'none',
		],
		'text-decoration' => [
			'unit' => 'string',
			'type' => 'textDecoration',
			'description' => 'underline/overline/none',
			'default_value' => 'none',
		],
		'text-transform' => [
			'unit' => 'string',
			'type' => 'textTransform',
			'description' => 'capitalize/uppercase/lowercase',
			'default_value' => 'none',
		],
		'title' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'tooltip & accessibility',
			'default_value' => '',
		],
		'vertical-align' => [
			'unit' => 'string',
			'type' => 'verticalAlign',
			'description' => 'vertical alignment',
			'default_value' => 'middle',
		],
		'width' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'button width',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [
		'align' => 'center',
		'background-color' => '#414141',
		'border' => 'none',
		'border-radius' => '3px',
		'color' => '#ffffff',
		'font-family' => 'Ubuntu, Helvetica, Arial, sans-serif',
		'font-size' => '13px',
		'font-weight' => 'normal',
		'inner-padding' => '10px 25px',
		'line-height' => '120%',
		'padding' => '10px 25px',
		'target' => '_blank',
		'text-align' => 'none',
		'text-decoration' => 'none',
		'text-transform' => 'none',
		'vertical-align' => 'middle',
	];

	public function render(): string
	{
		$tdAttributes = $this->getHtmlAttributes([
			'align' => $this->getAttribute('align'),
			'bgcolor' => $this->getAttribute('background-color'),
			'role' => 'presentation',
			'style' => 'td',
			'valign' => $this->getAttribute('vertical-align'),
		]);

		return "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" " .
			"style=\"border-collapse:separate;line-height:100%;\">" .
			"<tbody>" .
			"<tr>" .
			"<td $tdAttributes>" .
			$this->renderButton() .
			"</td>" .
			"</tr>" .
			"</tbody>" .
			"</table>";
	}

	private function renderButton(): string
	{
		$href = $this->getAttribute('href');
		$target = $this->getAttribute('target');
		$rel = $this->getAttribute('rel');
		$title = $this->getAttribute('title');

		$aAttributes = $this->getHtmlAttributes([
			'href' => $href,
			'rel' => $rel,
			'target' => $target,
			'title' => $title,
			'style' => 'a',
		]);

		$content = $this->getContent();

		return "<a $aAttributes>$content</a>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'td' => [
				'background' => $this->getAttribute('background-color'),
				'border' => $this->getAttribute('border'),
				'border-bottom' => $this->getAttribute('border-bottom'),
				'border-left' => $this->getAttribute('border-left'),
				'border-radius' => $this->getAttribute('border-radius'),
				'border-right' => $this->getAttribute('border-right'),
				'border-top' => $this->getAttribute('border-top'),
				'cursor' => 'auto',
				'font-style' => $this->getAttribute('font-style'),
				'height' => $this->getAttribute('height'),
				'mso-padding-alt' => $this->getAttribute('inner-padding'),
				'text-align' => $this->getAttribute('text-align'),
			],
			'a' => [
				'background' => $this->getAttribute('background-color'),
				'border' => $this->getAttribute('border'),
				'border-bottom' => $this->getAttribute('border-bottom'),
				'border-left' => $this->getAttribute('border-left'),
				'border-radius' => $this->getAttribute('border-radius'),
				'border-right' => $this->getAttribute('border-right'),
				'border-top' => $this->getAttribute('border-top'),
				'color' => $this->getAttribute('color'),
				'cursor' => 'auto',
				'display' => 'inline-block',
				'font-family' => $this->getAttribute('font-family'),
				'font-size' => $this->getAttribute('font-size'),
				'font-style' => $this->getAttribute('font-style'),
				'font-weight' => $this->getAttribute('font-weight'),
				'letter-spacing' => $this->getAttribute('letter-spacing'),
				'line-height' => $this->getAttribute('line-height'),
				'margin' => '0',
				'mso-padding-alt' => '0px',
				'padding' => $this->getAttribute('inner-padding'),
				'text-decoration' => $this->getAttribute('text-decoration'),
				'text-transform' => $this->getAttribute('text-transform'),
				'width' => $this->getAttribute('width'),
			],
		];
	}
}

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
 * Mjml Image Element
 *
 * @link https://documentation.mjml.io/#mj-image
 *
 * @since 1.0.0
 */
class MjImage extends AbstractElement
{
	public const string TAG_NAME = 'mj-image';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'align' => [
			'unit' => 'string',
			'type' => 'alignment',
			'description' => 'image alignment',
			'default_value' => 'center',
		],
		'alt' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'image description',
			'default_value' => '',
		],
		'border' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'css border format',
			'default_value' => 'none',
		],
		'border-radius' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'border radius',
			'default_value' => '',
		],
		'border-top' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'css top border format',
			'default_value' => 'none',
		],
		'border-bottom' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'css bottom border format',
			'default_value' => 'none',
		],
		'border-left' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'css left border format',
			'default_value' => 'none',
		],
		'border-right' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'css right border format',
			'default_value' => 'none',
		],
		'container-background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'inner element background color',
			'default_value' => '',
		],
		'css-class' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'class name added to root HTML element',
			'default_value' => '',
		],
		'fluid-on-mobile' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'if true, will be full width on mobile',
			'default_value' => '',
		],
		'height' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'image height',
			'default_value' => 'auto',
		],
		'href' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'link to redirect on click',
			'default_value' => '',
		],
		'name' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'specify link name attribute',
			'default_value' => '',
		],
		'padding' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'supports up to 4 parameters',
			'default_value' => '10px 25px',
		],
		'padding-top' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'top offset',
			'default_value' => '',
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
		'rel' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'specify link rel attribute',
			'default_value' => '',
		],
		'sizes' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'set width based on query',
			'default_value' => '',
		],
		'src' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'image source',
			'default_value' => '',
		],
		'srcset' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'different image source based on viewport',
			'default_value' => '',
		],
		'target' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'link target on click',
			'default_value' => '_blank',
		],
		'title' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'tooltip & accessibility',
			'default_value' => '',
		],
		'usemap' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'reference to image map',
			'default_value' => '',
		],
		'width' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'image width',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [
		'align' => 'center',
		'border' => 'none',
		'height' => 'auto',
		'padding' => '10px 25px',
		'target' => '_blank',
	];

	public function render(): string
	{
		$href = $this->getAttribute('href');

		$imgAttributes = $this->getHtmlAttributes([
			'alt' => $this->getAttribute('alt'),
			'height' => $this->getAttribute('height'),
			'src' => $this->getAttribute('src'),
			'srcset' => $this->getAttribute('srcset'),
			'sizes' => $this->getAttribute('sizes'),
			'style' => 'img',
			'title' => $this->getAttribute('title'),
			'usemap' => $this->getAttribute('usemap'),
			'width' => $this->getImageWidth(),
		]);

		$img = "<img $imgAttributes />";

		// Wrap in link if href is provided
		if ($href) {
			$aAttributes = $this->getHtmlAttributes([
				'href' => $href,
				'target' => $this->getAttribute('target'),
				'rel' => $this->getAttribute('rel'),
				'name' => $this->getAttribute('name'),
			]);

			$img = "<a $aAttributes>$img</a>";
		}

		$tdAttributes = $this->getHtmlAttributes([
			'align' => $this->getAttribute('align'),
			'style' => 'td',
		]);

		return "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" " .
			"style=\"border-collapse:collapse;border-spacing:0px;\">" .
			"<tbody>" .
			"<tr>" .
			"<td $tdAttributes>" .
			$img .
			"</td>" .
			"</tr>" .
			"</tbody>" .
			"</table>";
	}

	private function getImageWidth(): string
	{
		$width = $this->getAttribute('width');

		if ($width) {
			return $width;
		}

		// Default to container width if not specified
		return $this->context['containerWidth'] ?? '';
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'img' => [
				'border' => $this->getAttribute('border'),
				'border-top' => $this->getAttribute('border-top'),
				'border-bottom' => $this->getAttribute('border-bottom'),
				'border-left' => $this->getAttribute('border-left'),
				'border-right' => $this->getAttribute('border-right'),
				'border-radius' => $this->getAttribute('border-radius'),
				'display' => 'block',
				'outline' => 'none',
				'text-decoration' => 'none',
				'height' => $this->getAttribute('height'),
				'max-width' => '100%',
				'width' => '100%',
			],
			'td' => [
				'width' => $this->getImageWidth(),
			],
		];
	}
}

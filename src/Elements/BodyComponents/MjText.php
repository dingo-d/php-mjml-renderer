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
use MadeByDenis\PhpMjmlRenderer\Elements\Helpers\ConditionalTag;

/**
 * Mjml Text Element
 *
 * @link https://documentation.mjml.io/#mj-text
 *
 * @since 1.0.0
 */
class MjText extends AbstractElement
{
	use ConditionalTag;

	public const string TAG_NAME = 'mj-text';

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
			'description' => 'left/right/center/justify',
			'default_value' => 'left',
		],
		'color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'text color',
			'default_value' => '#000000',
		],
		'container-background-color' => [
			'unit' => 'color',
			'type' => 'color',
			'description' => 'inner element background color',
			'default_value' => 'transparent',
		],
		'css-class' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'class name, added to the root HTML element created',
			'default_value' => '',
		],
		'font-family' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'font',
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
			'default_value' => 'normal',
		],
		'font-weight' => [
			'unit' => 'number',
			'type' => 'number',
			'description' => 'text thickness',
			'default_value' => '',
		],
		'height' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'The height of the element',
			'default_value' => '',
		],
		'letter-spacing' => [
			'unit' => 'px,em',
			'type' => 'measure',
			'description' => 'letter spacing',
			'default_value' => 'none',
		],
		'line-height' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'space between the lines',
			'default_value' => '1',
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
			'default_value' => '0',
		],
		'padding-left' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'left offset',
			'default_value' => '0',
		],
		'padding-right' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'right offset',
			'default_value' => '0',
		],
		'padding-top' => [
			'unit' => 'px',
			'type' => 'measure',
			'description' => 'top offset',
			'default_value' => 'initial',
		],
		'text-decoration' => [
			'unit' => 'string',
			'type' => 'textDecoration',
			'description' => 'underline/overline/line-through/none',
			'default_value' => 'n/a',
		],
		'text-transform' => [
			'unit' => 'string',
			'type' => 'textTransform',
			'description' => 'uppercase/lowercase/capitalize',
			'default_value' => 'none',
		],
	];

	protected array $defaultAttributes = [
		'align' => 'left',
		'color' => '#000000',
		'font-family' => 'Ubuntu, Helvetica, Arial, sans-serif',
		'font-size' => '13px',
		'line-height' => '1',
		'padding' => '10px 25px',
	];

	public function render(): string
	{
		$height = $this->getAttribute('height');
		$conditionalTagStart = $this->conditionalTag(
			"<table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td height='$height' style='vertical-align:top;height:$height;'>" // phpcs:ignore Generic.Files.LineLength.TooLong
		);

		$conditionalTagEnd = $this->conditionalTag('</td></tr></table>');

		return $height ?
			$conditionalTagStart . $this->renderContent() . $conditionalTagEnd :
			$this->renderContent();
	}

	public function renderContent(): string
	{
		$htmlAttributes = $this->getHtmlAttributes([
			'style' => 'text',
		]);

		$content = $this->getContent();

		return "<div $htmlAttributes>$content</div>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [
			'text' => [
				'font-family' => $this->getAttribute('font-family'),
				'font-size' => $this->getAttribute('font-size'),
				'font-style' => $this->getAttribute('font-style'),
				'font-weight' => $this->getAttribute('font-weight'),
				'letter-spacing' => $this->getAttribute('letter-spacing'),
				'line-height' => $this->getAttribute('line-height'),
				'text-align' => $this->getAttribute('align'),
				'text-decoration' => $this->getAttribute('text-decoration'),
				'text-transform' => $this->getAttribute('text-transform'),
				'color' => $this->getAttribute('color'),
				'height' => $this->getAttribute('height'),
			]
		];
	}
}

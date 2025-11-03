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
 * Mjml Carousel Image Element
 *
 * Individual image item in a carousel.
 *
 * @link https://documentation.mjml.io/#mj-carousel-image
 *
 * @since 1.0.0
 */
class MjCarouselImage extends AbstractElement
{
	public const string TAG_NAME = 'mj-carousel-image';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'alt' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'image description',
			'default_value' => '',
		],
		'href' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'link to redirect to on click',
			'default_value' => '',
		],
		'rel' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'specify the rel attribute',
			'default_value' => '',
		],
		'src' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'image source',
			'default_value' => '',
		],
		'target' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'link target on click',
			'default_value' => '_blank',
		],
		'thumbnails-src' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'thumbnail source',
			'default_value' => '',
		],
		'title' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'image title',
			'default_value' => '',
		],
	];

	protected array $defaultAttributes = [
		'target' => '_blank',
	];

	public function render(): string
	{
		$src = $this->getAttribute('src');
		$alt = $this->getAttribute('alt');
		$href = $this->getAttribute('href');
		$target = $this->getAttribute('target');

		$imgTag = "<img src='$src' alt='$alt' style='max-width: 100%;' />";

		if ($href) {
			return "<a href='$href' target='$target'>$imgTag</a>";
		}

		return $imgTag;
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

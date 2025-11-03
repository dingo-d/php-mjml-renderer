<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjCarousel;
use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjCarouselImage;

describe('MjCarousel', function () {
	it('returns the correct component name', function () {
		$element = new MjCarousel();
		expect($element->getTagName())->toBe('mj-carousel');
	});

	it('has correct default attributes', function () {
		$element = new MjCarousel();
		expect($element->getAttribute('align'))->toBe('center');
		expect($element->getAttribute('thumbnails'))->toBe('visible');
	});

	it('renders correctly', function () {
		$element = new MjCarousel();
		$out = $element->render();
		expect($out)->toContain('<div');
	});
});

describe('MjCarouselImage', function () {
	it('returns the correct component name', function () {
		$element = new MjCarouselImage();
		expect($element->getTagName())->toBe('mj-carousel-image');
	});

	it('renders image correctly', function () {
		$element = new MjCarouselImage(['src' => 'test.jpg', 'alt' => 'Test']);
		$out = $element->render();
		expect($out)->toContain('<img');
		expect($out)->toContain('test.jpg');
		expect($out)->toContain('Test');
	});

	it('renders with link when href is provided', function () {
		$element = new MjCarouselImage([
			'src' => 'test.jpg',
			'href' => 'https://example.com',
		]);
		$out = $element->render();
		expect($out)->toContain('<a href=');
		expect($out)->toContain('https://example.com');
	});
});

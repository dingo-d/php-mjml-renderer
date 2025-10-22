<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjImage;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjImage();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBe(false);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-image');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'align' => 'center',
		'border' => 'none',
		'height' => 'auto',
		'padding' => '10px 25px',
		'target' => '_blank',
	];

	foreach ($attributes as $key => $value) {
		expect($this->element->getAttribute($key))->toBe($value);
	}
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('invalid-attribute');
})->throws(OutOfBoundsException::class);

it('will return allowed attribute data', function () {
	$data = $this->element->getAllowedAttributeData('src');
	expect($data)->toBeArray();
	expect($data)->toHaveKey('type');
	expect($data)->toHaveKey('unit');
});

it('will correctly render a simple image', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		['src' => 'https://example.com/image.jpg'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	expect($mjImageElement)->toBeInstanceOf(MjImage::class);

	$out = $mjImageElement->render();

	expect($out)->toContain('<table');
	expect($out)->toContain('<img');
	expect($out)->toContain('src="https://example.com/image.jpg"');
	expect($out)->not->toBeEmpty();
});

it('will correctly render an image with alt text', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		[
			'src' => 'https://example.com/image.jpg',
			'alt' => 'Test Image',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	$out = $mjImageElement->render();

	expect($out)->toContain('alt="Test Image"');
	expect($out)->toContain('src="https://example.com/image.jpg"');
	expect($out)->not->toBeEmpty();
});

it('will correctly render an image with href', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		[
			'src' => 'https://example.com/image.jpg',
			'href' => 'https://example.com',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	$out = $mjImageElement->render();

	expect($out)->toContain('<a');
	expect($out)->toContain('href="https://example.com"');
	expect($out)->toContain('src="https://example.com/image.jpg"');
	expect($out)->not->toBeEmpty();
});

it('will correctly render an image with custom width', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		[
			'src' => 'https://example.com/image.jpg',
			'width' => '300px',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	$out = $mjImageElement->render();

	expect($out)->toContain('width="300px"');
	expect($out)->toContain('src="https://example.com/image.jpg"');
	expect($out)->not->toBeEmpty();
});

it('will correctly render an image with border', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		[
			'src' => 'https://example.com/image.jpg',
			'border' => '1px solid #000',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	$out = $mjImageElement->render();

	expect($out)->toContain('border');
	expect($out)->toContain('1px solid #000');
	expect($out)->not->toBeEmpty();
});

it('will correctly render an image with border radius', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		[
			'src' => 'https://example.com/image.jpg',
			'border-radius' => '10px',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	$out = $mjImageElement->render();

	expect($out)->toContain('border-radius');
	expect($out)->toContain('10px');
	expect($out)->not->toBeEmpty();
});

it('will correctly render an image with alignment', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		[
			'src' => 'https://example.com/image.jpg',
			'align' => 'left',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	$out = $mjImageElement->render();

	expect($out)->toContain('align="left"');
	expect($out)->not->toBeEmpty();
});

it('will correctly render an image with srcset', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		[
			'src' => 'https://example.com/image.jpg',
			'srcset' => 'small.jpg 300w, large.jpg 600w',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	$out = $mjImageElement->render();

	expect($out)->toContain('srcset="small.jpg 300w, large.jpg 600w"');
	expect($out)->not->toBeEmpty();
});

it('will correctly render an image with title', function () {
	$imageNode = new MjmlNode(
		'mj-image',
		[
			'src' => 'https://example.com/image.jpg',
			'title' => 'Hover tooltip',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjImageElement = $factory->create($imageNode);

	$out = $mjImageElement->render();

	expect($out)->toContain('title="Hover tooltip"');
	expect($out)->not->toBeEmpty();
});

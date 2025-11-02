<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjWrapper;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjWrapper();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBe(false);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-wrapper');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'background-repeat' => 'repeat',
		'background-size' => 'auto',
		'background-position' => 'top center',
		'border' => 'none',
		'padding' => '20px 0',
		'text-align' => 'center',
	];

	foreach ($attributes as $key => $value) {
		expect($this->element->getAttribute($key))->toBe($value);
	}
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('invalid-attribute');
})->throws(OutOfBoundsException::class);

it('will return allowed attribute data', function () {
	$data = $this->element->getAllowedAttributeData('background-color');
	expect($data)->toBeArray();
	expect($data)->toHaveKey('type');
	expect($data)->toHaveKey('unit');
});

it('will correctly render a simple wrapper', function () {
	$wrapperNode = new MjmlNode(
		'mj-wrapper',
		null,
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjWrapperElement = $factory->create($wrapperNode);

	expect($mjWrapperElement)->toBeInstanceOf(MjWrapper::class);

	$out = $mjWrapperElement->render();

	expect($out)->toContain('<table');
	expect($out)->toContain('role="presentation"');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a wrapper with background color', function () {
	$wrapperNode = new MjmlNode(
		'mj-wrapper',
		['background-color' => '#f0f0f0'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjWrapperElement = $factory->create($wrapperNode);

	$out = $mjWrapperElement->render();

	expect($out)->toContain('#f0f0f0');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a wrapper with background URL', function () {
	$wrapperNode = new MjmlNode(
		'mj-wrapper',
		['background-url' => 'https://example.com/bg.jpg'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjWrapperElement = $factory->create($wrapperNode);

	$out = $mjWrapperElement->render();

	expect($out)->toContain('https://example.com/bg.jpg');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a wrapper with padding', function () {
	$wrapperNode = new MjmlNode(
		'mj-wrapper',
		['padding' => '30px 10px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjWrapperElement = $factory->create($wrapperNode);

	$out = $mjWrapperElement->render();

	expect($out)->toContain('30px 10px');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a wrapper with border', function () {
	$wrapperNode = new MjmlNode(
		'mj-wrapper',
		['border' => '2px solid #000'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjWrapperElement = $factory->create($wrapperNode);

	$out = $mjWrapperElement->render();

	expect($out)->toContain('2px solid #000');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a wrapper with border-radius', function () {
	$wrapperNode = new MjmlNode(
		'mj-wrapper',
		['border-radius' => '10px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjWrapperElement = $factory->create($wrapperNode);

	$out = $mjWrapperElement->render();

	expect($out)->toContain('10px');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a wrapper with text-align', function () {
	$wrapperNode = new MjmlNode(
		'mj-wrapper',
		['text-align' => 'left'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjWrapperElement = $factory->create($wrapperNode);

	$out = $mjWrapperElement->render();

	expect($out)->toContain('left');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a wrapper with all custom properties', function () {
	$wrapperNode = new MjmlNode(
		'mj-wrapper',
		[
			'background-color' => '#e0e0e0',
			'background-url' => 'https://example.com/image.jpg',
			'padding' => '40px 20px',
			'border' => '1px solid #ccc',
			'border-radius' => '8px',
			'text-align' => 'right',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjWrapperElement = $factory->create($wrapperNode);

	$out = $mjWrapperElement->render();

	expect($out)->toContain('#e0e0e0');
	expect($out)->toContain('https://example.com/image.jpg');
	expect($out)->toContain('40px 20px');
	expect($out)->toContain('1px solid #ccc');
	expect($out)->toContain('8px');
	expect($out)->toContain('right');
	expect($out)->not->toBeEmpty();
});

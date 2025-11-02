<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjDivider;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjDivider();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBe(false);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-divider');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'border-color' => '#000000',
		'border-style' => 'solid',
		'border-width' => '4px',
		'padding' => '10px 25px',
		'width' => '100%',
	];

	foreach ($attributes as $key => $value) {
		expect($this->element->getAttribute($key))->toBe($value);
	}
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('invalid-attribute');
})->throws(OutOfBoundsException::class);

it('will return allowed attribute data', function () {
	$data = $this->element->getAllowedAttributeData('border-color');
	expect($data)->toBeArray();
	expect($data)->toHaveKey('type');
	expect($data)->toHaveKey('unit');
});

it('will correctly render a simple divider', function () {
	$dividerNode = new MjmlNode(
		'mj-divider',
		null,
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjDividerElement = $factory->create($dividerNode);

	expect($mjDividerElement)->toBeInstanceOf(MjDivider::class);

	$out = $mjDividerElement->render();

	expect($out)->toContain('<p');
	expect($out)->toContain('border-top');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a divider with custom color', function () {
	$dividerNode = new MjmlNode(
		'mj-divider',
		['border-color' => '#ff0000'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjDividerElement = $factory->create($dividerNode);

	$out = $mjDividerElement->render();

	expect($out)->toContain('#ff0000');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a divider with custom width', function () {
	$dividerNode = new MjmlNode(
		'mj-divider',
		['border-width' => '2px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjDividerElement = $factory->create($dividerNode);

	$out = $mjDividerElement->render();

	expect($out)->toContain('2px');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a divider with dashed style', function () {
	$dividerNode = new MjmlNode(
		'mj-divider',
		['border-style' => 'dashed'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjDividerElement = $factory->create($dividerNode);

	$out = $mjDividerElement->render();

	expect($out)->toContain('dashed');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a divider with dotted style', function () {
	$dividerNode = new MjmlNode(
		'mj-divider',
		['border-style' => 'dotted'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjDividerElement = $factory->create($dividerNode);

	$out = $mjDividerElement->render();

	expect($out)->toContain('dotted');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a divider with custom width percentage', function () {
	$dividerNode = new MjmlNode(
		'mj-divider',
		['width' => '50%'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjDividerElement = $factory->create($dividerNode);

	$out = $mjDividerElement->render();

	expect($out)->toContain('width');
	expect($out)->toContain('50%');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a divider with all custom properties', function () {
	$dividerNode = new MjmlNode(
		'mj-divider',
		[
			'border-color' => '#cccccc',
			'border-style' => 'dashed',
			'border-width' => '1px',
			'width' => '80%',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjDividerElement = $factory->create($dividerNode);

	$out = $mjDividerElement->render();

	expect($out)->toContain('#cccccc');
	expect($out)->toContain('dashed');
	expect($out)->toContain('1px');
	expect($out)->toContain('80%');
	expect($out)->not->toBeEmpty();
});

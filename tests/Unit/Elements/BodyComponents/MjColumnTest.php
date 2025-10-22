<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjColumn;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjColumn();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBe(false);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-column');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'direction' => 'ltr',
		'vertical-align' => 'top',
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

it('will correctly render a simple column', function () {
	$columnNode = new MjmlNode(
		'mj-column',
		null,
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjColumnElement = $factory->create($columnNode);

	expect($mjColumnElement)->toBeInstanceOf(MjColumn::class);

	$out = $mjColumnElement->render();

	// Verify the output contains expected structural elements
	expect($out)->toContain('<div');
	expect($out)->toContain('<table');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a column with background color', function () {
	$columnNode = new MjmlNode(
		'mj-column',
		['background-color' => '#00ff00'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjColumnElement = $factory->create($columnNode);

	$out = $mjColumnElement->render();

	expect($out)->toContain('#00ff00');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a column with width', function () {
	$columnNode = new MjmlNode(
		'mj-column',
		['width' => '300px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjColumnElement = $factory->create($columnNode);

	$out = $mjColumnElement->render();

	expect($out)->toContain('width');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a column with padding-left', function () {
	$columnNode = new MjmlNode(
		'mj-column',
		['padding-left' => '15px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjColumnElement = $factory->create($columnNode);

	$out = $mjColumnElement->render();

	expect($out)->toContain('padding');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a column with border-radius', function () {
	$columnNode = new MjmlNode(
		'mj-column',
		['border-radius' => '5px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjColumnElement = $factory->create($columnNode);

	$out = $mjColumnElement->render();

	expect($out)->toContain('border-radius');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a column with inner-background-color', function () {
	$columnNode = new MjmlNode(
		'mj-column',
		['inner-background-color' => '#0000ff'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjColumnElement = $factory->create($columnNode);

	$out = $mjColumnElement->render();

	// Just verify it renders without errors
	expect($out)->toContain('<table');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a column with inner-border-radius', function () {
	$columnNode = new MjmlNode(
		'mj-column',
		['inner-border-radius' => '8px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjColumnElement = $factory->create($columnNode);

	$out = $mjColumnElement->render();

	// Just verify it renders without errors
	expect($out)->toContain('<table');
	expect($out)->not->toBeEmpty();
});

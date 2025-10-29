<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjSpacer;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjSpacer();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBe(false);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-spacer');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'height' => '20px',
	];

	foreach ($attributes as $key => $value) {
		expect($this->element->getAttribute($key))->toBe($value);
	}
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('invalid-attribute');
})->throws(OutOfBoundsException::class);

it('will return allowed attribute data', function () {
	$data = $this->element->getAllowedAttributeData('height');
	expect($data)->toBeArray();
	expect($data)->toHaveKey('type');
	expect($data)->toHaveKey('unit');
});

it('will correctly render a simple spacer', function () {
	$spacerNode = new MjmlNode(
		'mj-spacer',
		null,
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSpacerElement = $factory->create($spacerNode);

	expect($mjSpacerElement)->toBeInstanceOf(MjSpacer::class);

	$out = $mjSpacerElement->render();

	expect($out)->toContain('<div');
	expect($out)->toContain('height');
	expect($out)->toContain('20px');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a spacer with custom height', function () {
	$spacerNode = new MjmlNode(
		'mj-spacer',
		['height' => '50px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSpacerElement = $factory->create($spacerNode);

	$out = $mjSpacerElement->render();

	expect($out)->toContain('50px');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a spacer with small height', function () {
	$spacerNode = new MjmlNode(
		'mj-spacer',
		['height' => '10px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSpacerElement = $factory->create($spacerNode);

	$out = $mjSpacerElement->render();

	expect($out)->toContain('10px');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a spacer with large height', function () {
	$spacerNode = new MjmlNode(
		'mj-spacer',
		['height' => '100px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSpacerElement = $factory->create($spacerNode);

	$out = $mjSpacerElement->render();

	expect($out)->toContain('100px');
	expect($out)->not->toBeEmpty();
});

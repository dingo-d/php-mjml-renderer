<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjGroup;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjGroup();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBe(false);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-group');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'width' => '100%',
		'vertical-align' => 'top',
		'direction' => 'ltr',
	];

	foreach ($attributes as $key => $value) {
		expect($this->element->getAttribute($key))->toBe($value);
	}
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('invalid-attribute');
})->throws(OutOfBoundsException::class);

it('will return allowed attribute data', function () {
	$data = $this->element->getAllowedAttributeData('width');
	expect($data)->toBeArray();
	expect($data)->toHaveKey('type');
	expect($data)->toHaveKey('unit');
});

it('will correctly render a simple group', function () {
	$groupNode = new MjmlNode(
		'mj-group',
		null,
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjGroupElement = $factory->create($groupNode);

	expect($mjGroupElement)->toBeInstanceOf(MjGroup::class);
});

it('will correctly set background color attribute', function () {
	$groupNode = new MjmlNode(
		'mj-group',
		['background-color' => '#f5f5f5'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjGroupElement = $factory->create($groupNode);

	expect($mjGroupElement->getAttribute('background-color'))->toBe('#f5f5f5');

	$styles = $mjGroupElement->getStyles();
	expect($styles['td']['background-color'])->toBe('#f5f5f5');
});

it('will correctly render a group with custom width', function () {
	$groupNode = new MjmlNode(
		'mj-group',
		['width' => '600px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjGroupElement = $factory->create($groupNode);

	expect($mjGroupElement)->toBeInstanceOf(MjGroup::class);
	expect($mjGroupElement->getAttribute('width'))->toBe('600px');
});

it('will correctly set vertical alignment attribute', function () {
	$groupNode = new MjmlNode(
		'mj-group',
		['vertical-align' => 'middle'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjGroupElement = $factory->create($groupNode);

	expect($mjGroupElement->getAttribute('vertical-align'))->toBe('middle');

	$styles = $mjGroupElement->getStyles();
	expect($styles['td']['vertical-align'])->toBe('middle');
});

it('will correctly set rtl direction attribute', function () {
	$groupNode = new MjmlNode(
		'mj-group',
		['direction' => 'rtl'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjGroupElement = $factory->create($groupNode);

	expect($mjGroupElement->getAttribute('direction'))->toBe('rtl');

	$styles = $mjGroupElement->getStyles();
	expect($styles['td']['direction'])->toBe('rtl');
});

it('will correctly set css class attribute', function () {
	$groupNode = new MjmlNode(
		'mj-group',
		['css-class' => 'custom-group'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjGroupElement = $factory->create($groupNode);

	expect($mjGroupElement->getAttribute('css-class'))->toBe('custom-group');
});

it('will correctly set all custom properties', function () {
	$groupNode = new MjmlNode(
		'mj-group',
		[
			'width' => '500px',
			'vertical-align' => 'bottom',
			'background-color' => '#eeeeee',
			'direction' => 'rtl',
			'css-class' => 'my-group',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjGroupElement = $factory->create($groupNode);

	expect($mjGroupElement->getAttribute('width'))->toBe('500px');
	expect($mjGroupElement->getAttribute('vertical-align'))->toBe('bottom');
	expect($mjGroupElement->getAttribute('background-color'))->toBe('#eeeeee');
	expect($mjGroupElement->getAttribute('direction'))->toBe('rtl');
	expect($mjGroupElement->getAttribute('css-class'))->toBe('my-group');

	$styles = $mjGroupElement->getStyles();
	expect($styles['td']['vertical-align'])->toBe('bottom');
	expect($styles['td']['background-color'])->toBe('#eeeeee');
	expect($styles['td']['direction'])->toBe('rtl');
});

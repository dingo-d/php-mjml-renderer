<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjButton;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjButton();
});

it('is ending tag', function () {
	expect($this->element->isEndingTag())->toBe(true);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-button');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'align' => 'center',
		'background-color' => '#414141',
		'border' => 'none',
		'border-radius' => '3px',
		'color' => '#ffffff',
		'font-family' => 'Ubuntu, Helvetica, Arial, sans-serif',
		'font-size' => '13px',
		'font-weight' => 'normal',
		'inner-padding' => '10px 25px',
		'line-height' => '120%',
		'padding' => '10px 25px',
		'target' => '_blank',
		'text-align' => 'none',
		'text-decoration' => 'none',
		'text-transform' => 'none',
		'vertical-align' => 'middle',
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

it('will correctly render a simple button', function () {
	$buttonNode = new MjmlNode(
		'mj-button',
		null,
		'Click Me',
		false,
		null
	);

	$factory = new ElementFactory();
	$mjButtonElement = $factory->create($buttonNode);

	expect($mjButtonElement)->toBeInstanceOf(MjButton::class);

	$out = $mjButtonElement->render();

	expect($out)->toContain('<table');
	expect($out)->toContain('<a');
	expect($out)->toContain('Click Me');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a button with href', function () {
	$buttonNode = new MjmlNode(
		'mj-button',
		['href' => 'https://example.com'],
		'Visit Site',
		false,
		null
	);

	$factory = new ElementFactory();
	$mjButtonElement = $factory->create($buttonNode);

	$out = $mjButtonElement->render();

	expect($out)->toContain('href="https://example.com"');
	expect($out)->toContain('Visit Site');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a button with custom background color', function () {
	$buttonNode = new MjmlNode(
		'mj-button',
		['background-color' => '#ff0000'],
		'Red Button',
		false,
		null
	);

	$factory = new ElementFactory();
	$mjButtonElement = $factory->create($buttonNode);

	$out = $mjButtonElement->render();

	expect($out)->toContain('#ff0000');
	expect($out)->toContain('Red Button');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a button with custom alignment', function () {
	$buttonNode = new MjmlNode(
		'mj-button',
		['align' => 'left'],
		'Left Aligned',
		false,
		null
	);

	$factory = new ElementFactory();
	$mjButtonElement = $factory->create($buttonNode);

	$out = $mjButtonElement->render();

	expect($out)->toContain('align="left"');
	expect($out)->toContain('Left Aligned');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a button with border radius', function () {
	$buttonNode = new MjmlNode(
		'mj-button',
		['border-radius' => '10px'],
		'Rounded',
		false,
		null
	);

	$factory = new ElementFactory();
	$mjButtonElement = $factory->create($buttonNode);

	$out = $mjButtonElement->render();

	expect($out)->toContain('border-radius');
	expect($out)->toContain('10px');
	expect($out)->toContain('Rounded');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a button with custom font', function () {
	$buttonNode = new MjmlNode(
		'mj-button',
		[
			'font-family' => 'Arial',
			'font-size' => '16px',
			'font-weight' => '700',
		],
		'Custom Font',
		false,
		null
	);

	$factory = new ElementFactory();
	$mjButtonElement = $factory->create($buttonNode);

	$out = $mjButtonElement->render();

	expect($out)->toContain('Arial');
	expect($out)->toContain('16px');
	expect($out)->toContain('700');
	expect($out)->toContain('Custom Font');
	expect($out)->not->toBeEmpty();
});

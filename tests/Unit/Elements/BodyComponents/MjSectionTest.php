<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjSection;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjSection();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBe(false);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-section');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'background-repeat' => 'repeat',
		'background-size' => 'auto',
		'background-position' => 'top center',
		'direction' => 'ltr',
		'padding' => '20px 0',
		'text-align' => 'center',
		'text-padding' => '4px 4px 4px 0',
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

it('will correctly render a simple section', function () {
	$sectionNode = new MjmlNode(
		'mj-section',
		null,
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSectionElement = $factory->create($sectionNode);

	expect($mjSectionElement)->toBeInstanceOf(MjSection::class);

	$out = $mjSectionElement->render();

	// Verify the output contains expected structural elements
	expect($out)->toContain('<div');
	expect($out)->toContain('<table');
	expect($out)->toContain('<!--[if mso | IE]>');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a section with background color', function () {
	$sectionNode = new MjmlNode(
		'mj-section',
		['background-color' => '#ff0000'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSectionElement = $factory->create($sectionNode);

	$out = $mjSectionElement->render();

	expect($out)->toContain('#ff0000');
	expect($out)->not->toBeEmpty();
});

it('will correctly handle full-width sections', function () {
	$sectionNode = new MjmlNode(
		'mj-section',
		['full-width' => 'full-width'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSectionElement = $factory->create($sectionNode);

	$out = $mjSectionElement->render();

	expect($out)->toContain('<table');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a section with padding-top', function () {
	$sectionNode = new MjmlNode(
		'mj-section',
		['padding-top' => '20px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSectionElement = $factory->create($sectionNode);

	$out = $mjSectionElement->render();

	expect($out)->toContain('padding');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a section with border-radius', function () {
	$sectionNode = new MjmlNode(
		'mj-section',
		['border-radius' => '10px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSectionElement = $factory->create($sectionNode);

	$out = $mjSectionElement->render();

	expect($out)->toContain('border-radius');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a section with text-align', function () {
	$sectionNode = new MjmlNode(
		'mj-section',
		['text-align' => 'left'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjSectionElement = $factory->create($sectionNode);

	$out = $mjSectionElement->render();

	expect($out)->toContain('text-align');
	expect($out)->not->toBeEmpty();
});

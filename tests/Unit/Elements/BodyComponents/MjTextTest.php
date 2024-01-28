<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Renderer;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjText;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;

beforeEach(function () {
    $this->element = new MjText();
});

it('is ending tag', function () {
	expect($this->element->isEndingTag())->toBeTrue();
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-text');
});

it('returns the correct default attribute', function () {
	expect($this->element->getAllowedAttributeData('color'))
		->toBeArray()
		->and($this->element->getAllowedAttributeData('color')['default_value'])
		->toBe('#000000');
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('colour');
})->expectException(\OutOfBoundsException::class);

it('will throw out of bounds exception if the allowed attribute property is not existing', function () {
	$this->element->getAllowedAttributeData('colour')['name'];
})->expectException(\OutOfBoundsException::class);

it('Will correctly render the desired element', function () {
	$textNode = new MjmlNode(
		'mj-text',
		[],
		'Hello World!',
		false,
		null,
	);

	$factory = new ElementFactory();

	$mjTextElement = $factory->create($textNode);

	expect($mjTextElement)->toBeInstanceOf(MjText::class);

	$out = $mjTextElement->render();

	expect($out)->toBe('<div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">Hello World!</div>');
});

it('Will correctly render the desired element with overridden attributes', function () {
	$textNode = new MjmlNode(
		'mj-text',
		[
			'color' => '#FF0000',
		],
		'Hello World!',
		false,
		null,
	);

	$factory = new ElementFactory();

	$mjTextElement = $factory->create($textNode);

	expect($mjTextElement)->toBeInstanceOf(MjText::class);

	$out = $mjTextElement->render();

	expect($out)->toBe('<div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#FF0000;">Hello World!</div>');
});

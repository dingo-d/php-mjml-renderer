<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements;


use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjBody;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
    $this->element = new MjBody();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBeFalse();
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-body');
});

it('returns the correct default attribute', function () {
	expect($this->element->getAllowedAttributeData('background-color'))
		->toBeArray()
		->and($this->element->getAllowedAttributeData('background-color')['default_value'])
		->toBe('#FFFFFF');
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('colour');
})->throws(OutOfBoundsException::class);

it('will throw out of bounds exception if the allowed attribute property is not existing', function () {
	$this->element->getAllowedAttributeData('colour')['name'];
})->throws(OutOfBoundsException::class);

it('will correctly render the desired element', function () {
	$bodyNode = new MjmlNode(
		'mj-body',
		null,
		null,
		false,
		[
			new MjmlNode(
				'mj-section',
				null,
				null,
				false,
				[
					new MjmlNode(
						'mj-column',
						null,
						null,
						false,
						[
							new MjmlNode(
								'mj-text',
								null,
								'Hello World!',
								false,
								null,
							),
						]
					),
				]
			),
		]
	);

	$factory = new ElementFactory();

	$mjBodyElement = $factory->create($bodyNode);

	expect($mjBodyElement)->toBeInstanceOf(MjBody::class);

	$out = $mjBodyElement->render();

	// Verify the output contains expected structural elements
	expect($out)->toContain('Hello World!');
	expect($out)->toContain('mj-column');
	expect($out)->toContain('<!--[if mso | IE]>');
	expect($out)->toContain('<table');
	expect($out)->not->toBeEmpty();
});

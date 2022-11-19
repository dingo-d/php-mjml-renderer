<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Renderer;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjText;

beforeEach(function () {
    $this->element = new MjText();
});

it('is ending tag', function () {
	expect($this->element->isEndingTag())->toBeTrue();
});

it('returns the correct component name', function () {
	expect($this->element->getComponentName())->toBe('mj-text');
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

<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjAccordion;
use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjAccordionElement;
use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjAccordionTitle;
use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjAccordionText;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

describe('MjAccordion', function () {
	beforeEach(function () {
		$this->element = new MjAccordion();
	});

	it('is not ending tag', function () {
		expect($this->element->isEndingTag())->toBe(false);
	});

	it('returns the correct component name', function () {
		expect($this->element->getTagName())->toBe('mj-accordion');
	});

	it('returns the correct default attributes', function () {
		$attributes = [
			'border' => '2px solid black',
			'font-family' => 'Ubuntu, Helvetica, Arial, sans-serif',
			'icon-align' => 'middle',
			'icon-height' => '32px',
			'icon-position' => 'right',
			'icon-width' => '32px',
			'padding' => '10px 25px',
		];

		foreach ($attributes as $key => $value) {
			expect($this->element->getAttribute($key))->toBe($value);
		}
	});

	it('will throw out of bounds exception if the allowed attribute is not existing', function () {
		$this->element->getAllowedAttributeData('invalid-attribute');
	})->throws(OutOfBoundsException::class);

	it('will correctly set custom border', function () {
		$accordionNode = new MjmlNode(
			'mj-accordion',
			['border' => '1px dashed red'],
			null,
			false,
			null
		);

		$factory = new ElementFactory();
		$mjAccordionElement = $factory->create($accordionNode);

		expect($mjAccordionElement->getAttribute('border'))->toBe('1px dashed red');
	});
});

describe('MjAccordionElement', function () {
	beforeEach(function () {
		$this->element = new MjAccordionElement();
	});

	it('is not ending tag', function () {
		expect($this->element->isEndingTag())->toBe(false);
	});

	it('returns the correct component name', function () {
		expect($this->element->getTagName())->toBe('mj-accordion-element');
	});

	it('will correctly render an accordion element', function () {
		$mjElement = new MjAccordionElement();

		expect($mjElement)->toBeInstanceOf(MjAccordionElement::class);

		$out = $mjElement->render();
		expect($out)->toContain('<div');
		expect($out)->not->toBeEmpty();
	});

	it('will correctly set background color', function () {
		$mjElement = new MjAccordionElement(['background-color' => '#f0f0f0']);

		expect($mjElement->getAttribute('background-color'))->toBe('#f0f0f0');

		$styles = $mjElement->getStyles();
		expect($styles['div']['background-color'])->toBe('#f0f0f0');
	});
});

describe('MjAccordionTitle', function () {
	beforeEach(function () {
		$this->element = new MjAccordionTitle();
	});

	it('is ending tag', function () {
		expect($this->element->isEndingTag())->toBe(true);
	});

	it('returns the correct component name', function () {
		expect($this->element->getTagName())->toBe('mj-accordion-title');
	});

	it('returns the correct default attributes', function () {
		$attributes = [
			'color' => '#000000',
			'font-size' => '13px',
			'padding' => '16px',
		];

		foreach ($attributes as $key => $value) {
			expect($this->element->getAttribute($key))->toBe($value);
		}
	});

	it('will correctly render a title', function () {
		$titleNode = new MjmlNode(
			'mj-accordion-title',
			null,
			'Accordion Title',
			true,
			null
		);

		$factory = new ElementFactory();
		$mjTitleElement = $factory->create($titleNode);

		expect($mjTitleElement)->toBeInstanceOf(MjAccordionTitle::class);

		$out = $mjTitleElement->render();
		expect($out)->toContain('<td');
		expect($out)->toContain('Accordion Title');
		expect($out)->not->toBeEmpty();
	});

	it('will correctly set custom color', function () {
		$titleNode = new MjmlNode(
			'mj-accordion-title',
			['color' => '#ff0000'],
			'Red Title',
			true,
			null
		);

		$factory = new ElementFactory();
		$mjTitleElement = $factory->create($titleNode);

		expect($mjTitleElement->getAttribute('color'))->toBe('#ff0000');
	});
});

describe('MjAccordionText', function () {
	beforeEach(function () {
		$this->element = new MjAccordionText();
	});

	it('is ending tag', function () {
		expect($this->element->isEndingTag())->toBe(true);
	});

	it('returns the correct component name', function () {
		expect($this->element->getTagName())->toBe('mj-accordion-text');
	});

	it('returns the correct default attributes', function () {
		$attributes = [
			'color' => '#000000',
			'font-size' => '13px',
			'letter-spacing' => 'none',
			'line-height' => '1',
			'padding' => '16px',
		];

		foreach ($attributes as $key => $value) {
			expect($this->element->getAttribute($key))->toBe($value);
		}
	});

	it('will correctly render accordion text', function () {
		$textNode = new MjmlNode(
			'mj-accordion-text',
			null,
			'Accordion content text',
			true,
			null
		);

		$factory = new ElementFactory();
		$mjTextElement = $factory->create($textNode);

		expect($mjTextElement)->toBeInstanceOf(MjAccordionText::class);

		$out = $mjTextElement->render();
		expect($out)->toContain('<td');
		expect($out)->toContain('Accordion content text');
		expect($out)->not->toBeEmpty();
	});

	it('will correctly set custom font properties', function () {
		$textNode = new MjmlNode(
			'mj-accordion-text',
			[
				'color' => '#333333',
				'font-size' => '14px',
				'line-height' => '1.5',
			],
			'Styled text',
			true,
			null
		);

		$factory = new ElementFactory();
		$mjTextElement = $factory->create($textNode);

		expect($mjTextElement->getAttribute('color'))->toBe('#333333');
		expect($mjTextElement->getAttribute('font-size'))->toBe('14px');
		expect($mjTextElement->getAttribute('line-height'))->toBe('1.5');
	});
});

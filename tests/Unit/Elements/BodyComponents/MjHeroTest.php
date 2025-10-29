<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjHero;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjHero();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBe(false);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-hero');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'background-color' => '#ffffff',
		'background-position' => 'center center',
		'mode' => 'fluid-height',
		'padding' => '0px',
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

it('will correctly render a simple hero', function () {
	$heroNode = new MjmlNode(
		'mj-hero',
		null,
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjHeroElement = $factory->create($heroNode);

	expect($mjHeroElement)->toBeInstanceOf(MjHero::class);

	$out = $mjHeroElement->render();

	expect($out)->toContain('<div');
	expect($out)->toContain('<table');
	expect($out)->toContain('role="presentation"');
	expect($out)->not->toBeEmpty();
});

it('will correctly set background color', function () {
	$heroNode = new MjmlNode(
		'mj-hero',
		['background-color' => '#ff0000'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjHeroElement = $factory->create($heroNode);

	expect($mjHeroElement->getAttribute('background-color'))->toBe('#ff0000');

	$styles = $mjHeroElement->getStyles();
	expect($styles['table']['background-color'])->toBe('#ff0000');
});

it('will correctly set background URL', function () {
	$heroNode = new MjmlNode(
		'mj-hero',
		['background-url' => 'https://example.com/hero.jpg'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjHeroElement = $factory->create($heroNode);

	expect($mjHeroElement->getAttribute('background-url'))->toBe('https://example.com/hero.jpg');

	$out = $mjHeroElement->render();
	expect($out)->toContain('https://example.com/hero.jpg');
});

it('will correctly set height in fixed-height mode', function () {
	$heroNode = new MjmlNode(
		'mj-hero',
		[
			'mode' => 'fixed-height',
			'height' => '500px',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjHeroElement = $factory->create($heroNode);

	expect($mjHeroElement->getAttribute('mode'))->toBe('fixed-height');
	expect($mjHeroElement->getAttribute('height'))->toBe('500px');

	$styles = $mjHeroElement->getStyles();
	expect($styles['td']['height'])->toBe('500px');
});

it('will not set height in fluid-height mode', function () {
	$heroNode = new MjmlNode(
		'mj-hero',
		[
			'mode' => 'fluid-height',
			'height' => '500px',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjHeroElement = $factory->create($heroNode);

	$styles = $mjHeroElement->getStyles();
	expect($styles['td'])->not->toHaveKey('height');
});

it('will correctly set vertical alignment', function () {
	$heroNode = new MjmlNode(
		'mj-hero',
		['vertical-align' => 'middle'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjHeroElement = $factory->create($heroNode);

	$styles = $mjHeroElement->getStyles();
	expect($styles['tr']['vertical-align'])->toBe('middle');
});

it('will correctly set padding', function () {
	$heroNode = new MjmlNode(
		'mj-hero',
		['padding' => '20px 10px'],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjHeroElement = $factory->create($heroNode);

	$styles = $mjHeroElement->getStyles();
	expect($styles['td']['padding'])->toBe('20px 10px');
});

it('will correctly set all custom properties', function () {
	$heroNode = new MjmlNode(
		'mj-hero',
		[
			'background-color' => '#333333',
			'background-url' => 'https://example.com/bg.jpg',
			'background-position' => 'top left',
			'mode' => 'fixed-height',
			'height' => '400px',
			'padding' => '30px',
			'vertical-align' => 'bottom',
			'width' => '600px',
		],
		null,
		false,
		null
	);

	$factory = new ElementFactory();
	$mjHeroElement = $factory->create($heroNode);

	expect($mjHeroElement->getAttribute('background-color'))->toBe('#333333');
	expect($mjHeroElement->getAttribute('background-url'))->toBe('https://example.com/bg.jpg');
	expect($mjHeroElement->getAttribute('mode'))->toBe('fixed-height');

	$styles = $mjHeroElement->getStyles();
	expect($styles['table']['background-color'])->toBe('#333333');
	expect($styles['table']['background-position'])->toBe('top left');
	expect($styles['tr']['vertical-align'])->toBe('bottom');
	expect($styles['td']['height'])->toBe('400px');
	expect($styles['td']['padding'])->toBe('30px');
	expect($styles['div']['max-width'])->toBe('600px');
});

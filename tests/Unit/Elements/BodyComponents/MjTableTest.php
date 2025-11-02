<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjTable;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
	$this->element = new MjTable();
});

it('is ending tag', function () {
	expect($this->element->isEndingTag())->toBe(true);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-table');
});

it('returns the correct default attributes', function () {
	$attributes = [
		'align' => 'left',
		'border' => 'none',
		'cellpadding' => '0',
		'cellspacing' => '0',
		'color' => '#000000',
		'font-family' => 'Ubuntu, Helvetica, Arial, sans-serif',
		'font-size' => '13px',
		'line-height' => '22px',
		'padding' => '10px 25px',
		'role' => 'presentation',
		'table-layout' => 'auto',
		'width' => '100%',
	];

	foreach ($attributes as $key => $value) {
		expect($this->element->getAttribute($key))->toBe($value);
	}
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('invalid-attribute');
})->throws(OutOfBoundsException::class);

it('will return allowed attribute data', function () {
	$data = $this->element->getAllowedAttributeData('color');
	expect($data)->toBeArray();
	expect($data)->toHaveKey('type');
	expect($data)->toHaveKey('unit');
});

it('will correctly render a simple table', function () {
	$tableNode = new MjmlNode(
		'mj-table',
		null,
		'<tr><td>Cell 1</td><td>Cell 2</td></tr>',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjTableElement = $factory->create($tableNode);

	expect($mjTableElement)->toBeInstanceOf(MjTable::class);

	$out = $mjTableElement->render();

	expect($out)->toContain('<table');
	expect($out)->toContain('<tr><td>Cell 1</td><td>Cell 2</td></tr>');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a table with custom color', function () {
	$tableNode = new MjmlNode(
		'mj-table',
		['color' => '#ff0000'],
		'<tr><td>Red Text</td></tr>',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjTableElement = $factory->create($tableNode);

	$out = $mjTableElement->render();

	expect($out)->toContain('#ff0000');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a table with custom border', function () {
	$tableNode = new MjmlNode(
		'mj-table',
		['border' => '1px solid #000'],
		'<tr><td>Content</td></tr>',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjTableElement = $factory->create($tableNode);

	$out = $mjTableElement->render();

	expect($out)->toContain('1px solid #000');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a table with custom width', function () {
	$tableNode = new MjmlNode(
		'mj-table',
		['width' => '600px'],
		'<tr><td>Content</td></tr>',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjTableElement = $factory->create($tableNode);

	$out = $mjTableElement->render();

	expect($out)->toContain('600px');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a table with custom table-layout', function () {
	$tableNode = new MjmlNode(
		'mj-table',
		['table-layout' => 'fixed'],
		'<tr><td>Content</td></tr>',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjTableElement = $factory->create($tableNode);

	$out = $mjTableElement->render();

	expect($out)->toContain('fixed');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a table with all custom properties', function () {
	$tableNode = new MjmlNode(
		'mj-table',
		[
			'color' => '#333333',
			'font-family' => 'Arial, sans-serif',
			'font-size' => '14px',
			'line-height' => '20px',
			'width' => '500px',
			'border' => '2px solid #ccc',
			'table-layout' => 'fixed',
		],
		'<tr><td>Custom Table</td></tr>',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjTableElement = $factory->create($tableNode);

	$out = $mjTableElement->render();

	expect($out)->toContain('#333333');
	expect($out)->toContain('Arial, sans-serif');
	expect($out)->toContain('14px');
	expect($out)->toContain('20px');
	expect($out)->toContain('500px');
	expect($out)->toContain('2px solid #ccc');
	expect($out)->toContain('fixed');
	expect($out)->toContain('<tr><td>Custom Table</td></tr>');
	expect($out)->not->toBeEmpty();
});

it('will correctly render a complex table with multiple rows', function () {
	$tableNode = new MjmlNode(
		'mj-table',
		['border' => '1px solid #ddd'],
		'<thead><tr><th>Header 1</th><th>Header 2</th></tr></thead><tbody><tr><td>Row 1, Cell 1</td><td>Row 1, Cell 2</td></tr><tr><td>Row 2, Cell 1</td><td>Row 2, Cell 2</td></tr></tbody>',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjTableElement = $factory->create($tableNode);

	$out = $mjTableElement->render();

	expect($out)->toContain('<thead>');
	expect($out)->toContain('<th>Header 1</th>');
	expect($out)->toContain('<tbody>');
	expect($out)->toContain('Row 1, Cell 1');
	expect($out)->toContain('Row 2, Cell 2');
	expect($out)->not->toBeEmpty();
});

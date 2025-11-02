<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjRaw;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;

beforeEach(function () {
	$this->element = new MjRaw();
});

it('is ending tag', function () {
	expect($this->element->isEndingTag())->toBe(true);
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-raw');
});

it('has no default attributes', function () {
	// mj-raw has no attributes, so we just verify it doesn't error
	expect($this->element)->toBeInstanceOf(MjRaw::class);
});

it('will correctly render raw HTML', function () {
	$rawNode = new MjmlNode(
		'mj-raw',
		null,
		'<div style="color: red;">Raw HTML Content</div>',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjRawElement = $factory->create($rawNode);

	expect($mjRawElement)->toBeInstanceOf(MjRaw::class);

	$out = $mjRawElement->render();

	expect($out)->toBe('<div style="color: red;">Raw HTML Content</div>');
	expect($out)->not->toBeEmpty();
});

it('will pass through complex HTML unchanged', function () {
	$complexHtml = '<table><tr><td style="padding: 10px;"><a href="https://example.com">Link</a></td></tr></table>';

	$rawNode = new MjmlNode(
		'mj-raw',
		null,
		$complexHtml,
		true,
		null
	);

	$factory = new ElementFactory();
	$mjRawElement = $factory->create($rawNode);

	$out = $mjRawElement->render();

	expect($out)->toBe($complexHtml);
});

it('will preserve whitespace and formatting', function () {
	$htmlWithWhitespace = "  <div>\n    <p>Paragraph</p>\n  </div>  ";

	$rawNode = new MjmlNode(
		'mj-raw',
		null,
		$htmlWithWhitespace,
		true,
		null
	);

	$factory = new ElementFactory();
	$mjRawElement = $factory->create($rawNode);

	$out = $mjRawElement->render();

	expect($out)->toBe($htmlWithWhitespace);
});

it('will pass through empty content', function () {
	$rawNode = new MjmlNode(
		'mj-raw',
		null,
		'',
		true,
		null
	);

	$factory = new ElementFactory();
	$mjRawElement = $factory->create($rawNode);

	$out = $mjRawElement->render();

	expect($out)->toBe('');
});

it('will pass through HTML comments', function () {
	$htmlWithComments = '<!-- This is a comment --><div>Content</div><!-- Another comment -->';

	$rawNode = new MjmlNode(
		'mj-raw',
		null,
		$htmlWithComments,
		true,
		null
	);

	$factory = new ElementFactory();
	$mjRawElement = $factory->create($rawNode);

	$out = $mjRawElement->render();

	expect($out)->toBe($htmlWithComments);
});

it('will pass through scripts and styles', function () {
	$htmlWithScript = '<script>console.log("test");</script><style>.class { color: blue; }</style>';

	$rawNode = new MjmlNode(
		'mj-raw',
		null,
		$htmlWithScript,
		true,
		null
	);

	$factory = new ElementFactory();
	$mjRawElement = $factory->create($rawNode);

	$out = $mjRawElement->render();

	expect($out)->toBe($htmlWithScript);
});

it('will pass through special characters', function () {
	$htmlWithSpecialChars = '<div>&nbsp;&copy;&trade;<>&"\'</div>';

	$rawNode = new MjmlNode(
		'mj-raw',
		null,
		$htmlWithSpecialChars,
		true,
		null
	);

	$factory = new ElementFactory();
	$mjRawElement = $factory->create($rawNode);

	$out = $mjRawElement->render();

	expect($out)->toBe($htmlWithSpecialChars);
});

it('returns empty styles array', function () {
	$styles = $this->element->getStyles();
	expect($styles)->toBeArray();
	expect($styles)->toBeEmpty();
});

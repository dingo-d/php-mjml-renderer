<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents\MjHead;
use MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents\MjTitle;
use MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents\MjPreview;
use MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents\MjFont;
use MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents\MjStyle;
use MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents\MjBreakpoint;
use MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents\MjAttributes;
use MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents\MjHtmlAttributes;

describe('MjHead', function () {
	it('has correct tag name', fn() => expect((new MjHead())->getTagName())->toBe('mj-head'));
	it('is not ending tag', fn() => expect((new MjHead())->isEndingTag())->toBe(false));
});

describe('MjTitle', function () {
	it('has correct tag name', fn() => expect((new MjTitle())->getTagName())->toBe('mj-title'));
	it('is ending tag', fn() => expect((new MjTitle())->isEndingTag())->toBe(true));
	
	it('renders title correctly', function () {
		$element = new MjTitle([], 'My Email Title');
		expect($element->render())->toBe('<title>My Email Title</title>');
	});
});

describe('MjPreview', function () {
	it('has correct tag name', fn() => expect((new MjPreview())->getTagName())->toBe('mj-preview'));
	it('is ending tag', fn() => expect((new MjPreview())->isEndingTag())->toBe(true));
	
	it('renders preview text as hidden div', function () {
		$element = new MjPreview([], 'Preview text here');
		$out = $element->render();
		expect($out)->toContain('display:none');
		expect($out)->toContain('Preview text here');
	});
});

describe('MjFont', function () {
	it('has correct tag name', fn() => expect((new MjFont())->getTagName())->toBe('mj-font'));
	
	it('renders font link correctly', function () {
		$element = new MjFont([
			'name' => 'Roboto',
			'href' => 'https://fonts.googleapis.com/css?family=Roboto',
		]);
		$out = $element->render();
		expect($out)->toContain('<link');
		expect($out)->toContain('https://fonts.googleapis.com/css?family=Roboto');
		expect($out)->toContain("rel='stylesheet'");
	});

	it('returns empty string when no href', function () {
		$element = new MjFont(['name' => 'Roboto']);
		expect($element->render())->toBe('');
	});
});

describe('MjStyle', function () {
	it('has correct tag name', fn() => expect((new MjStyle())->getTagName())->toBe('mj-style'));
	
	it('renders style tag by default', function () {
		$element = new MjStyle([], '.test { color: red; }');
		$out = $element->render();
		expect($out)->toContain('<style');
		expect($out)->toContain('.test { color: red; }');
	});

	it('renders inline when inline attribute is set', function () {
		$element = new MjStyle(['inline' => 'inline'], '.test { color: blue; }');
		expect($element->render())->toBe('.test { color: blue; }');
	});
});

describe('MjBreakpoint', function () {
	it('has correct tag name', fn() => expect((new MjBreakpoint())->getTagName())->toBe('mj-breakpoint'));
	
	it('has default width', function () {
		$element = new MjBreakpoint();
		expect($element->getAttribute('width'))->toBe('480px');
	});

	it('can set custom width', function () {
		$element = new MjBreakpoint(['width' => '600px']);
		expect($element->getAttribute('width'))->toBe('600px');
	});
});

describe('MjAttributes', function () {
	it('has correct tag name', fn() => expect((new MjAttributes())->getTagName())->toBe('mj-attributes'));
	it('renders empty', fn() => expect((new MjAttributes())->render())->toBe(''));
});

describe('MjHtmlAttributes', function () {
	it('has correct tag name', function () {
		expect((new MjHtmlAttributes())->getTagName())->toBe('mj-html-attributes');
	});
	it('renders empty', fn() => expect((new MjHtmlAttributes())->render())->toBe(''));
});

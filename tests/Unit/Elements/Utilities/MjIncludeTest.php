<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\Utilities;

use MadeByDenis\PhpMjmlRenderer\Elements\Utilities\MjInclude;

describe('MjInclude', function () {
	it('has correct tag name', fn() => expect((new MjInclude())->getTagName())->toBe('mj-include'));
	
	it('has default type mjml', function () {
		$element = new MjInclude();
		expect($element->getAttribute('type'))->toBe('mjml');
	});

	it('returns empty string for non-existent file', function () {
		$element = new MjInclude(['path' => '/non/existent/file.mjml']);
		expect($element->render())->toBe('');
	});
});

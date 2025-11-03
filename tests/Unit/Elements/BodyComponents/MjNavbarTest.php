<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjNavbar;
use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjNavbarLink;

it('MjNavbar has correct tag name', fn() => expect((new MjNavbar())->getTagName())->toBe('mj-navbar'));
it('MjNavbarLink has correct tag name', fn() => expect((new MjNavbarLink())->getTagName())->toBe('mj-navbar-link'));
it('MjNavbarLink renders link', function () {
	$element = new MjNavbarLink(['href' => 'test.html'], 'Link Text');
	expect($element->render())->toContain('<a')->toContain('test.html')->toContain('Link Text');
});

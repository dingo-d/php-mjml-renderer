<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjSocial;
use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjSocialElement;

it('MjSocial has correct tag name', fn() => expect((new MjSocial())->getTagName())->toBe('mj-social'));
it('MjSocial has correct defaults', fn() => expect((new MjSocial())->getAttribute('mode'))->toBe('horizontal'));

it('MjSocialElement has correct tag name', function () {
	expect((new MjSocialElement())->getTagName())->toBe('mj-social-element');
});

it('MjSocialElement renders', function () {
	$element = new MjSocialElement(['href' => 'https://facebook.com'], 'Facebook');
	$out = $element->render();
	expect($out)->toContain('<a')->toContain('https://facebook.com')->toContain('Facebook');
});

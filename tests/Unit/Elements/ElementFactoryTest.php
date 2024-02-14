<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements;

use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjText;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;

beforeEach(function () {
    $this->factory = new ElementFactory();
});

it('Will correctly return class of the desired element', function () {
	$textNode = new MjmlNode(
		'mj-text',
		[],
		'Hello World!',
		false,
		null,
	);

	$mjTextElement = $this->factory->create($textNode);

	expect($mjTextElement)->toBeInstanceOf(MjText::class);
});

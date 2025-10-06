<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Parser;

use MadeByDenis\PhpMjmlRenderer\Node;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;

beforeEach(function () {
    $this->node = new MjmlNode(
		'mj-text',
		[
			'mj-class' => 'blue big',
		],
		'Hello World!',
		false,
		null
	);
});

it('will return the tag', function() {
	expect($this->node->getTag())->toBe('mj-text');
});

it('will return boolean if the tag is self-closing or not', function() {
	expect($this->node->isSelfClosing())->toBeFalse();
});

it('will return the array of attributes', function() {
	$attributes = $this->node->getAttributes();
	expect($attributes)
		->toBeArray()
		->toHaveKey('mj-class')
		->and($attributes['mj-class'])->toBe('blue big');
});

it('will return the content of the node', function() {
	expect($this->node->getInnerContent())->toBe('Hello World!');
});

it('will return attribute value', function() {
	expect($this->node->getAttributeValue('mj-class'))->toBe('blue big');
});

it('will return empty array if there are no children nodes', function() {
	expect($this->node->getChildren())->toBeEmpty();
});

it('will return the children nodes', function() {
	$node = new MjmlNode(
		'mj-column',
		null,
		null,
		false,
		[
			new MjmlNode(
				'mj-text',
				[
					'mj-class' => 'blue big'
				],
				'Hello World!',
				false,
				null,
			),
		]
	);

	expect($node->getChildren())
		->toBeArray()
		->and($node->getChildren()[0])
		->toBeInstanceOf(Node::class);
});

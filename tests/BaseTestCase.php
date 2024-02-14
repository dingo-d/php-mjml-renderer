<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests;

use MadeByDenis\PhpMjmlRenderer\Elements\Element;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlParser;
use MadeByDenis\PhpMjmlRenderer\Renderer\MjmlRenderer;
use PHPUnit\Framework\TestCase;

#[AllowDynamicProperties]
class BaseTestCase extends TestCase
{
	private ?MjmlRenderer $renderer;
	private ?MjmlParser $parser;
	private ?MjmlNode $node;
	private ?Element $element;
}

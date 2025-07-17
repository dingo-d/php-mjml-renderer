<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Parser;

use MadeByDenis\PhpMjmlRenderer\Node;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use MadeByDenis\PhpMjmlRenderer\ParserFactory;

beforeEach(function () {
    $this->parser = ParserFactory::create();
});

it('parses single element', function() {
	$mjml = <<<'MJML'
    <mj-text mj-class="blue big">
      Hello World!
    </mj-text>
MJML;
	$parsedContent = $this->parser->parse($mjml);

	expect($parsedContent)
		->toBeInstanceOf(Node::class)
		->toEqualCanonicalizing(
		new MjmlNode(
			'mj-text',
			[
				'mj-class' => 'blue big',
			],
			'Hello World!',
			false,
			null
		)
	);
});

it('parses content with child elements', function () {
	$mjml = <<<'MJML'
<mjml>
  <mj-head background-color="#FFF">
    <mj-attributes>
      <mj-text padding="0" />
      <mj-class name="blue" color="blue" />
      <mj-class name="big" font-size="20px" />
      <mj-all font-family="Arial" />
    </mj-attributes>
  </mj-head>
  <mj-body>
    <mj-section>
      <mj-column>
        <mj-text mj-class="blue big">
          Hello World!
        </mj-text>
      </mj-column>
    </mj-section>
  </mj-body>
</mjml>
MJML;

	$parsedContent = $this->parser->parse($mjml);
	expect($parsedContent)
		->toBeInstanceOf(Node::class)
		->toEqualCanonicalizing(
		new MjmlNode(
			'mjml',
			null,
			null,
			false,
			[
				new MjmlNode(
					'mj-head',
					[
						'background-color' => '#FFF',
					],
					null,
					false,
					[
						new MjmlNode(
							'mj-attributes',
							null,
							null,
							false,
							[
								new MjmlNode(
									'mj-text',
									[
										'padding' => '0',
									],
									null,
									true,
									null
								),
								new MjmlNode(
									'mj-class',
									[
										'name' => 'blue',
										'color' => 'blue',
									],
									null,
									true,
									null
								),
								new MjmlNode(
									'mj-class',
									[
										'name' => 'big',
										'font-size' => '20px',
									],
									null,
									true,
									null
								),
								new MjmlNode(
									'mj-all',
									[
										'font-family' => 'Arial',
									],
									null,
									true,
									null
								),
							]
						),
					]
				),
				new MjmlNode(
					'mj-body',
					null,
					null,
					false,
					[
						new MjmlNode(
							'mj-section',
							null,
							null,
							false,
							[
								new MjmlNode(
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
								),
							]
						),
					]
				),
			]
		)
	);
});

it('throws error on malformed MJML code', function () {
	$mjml = <<<'MJML'
    <mj-text mj
      Hello World!
    </mj-text>
MJML;
	$this->parser->parse($mjml);
})->expectExceptionMessage('Badly formatted MJML code.');

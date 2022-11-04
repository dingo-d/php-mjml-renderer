<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Parser;

beforeEach(function () {
    $this->parser = \MadeByDenis\PhpMjmlRenderer\ParserFactory::create();
});

it('parses content', function () {
	$mjml = <<<'MJML'
<mjml>
  <mj-head>
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

var_export($parsedContent);

});

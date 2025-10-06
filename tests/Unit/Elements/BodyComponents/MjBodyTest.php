<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Elements;


use MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents\MjBody;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;
use MadeByDenis\PhpMjmlRenderer\Parser\MjmlNode;
use OutOfBoundsException;

beforeEach(function () {
    $this->element = new MjBody();
});

it('is not ending tag', function () {
	expect($this->element->isEndingTag())->toBeFalse();
});

it('returns the correct component name', function () {
	expect($this->element->getTagName())->toBe('mj-body');
});

it('returns the correct default attribute', function () {
	expect($this->element->getAllowedAttributeData('background-color'))
		->toBeArray()
		->and($this->element->getAllowedAttributeData('background-color')['default_value'])
		->toBe('#FFFFFF');
});

it('will throw out of bounds exception if the allowed attribute is not existing', function () {
	$this->element->getAllowedAttributeData('colour');
})->throws(OutOfBoundsException::class);

it('will throw out of bounds exception if the allowed attribute property is not existing', function () {
	$this->element->getAllowedAttributeData('colour')['name'];
})->throws(OutOfBoundsException::class);

it('will correctly render the desired element', function () {
	$bodyNode = new MjmlNode(
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
								null,
								'Hello World!',
								false,
								null,
							),
						]
					),
				]
			),
		]
	);

	$factory = new ElementFactory();

	$mjBodyElement = $factory->create($bodyNode);

	expect($mjBodyElement)->toBeInstanceOf(MjBody::class);

	$out = $mjBodyElement->render();

	expect($out)->toBe('<body style="word-spacing:normal;">
<div><!--[if mso | IE]>
	<table align="center"
		   border="0"
		   cellpadding="0"
		   cellspacing="0"
		   class=""
		   style="width:600px;"
		   width="600">
		<tr>
			<td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
	<div style="margin:0px auto;max-width:600px;">
		<table align="center"
			   border="0"
			   cellpadding="0"
			   cellspacing="0"
			   role="presentation"
			   style="width:100%;">
			<tbody>
			<tr>
				<td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]>
					<table role="presentation"
						   border="0"
						   cellpadding="0"
						   cellspacing="0">
						<tr>
							<td class=""
								style="vertical-align:top;width:600px;"><![endif]-->
					<div class="mj-column-per-100 mj-outlook-group-fix"
						 style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
						<table border="0"
							   cellpadding="0"
							   cellspacing="0"
							   role="presentation"
							   style="vertical-align:top;"
							   width="100%">
							<tbody>
							<tr>
								<td align="left"
									style="font-size:0px;padding:10px 25px;word-break:break-word;">
									<div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
										Hello world
									</div>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					<!--[if mso | IE]></td></tr></table><![endif]--></td>
			</tr>
			</tbody>
		</table>
	</div>
	<!--[if mso | IE]></td></tr></table><![endif]--></div>
</body>');
})->skip();

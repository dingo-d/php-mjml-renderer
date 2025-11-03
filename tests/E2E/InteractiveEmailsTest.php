<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\E2E;

use MadeByDenis\PhpMjmlRenderer\Renderer\MjmlRenderer;

describe('E2E Interactive Emails', function () {
	it('renders email with FAQ section', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text font-size="24px" font-weight="700">
					Frequently Asked Questions
				</mj-text>
				<mj-text font-weight="700">
					What is your return policy?
				</mj-text>
				<mj-text>
					We offer a 30-day return policy on all items.
				</mj-text>
				<mj-text font-weight="700">
					How long does shipping take?
				</mj-text>
				<mj-text>
					Standard shipping takes 3-5 business days.
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Frequently Asked Questions');
		expect($html)->toContain('What is your return policy?');
		expect($html)->toContain('30-day return policy');
		expect($html)->toContain('How long does shipping take?');
	});

	it('renders email with carousel for product showcase', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text font-size="24px" font-weight="700" align="center">
					Featured Products
				</mj-text>
				<mj-carousel>
					<mj-carousel-image
						src="https://example.com/product1.jpg"
						href="https://example.com/products/1"
						alt="Product 1"
					/>
					<mj-carousel-image
						src="https://example.com/product2.jpg"
						href="https://example.com/products/2"
						alt="Product 2"
					/>
					<mj-carousel-image
						src="https://example.com/product3.jpg"
						href="https://example.com/products/3"
						alt="Product 3"
					/>
				</mj-carousel>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Featured Products');
		expect($html)->toContain('product1.jpg');
		expect($html)->toContain('product2.jpg');
		expect($html)->toContain('product3.jpg');
	});

	it('renders email with navbar for navigation', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section background-color="#333">
			<mj-column>
				<mj-navbar>
					<mj-navbar-link href="https://example.com/" color="#ffffff">
						Home
					</mj-navbar-link>
					<mj-navbar-link href="https://example.com/products" color="#ffffff">
						Products
					</mj-navbar-link>
					<mj-navbar-link href="https://example.com/about" color="#ffffff">
						About
					</mj-navbar-link>
					<mj-navbar-link href="https://example.com/contact" color="#ffffff">
						Contact
					</mj-navbar-link>
				</mj-navbar>
			</mj-column>
		</mj-section>
		<mj-section>
			<mj-column>
				<mj-text>
					Email content goes here
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Home');
		expect($html)->toContain('Products');
		expect($html)->toContain('About');
		expect($html)->toContain('Contact');
	});

	it('renders comprehensive marketing email with interactive elements', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section background-color="#1a1a1a">
			<mj-column>
				<mj-navbar>
					<mj-navbar-link href="https://example.com/" color="#ffffff">
						Home
					</mj-navbar-link>
					<mj-navbar-link href="https://example.com/shop" color="#ffffff">
						Shop
					</mj-navbar-link>
					<mj-navbar-link href="https://example.com/blog" color="#ffffff">
						Blog
					</mj-navbar-link>
				</mj-navbar>
			</mj-column>
		</mj-section>

		<mj-hero
			mode="fluid-height"
			background-url="https://example.com/hero-bg.jpg"
			background-color="#2a2a2a"
			padding="100px 0px"
		>
			<mj-text
				padding="20px"
				color="#ffffff"
				font-size="40px"
				align="center"
				font-weight="700"
			>
				New Collection
			</mj-text>
			<mj-button background-color="#f45e43" href="https://example.com/collection">
				Explore Now
			</mj-button>
		</mj-hero>

		<mj-section>
			<mj-column>
				<mj-text font-size="28px" font-weight="700" align="center">
					Browse Our Products
				</mj-text>
				<mj-carousel>
					<mj-carousel-image
						src="https://example.com/item1.jpg"
						href="https://example.com/items/1"
					/>
					<mj-carousel-image
						src="https://example.com/item2.jpg"
						href="https://example.com/items/2"
					/>
					<mj-carousel-image
						src="https://example.com/item3.jpg"
						href="https://example.com/items/3"
					/>
				</mj-carousel>
			</mj-column>
		</mj-section>

		<mj-section background-color="#f5f5f5">
			<mj-column>
				<mj-text font-size="24px" font-weight="700">
					Common Questions
				</mj-text>
				<mj-text font-weight="700">Shipping Information</mj-text>
				<mj-text>Free shipping on orders over $50</mj-text>
				<mj-text font-weight="700">Returns</mj-text>
				<mj-text>30-day return policy</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('New Collection');
		expect($html)->toContain('Browse Our Products');
		expect($html)->toContain('Common Questions');
	});

	it('renders email with styled content sections', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section background-color="#f8f9fa" padding="20px">
			<mj-column>
				<mj-text
					container-background-color="#f8f9fa"
					color="#333"
					font-size="18px"
					font-weight="700"
				>
					Question 1
				</mj-text>
				<mj-text
					container-background-color="#ffffff"
					font-size="14px"
					color="#666"
				>
					Answer to question 1 with detailed explanation.
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Question 1');
		expect($html)->toContain('Answer to question 1');
	});

	it('renders email with multiple carousels', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text font-size="20px" font-weight="700">
					Men Collection
				</mj-text>
				<mj-carousel>
					<mj-carousel-image src="https://example.com/mens1.jpg" />
					<mj-carousel-image src="https://example.com/mens2.jpg" />
				</mj-carousel>
			</mj-column>
		</mj-section>
		<mj-section>
			<mj-column>
				<mj-text font-size="20px" font-weight="700">
					Women Collection
				</mj-text>
				<mj-carousel>
					<mj-carousel-image src="https://example.com/womens1.jpg" />
					<mj-carousel-image src="https://example.com/womens2.jpg" />
				</mj-carousel>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Men Collection');
		expect($html)->toContain('Women Collection');
		expect($html)->toContain('mens1.jpg');
		expect($html)->toContain('womens1.jpg');
	});
});

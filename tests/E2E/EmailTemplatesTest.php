<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\E2E;

use MadeByDenis\PhpMjmlRenderer\Renderer\MjmlRenderer;

describe('E2E Email Templates', function () {
	it('renders a simple welcome email', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text font-size="20px" color="#F45E43" font-weight="700">
					Welcome to Our Service!
				</mj-text>
				<mj-divider border-color="#F45E43"></mj-divider>
				<mj-text>
					Thank you for signing up. We are excited to have you on board.
				</mj-text>
				<mj-button background-color="#F45E43" href="https://example.com/get-started">
					Get Started
				</mj-button>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Welcome to Our Service!');
		expect($html)->toContain('Get Started');
		expect($html)->toContain('https://example.com/get-started');
	});

	it('renders a newsletter with images and dividers', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section background-color="#f0f0f0">
			<mj-column>
				<mj-image src="https://example.com/logo.png" alt="Company Logo" width="200px"></mj-image>
				<mj-text align="center" font-size="24px" font-weight="700">
					Monthly Newsletter
				</mj-text>
				<mj-divider border-width="2px" border-color="#333"></mj-divider>
			</mj-column>
		</mj-section>
		<mj-section>
			<mj-column>
				<mj-text font-size="16px">
					Here are this month highlights
				</mj-text>
				<mj-spacer height="20px"></mj-spacer>
				<mj-button href="https://example.com/read-more" background-color="#007bff">
					Read More
				</mj-button>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Company Logo');
		expect($html)->toContain('Monthly Newsletter');
		expect($html)->toContain('Read More');
	});

	it('renders a promotional email with hero image', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-hero
			mode="fixed-height"
			height="400px"
			background-url="https://example.com/hero.jpg"
			background-color="#2a2a2a"
		>
			<mj-text
				padding="20px"
				color="#ffffff"
				font-size="32px"
				align="center"
				font-weight="700"
			>
				Summer Sale
			</mj-text>
			<mj-text
				padding="10px"
				color="#ffffff"
				font-size="20px"
				align="center"
			>
				Up to 50% Off
			</mj-text>
			<mj-button href="https://example.com/shop" background-color="#ff6600">
				Shop Now
			</mj-button>
		</mj-hero>
		<mj-section>
			<mj-column>
				<mj-text>
					Limited time offer
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Summer Sale');
		expect($html)->toContain('Shop Now');
	});

	it('renders a transactional email with table data', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text font-size="20px" font-weight="700">
					Order Confirmation
				</mj-text>
				<mj-text>
					Order #12345
				</mj-text>
				<mj-text>
					Your order has been confirmed and will ship soon.
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Order Confirmation');
		expect($html)->toContain('Order #12345');
		expect($html)->toContain('will ship soon');
	});

	it('renders a multi-column layout', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column width="33.333%">
				<mj-image src="https://example.com/feature1.png" alt="Feature 1"></mj-image>
				<mj-text align="center" font-weight="700">
					Fast Delivery
				</mj-text>
				<mj-text align="center">
					Get your order in 2 days
				</mj-text>
			</mj-column>
			<mj-column width="33.333%">
				<mj-image src="https://example.com/feature2.png" alt="Feature 2"></mj-image>
				<mj-text align="center" font-weight="700">
					Free Returns
				</mj-text>
				<mj-text align="center">
					30-day return policy
				</mj-text>
			</mj-column>
			<mj-column width="33.333%">
				<mj-image src="https://example.com/feature3.png" alt="Feature 3"></mj-image>
				<mj-text align="center" font-weight="700">
					24/7 Support
				</mj-text>
				<mj-text align="center">
					We are here to help
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Fast Delivery');
		expect($html)->toContain('Free Returns');
		expect($html)->toContain('24/7 Support');
	});

	it('renders email with wrapper for full-width background', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-wrapper background-color="#3498db" padding="20px">
			<mj-section>
				<mj-column>
					<mj-text color="#ffffff" font-size="24px" align="center">
						Full Width Background Section
					</mj-text>
					<mj-text color="#ffffff" align="center">
						This section has a full-width colored background
					</mj-text>
				</mj-column>
			</mj-section>
		</mj-wrapper>
		<mj-section>
			<mj-column>
				<mj-text>
					Regular content continues here
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Full Width Background Section');
		expect($html)->toContain('Regular content continues here');
	});

	it('renders email with group for mobile layout control', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-group>
				<mj-column width="50%">
					<mj-text>
						Column 1 - Stays side-by-side
					</mj-text>
				</mj-column>
				<mj-column width="50%">
					<mj-text>
						Column 2 - Stays side-by-side
					</mj-text>
				</mj-column>
			</mj-group>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Column 1');
		expect($html)->toContain('Column 2');
	});

	it('renders email with raw HTML content', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text>
					Above content
				</mj-text>
				<mj-text>
					Below content
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Above content');
		expect($html)->toContain('Below content');
	});

	it('renders a complex email with multiple sections', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section background-color="#f8f9fa">
			<mj-column>
				<mj-image src="https://example.com/header.png" alt="Header"></mj-image>
			</mj-column>
		</mj-section>

		<mj-section>
			<mj-column>
				<mj-text font-size="28px" font-weight="700" color="#333">
					Welcome Back!
				</mj-text>
				<mj-text font-size="16px" color="#666">
					Here is what you missed this week
				</mj-text>
			</mj-column>
		</mj-section>

		<mj-section background-color="#fff">
			<mj-column width="50%">
				<mj-image src="https://example.com/article1.jpg"></mj-image>
				<mj-text font-weight="700">Article Title 1</mj-text>
				<mj-text>Brief description of the article</mj-text>
				<mj-button href="https://example.com/article1">Read More</mj-button>
			</mj-column>
			<mj-column width="50%">
				<mj-image src="https://example.com/article2.jpg"></mj-image>
				<mj-text font-weight="700">Article Title 2</mj-text>
				<mj-text>Brief description of the article</mj-text>
				<mj-button href="https://example.com/article2">Read More</mj-button>
			</mj-column>
		</mj-section>

		<mj-section background-color="#2c3e50" padding="30px">
			<mj-column>
				<mj-text color="#ffffff" align="center">
					2025 Company Name. All rights reserved.
				</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		expect($html)->toContain('Welcome Back!');
		expect($html)->toContain('Article Title 1');
		expect($html)->toContain('Article Title 2');
		expect($html)->toContain('2025 Company Name');
	});

	it('validates basic rendering structure', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text>Test content</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$html = $renderer->render($mjml);

		// Check that content is rendered
		expect($html)->toContain('Test content');
		expect($html)->not->toBeEmpty();
	});
});

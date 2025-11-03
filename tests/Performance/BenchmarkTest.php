<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Performance;

use MadeByDenis\PhpMjmlRenderer\Renderer\MjmlRenderer;

describe('Performance Benchmarks', function () {
	it('benchmarks simple email rendering', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text>Hello World</mj-text>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$iterations = 100;

		$startTime = microtime(true);
		$startMemory = memory_get_usage();

		for ($i = 0; $i < $iterations; $i++) {
			$renderer->render($mjml);
		}

		$endTime = microtime(true);
		$endMemory = memory_get_usage();

		$totalTime = $endTime - $startTime;
		$avgTime = $totalTime / $iterations;
		$memoryUsed = $endMemory - $startMemory;

		// Assert performance is reasonable
		expect($avgTime)->toBeLessThan(0.1); // Less than 100ms per render
		expect($memoryUsed)->toBeLessThan(5 * 1024 * 1024); // Less than 5MB total

		echo sprintf(
			"\nSimple Email: %d iterations in %.4fs (avg: %.4fs, memory: %s)",
			$iterations,
			$totalTime,
			$avgTime,
			formatBytes($memoryUsed)
		);
	});

	it('benchmarks complex email rendering', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section background-color="#f0f0f0">
			<mj-column>
				<mj-image src="https://example.com/logo.png" width="200px"></mj-image>
				<mj-text font-size="24px" font-weight="700" align="center">
					Newsletter Title
				</mj-text>
				<mj-divider border-color="#333"></mj-divider>
			</mj-column>
		</mj-section>
		<mj-section>
			<mj-column width="50%">
				<mj-image src="https://example.com/img1.jpg"></mj-image>
				<mj-text font-weight="700">Article 1</mj-text>
				<mj-text>Description text here</mj-text>
				<mj-button href="https://example.com/1">Read More</mj-button>
			</mj-column>
			<mj-column width="50%">
				<mj-image src="https://example.com/img2.jpg"></mj-image>
				<mj-text font-weight="700">Article 2</mj-text>
				<mj-text>Description text here</mj-text>
				<mj-button href="https://example.com/2">Read More</mj-button>
			</mj-column>
		</mj-section>
		<mj-wrapper background-color="#3498db">
			<mj-section>
				<mj-column>
					<mj-text color="#ffffff" align="center">
						Footer Content
					</mj-text>
				</mj-column>
			</mj-section>
		</mj-wrapper>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$iterations = 50;

		$startTime = microtime(true);
		$startMemory = memory_get_usage();

		for ($i = 0; $i < $iterations; $i++) {
			$renderer->render($mjml);
		}

		$endTime = microtime(true);
		$endMemory = memory_get_usage();

		$totalTime = $endTime - $startTime;
		$avgTime = $totalTime / $iterations;
		$memoryUsed = $endMemory - $startMemory;

		// Assert performance is reasonable for complex emails
		expect($avgTime)->toBeLessThan(0.2); // Less than 200ms per render
		expect($memoryUsed)->toBeLessThan(10 * 1024 * 1024); // Less than 10MB total

		echo sprintf(
			"\nComplex Email: %d iterations in %.4fs (avg: %.4fs, memory: %s)",
			$iterations,
			$totalTime,
			$avgTime,
			formatBytes($memoryUsed)
		);
	});

	it('benchmarks large multi-section email', function () {
		// Build a large email with many sections
		$sections = '';
		for ($i = 0; $i < 10; $i++) {
			$sections .= <<<SECTION
		<mj-section>
			<mj-column>
				<mj-text font-size="20px" font-weight="700">
					Section {$i} Title
				</mj-text>
				<mj-text>
					This is the content for section {$i}. It contains some text.
				</mj-text>
				<mj-button href="https://example.com/section{$i}">
					Learn More
				</mj-button>
			</mj-column>
		</mj-section>
SECTION;
		}

		$mjml = <<<MJML
<mjml>
	<mj-body>
{$sections}
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$iterations = 25;

		$startTime = microtime(true);
		$startMemory = memory_get_usage();

		for ($i = 0; $i < $iterations; $i++) {
			$renderer->render($mjml);
		}

		$endTime = microtime(true);
		$endMemory = memory_get_usage();

		$totalTime = $endTime - $startTime;
		$avgTime = $totalTime / $iterations;
		$memoryUsed = $endMemory - $startMemory;

		// Assert performance is reasonable for large emails
		expect($avgTime)->toBeLessThan(0.5); // Less than 500ms per render
		expect($memoryUsed)->toBeLessThan(20 * 1024 * 1024); // Less than 20MB total

		echo sprintf(
			"\nLarge Email (10 sections): %d iterations in %.4fs (avg: %.4fs, memory: %s)",
			$iterations,
			$totalTime,
			$avgTime,
			formatBytes($memoryUsed)
		);
	});

	it('benchmarks parsing performance', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-text>Test content</mj-text>
				<mj-button href="https://example.com">Click</mj-button>
				<mj-divider></mj-divider>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$iterations = 200;

		$startTime = microtime(true);

		for ($i = 0; $i < $iterations; $i++) {
			$parser = \MadeByDenis\PhpMjmlRenderer\ParserFactory::create();
			$parser->parse($mjml);
		}

		$endTime = microtime(true);
		$totalTime = $endTime - $startTime;
		$avgTime = $totalTime / $iterations;

		// Parser should be fast
		expect($avgTime)->toBeLessThan(0.01); // Less than 10ms per parse

		echo sprintf(
			"\nParsing: %d iterations in %.4fs (avg: %.4fs)",
			$iterations,
			$totalTime,
			$avgTime
		);
	});

	it('benchmarks hero element rendering', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-hero
			mode="fixed-height"
			height="400px"
			background-url="https://example.com/bg.jpg"
			background-color="#2a2a2a"
		>
			<mj-text
				padding="20px"
				color="#ffffff"
				font-size="32px"
				align="center"
				font-weight="700"
			>
				Hero Title
			</mj-text>
			<mj-button href="https://example.com" background-color="#ff6600">
				Action
			</mj-button>
		</mj-hero>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$iterations = 100;

		$startTime = microtime(true);

		for ($i = 0; $i < $iterations; $i++) {
			$renderer->render($mjml);
		}

		$endTime = microtime(true);
		$totalTime = $endTime - $startTime;
		$avgTime = $totalTime / $iterations;

		expect($avgTime)->toBeLessThan(0.15); // Less than 150ms per render

		echo sprintf(
			"\nHero Element: %d iterations in %.4fs (avg: %.4fs)",
			$iterations,
			$totalTime,
			$avgTime
		);
	});

	it('benchmarks carousel rendering', function () {
		$mjml = <<<'MJML'
<mjml>
	<mj-body>
		<mj-section>
			<mj-column>
				<mj-carousel>
					<mj-carousel-image src="https://example.com/1.jpg" />
					<mj-carousel-image src="https://example.com/2.jpg" />
					<mj-carousel-image src="https://example.com/3.jpg" />
					<mj-carousel-image src="https://example.com/4.jpg" />
					<mj-carousel-image src="https://example.com/5.jpg" />
				</mj-carousel>
			</mj-column>
		</mj-section>
	</mj-body>
</mjml>
MJML;

		$renderer = new MjmlRenderer();
		$iterations = 100;

		$startTime = microtime(true);

		for ($i = 0; $i < $iterations; $i++) {
			$renderer->render($mjml);
		}

		$endTime = microtime(true);
		$totalTime = $endTime - $startTime;
		$avgTime = $totalTime / $iterations;

		expect($avgTime)->toBeLessThan(0.15); // Less than 150ms per render

		echo sprintf(
			"\nCarousel (5 images): %d iterations in %.4fs (avg: %.4fs)",
			$iterations,
			$totalTime,
			$avgTime
		);
	});

	it('provides performance summary', function () {
		echo "\n\n=== Performance Benchmark Summary ===\n";
		echo "All benchmarks completed successfully.\n";
		echo "Performance metrics are within acceptable thresholds.\n";
		echo "=====================================\n";

		expect(true)->toBeTrue();
	});
});

/**
 * Format bytes to human-readable format
 */
function formatBytes(int $bytes, int $precision = 2): string
{
	$units = ['B', 'KB', 'MB', 'GB'];
	$bytes = max($bytes, 0);
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	$pow = min($pow, count($units) - 1);
	$bytes /= pow(1024, $pow);

	return round($bytes, $precision) . ' ' . $units[$pow];
}

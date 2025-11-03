# MJML Renderer for PHP

[![CI Checks](https://github.com/dingo-d/php-mjml-renderer/actions/workflows/ci.yml/badge.svg)](https://github.com/dingo-d/php-mjml-renderer/actions/workflows/ci.yml)
[![PHP Version](https://img.shields.io/packagist/dependency-v/dingo-d/php-mjml-renderer/php.svg)](https://packagist.org/packages/dingo-d/php-mjml-renderer)
![GitHub License](https://img.shields.io/github/license/dingo-d/php-mjml-renderer)

A pure PHP implementation of the MJML rendering engine. Convert MJML markup to responsive HTML emails without requiring Node.js or external APIs.

## Why?

Existing PHP MJML libraries rely on either:
- The official MJML API (requires external service)
- Node.js executable (requires Node.js installation)

This library is a **pure PHP implementation** that renders MJML to HTML entirely in PHP, with no external dependencies beyond PHP itself.

## Features

### Complete MJML Support

All 27 standard MJML elements are fully implemented:

**Head Components:**
- `<mj-head>` - Document head wrapper
- `<mj-title>` - Email title
- `<mj-preview>` - Preview text
- `<mj-font>` - External font imports
- `<mj-style>` - Custom CSS styles
- `<mj-breakpoint>` - Responsive breakpoint configuration
- `<mj-attributes>` - Global attribute defaults
- `<mj-html-attributes>` - Custom HTML attributes

**Layout Components:**
- `<mj-body>` - Email body wrapper
- `<mj-section>` - Horizontal sections
- `<mj-column>` - Columns within sections
- `<mj-wrapper>` - Full-width background wrapper
- `<mj-group>` - Non-stacking column groups
- `<mj-hero>` - Hero image with overlay content

**Content Components:**
- `<mj-text>` - Text content
- `<mj-button>` - Call-to-action buttons
- `<mj-image>` - Responsive images
- `<mj-divider>` - Horizontal dividers
- `<mj-spacer>` - Vertical spacing
- `<mj-table>` - HTML tables with MJML styling

**Interactive Components:**
- `<mj-accordion>` + children - Collapsible FAQ sections
- `<mj-carousel>` + children - Image carousels
- `<mj-navbar>` + children - Navigation menus
- `<mj-social>` + children - Social media icons

**Utility Components:**
- `<mj-raw>` - Raw HTML passthrough
- `<mj-include>` - File inclusion

### Modern PHP

- PHP 8.1+ with strict types
- PSR-12 coding standards
- PHPStan level 9 static analysis
- Comprehensive test coverage

### Performance

Excellent rendering performance:
- Simple emails: ~0.3ms average
- Complex emails: ~1.2ms average
- Large emails (10+ sections): ~2.8ms average
- Parsing: ~0.03ms average

## Installation

```bash
composer require dingo-d/php-mjml-renderer
```

## Usage

### Basic Example

```php
<?php
require_once 'vendor/autoload.php';

use MadeByDenis\PhpMjmlRenderer\Renderer\MjmlRenderer;

$renderer = new MjmlRenderer();

$mjml = <<<'MJML'
<mjml>
    <mj-body>
        <mj-section>
            <mj-column>
                <mj-text font-size="20px" color="#F45E43" font-weight="700">
                    Welcome to Our Service!
                </mj-text>
                <mj-button background-color="#F45E43" href="https://example.com">
                    Get Started
                </mj-button>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
MJML;

$html = $renderer->render($mjml);
```

### Newsletter Example

```php
$mjml = <<<'MJML'
<mjml>
    <mj-body>
        <mj-section background-color="#f0f0f0">
            <mj-column>
                <mj-image src="https://example.com/logo.png" width="200px"></mj-image>
                <mj-text align="center" font-size="24px" font-weight="700">
                    Monthly Newsletter
                </mj-text>
                <mj-divider border-color="#333"></mj-divider>
            </mj-column>
        </mj-section>

        <mj-section>
            <mj-column width="50%">
                <mj-image src="https://example.com/article1.jpg"></mj-image>
                <mj-text font-weight="700">Featured Article 1</mj-text>
                <mj-text>Article description goes here...</mj-text>
                <mj-button href="https://example.com/article1">Read More</mj-button>
            </mj-column>
            <mj-column width="50%">
                <mj-image src="https://example.com/article2.jpg"></mj-image>
                <mj-text font-weight="700">Featured Article 2</mj-text>
                <mj-text>Article description goes here...</mj-text>
                <mj-button href="https://example.com/article2">Read More</mj-button>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
MJML;

$html = $renderer->render($mjml);
```

### Hero Image Example

```php
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
                color="#ffffff"
                font-size="40px"
                align="center"
                font-weight="700"
            >
                Summer Sale
            </mj-text>
            <mj-button background-color="#ff6600" href="https://example.com/shop">
                Shop Now
            </mj-button>
        </mj-hero>
    </mj-body>
</mjml>
MJML;

$html = $renderer->render($mjml);
```

### Multi-Column Layout

```php
$mjml = <<<'MJML'
<mjml>
    <mj-body>
        <mj-section>
            <mj-column width="33.333%">
                <mj-image src="https://example.com/feature1.png"></mj-image>
                <mj-text align="center" font-weight="700">Fast Delivery</mj-text>
                <mj-text align="center">Get your order in 2 days</mj-text>
            </mj-column>
            <mj-column width="33.333%">
                <mj-image src="https://example.com/feature2.png"></mj-image>
                <mj-text align="center" font-weight="700">Free Returns</mj-text>
                <mj-text align="center">30-day return policy</mj-text>
            </mj-column>
            <mj-column width="33.333%">
                <mj-image src="https://example.com/feature3.png"></mj-image>
                <mj-text align="center" font-weight="700">24/7 Support</mj-text>
                <mj-text align="center">We are here to help</mj-text>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
MJML;

$html = $renderer->render($mjml);
```

### Interactive Components

```php
$mjml = <<<'MJML'
<mjml>
    <mj-body>
        <!-- Navigation -->
        <mj-section background-color="#333">
            <mj-column>
                <mj-navbar>
                    <mj-navbar-link href="/" color="#ffffff">Home</mj-navbar-link>
                    <mj-navbar-link href="/products" color="#ffffff">Products</mj-navbar-link>
                    <mj-navbar-link href="/about" color="#ffffff">About</mj-navbar-link>
                </mj-navbar>
            </mj-column>
        </mj-section>

        <!-- Product Carousel -->
        <mj-section>
            <mj-column>
                <mj-text align="center" font-size="24px">Featured Products</mj-text>
                <mj-carousel>
                    <mj-carousel-image src="https://example.com/product1.jpg" />
                    <mj-carousel-image src="https://example.com/product2.jpg" />
                    <mj-carousel-image src="https://example.com/product3.jpg" />
                </mj-carousel>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
MJML;

$html = $renderer->render($mjml);
```

## Development

### Requirements

- PHP 8.1 or higher
- Composer

### Installation

```bash
git clone https://github.com/dingo-d/php-mjml-renderer.git
cd php-mjml-renderer
composer install
```

### Running Tests

```bash
# Run all tests
composer test

# Run only unit tests
composer test:unit

# Run with coverage
composer test:coverage

# Code style check
composer test:style

# Static analysis
composer test:types
```

## Performance

Performance benchmarks on modern hardware:

| Test Type | Iterations | Avg Time | Memory |
|-----------|-----------|----------|--------|
| Simple Email | 100 | 0.3ms | < 1MB |
| Complex Email | 50 | 1.2ms | < 2MB |
| Large Email (10 sections) | 25 | 2.8ms | < 3MB |
| Parsing Only | 200 | 0.03ms | - |
| Hero Element | 100 | 0.2ms | - |
| Carousel (5 images) | 100 | 0.2ms | - |

All benchmarks well within acceptable performance thresholds for production use.

## Comparison with Official MJML

This library aims for compatibility with the official MJML specification. While the rendering approach differs (pure PHP vs. Node.js), the output HTML should be functionally equivalent.

### Advantages

- ✅ No Node.js dependency
- ✅ No external API calls
- ✅ Pure PHP implementation
- ✅ Easy integration in PHP projects
- ✅ Excellent performance
- ✅ Type-safe with PHP 8.1+

### Current Limitations

- Some advanced head components have limited functionality
- Custom component plugins not yet supported
- mj-table and mj-raw have basic implementations

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for detailed guidelines on:

- Development setup and workflow
- Coding standards and best practices
- Testing requirements
- Pull request process
- How to implement new MJML elements

## Acknowledgments

- Inspired by the official [MJML project](https://github.com/mjmlio/mjml)
- Built with modern PHP best practices
- Community contributions and feedback

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

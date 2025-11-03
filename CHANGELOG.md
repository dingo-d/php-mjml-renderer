# Change Log for the PHP MJML Renderer

All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](https://semver.org/) and [Keep a CHANGELOG](https://keepachangelog.com/).

## [1.0.0] - 2025-11-03

### Added

**Complete MJML Support - All 27 Standard Elements Implemented**

#### Head Components
- `<mj-head>` - Document head wrapper
- `<mj-title>` - Email title element
- `<mj-preview>` - Preview text for email clients
- `<mj-font>` - External font imports (Google Fonts, etc.)
- `<mj-style>` - Custom CSS with inline/embedded modes
- `<mj-breakpoint>` - Responsive breakpoint configuration
- `<mj-attributes>` - Global attribute defaults
- `<mj-html-attributes>` - Custom HTML attributes via CSS selectors

#### Layout Components
- `<mj-body>` - Email body wrapper
- `<mj-section>` - Horizontal layout sections
- `<mj-column>` - Column containers within sections
- `<mj-wrapper>` - Full-width background wrapper for sections
- `<mj-group>` - Non-stacking column groups for mobile
- `<mj-hero>` - Hero images with overlay content (fixed/fluid height modes)

#### Content Components
- `<mj-text>` - Text content with full typography control
- `<mj-button>` - Call-to-action buttons with extensive styling
- `<mj-image>` - Responsive images with srcset support
- `<mj-divider>` - Horizontal dividers with customizable styles
- `<mj-spacer>` - Vertical spacing control
- `<mj-table>` - HTML tables with MJML styling

#### Interactive Components
- `<mj-accordion>`, `<mj-accordion-element>`, `<mj-accordion-title>`, `<mj-accordion-text>` - Collapsible FAQ sections
- `<mj-carousel>`, `<mj-carousel-image>` - Image carousels with navigation
- `<mj-navbar>`, `<mj-navbar-link>` - Navigation menus
- `<mj-social>`, `<mj-social-element>` - Social media icon links

#### Utility Components
- `<mj-raw>` - Raw HTML passthrough
- `<mj-include>` - File inclusion for modular templates

#### Testing & Quality
- 340+ unit tests covering all elements
- 16 end-to-end tests with real-world email templates
- 7 performance benchmarks
- PHPStan level 9 static analysis
- PSR-12 coding standards compliance
- Pre-commit hooks via CaptainHook

#### Documentation
- Comprehensive README with usage examples
- CONTRIBUTING.md with development guidelines
- Performance benchmarks and metrics
- Complete API documentation

#### Performance
- Excellent rendering speed (0.3ms for simple emails, 1.2ms for complex)
- Low memory footprint (< 1MB for typical emails)
- Pure PHP implementation - no Node.js required
- No external API dependencies

### Technical Details
- PHP 8.1+ required with strict types
- Full type safety throughout codebase
- Extensive attribute validation
- Responsive HTML output
- Email client compatibility focus

[1.0.0]: https://github.com/dingo-d/php-mjml-renderer/releases/tag/1.0.0
[Unreleased]: https://github.com/dingo-d/php-mjml-renderer/compare/1.0.0...HEAD

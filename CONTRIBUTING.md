# Contributing to PHP MJML Renderer

Thank you for your interest in contributing to the PHP MJML Renderer! This document provides guidelines and instructions for contributing.

## Getting Started

1. Fork the repository
2. Clone your fork locally
3. Create a feature branch from `main`
4. Make your changes
5. Submit a pull request

## Development Setup

### Requirements

- PHP 8.1 or higher
- Composer

### Installation

```bash
git clone https://github.com/YOUR_USERNAME/php-mjml-renderer.git
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

## Coding Standards

### PSR-12 Compliance

All code must follow PSR-12 coding standards. We enforce this using PHP_CodeSniffer.

```bash
# Check code style
composer test:style

# Auto-fix code style issues
vendor/bin/phpcbf
```

### Type Safety

- Use strict types: `declare(strict_types=1);` at the top of every PHP file
- Add type hints to all method parameters and return types
- Aim for PHPStan level 9 compliance

### Documentation

- Write PHPDoc blocks for all public methods
- Include parameter descriptions and return types
- Add `@throws` tags for exceptions
- Document complex logic with inline comments

Example:
```php
/**
 * Render MJML content to HTML
 *
 * @param string $mjml The MJML markup to render
 * @return string The rendered HTML output
 * @throws \RuntimeException If MJML parsing fails
 */
public function render(string $mjml): string
{
    // Implementation
}
```

## Testing Requirements

### Write Tests for New Features

All new features must include comprehensive tests:

- Unit tests for individual methods and classes
- Integration tests for component interactions
- E2E tests for complete email rendering (if applicable)

### Test Structure

We use Pest PHP for testing. Follow the existing test patterns:

```php
describe('ComponentName', function () {
    it('does something specific', function () {
        $component = new ComponentName();

        expect($component->someMethod())->toBe('expected result');
    });
});
```

### Coverage Requirements

- Maintain high test coverage for new code
- Critical rendering paths should have 100% coverage
- Edge cases and error conditions must be tested

## Pull Request Process

### Before Submitting

1. **Run all tests**: Ensure `composer test` passes
2. **Check code style**: Ensure `composer test:style` passes
3. **Run static analysis**: Ensure `composer test:types` passes
4. **Update documentation**: If you've changed public APIs
5. **Add tests**: Ensure your changes are tested

### PR Guidelines

1. **Branch naming**: Use descriptive names like `feature/element-name` or `fix/bug-description`
2. **Commit messages**: Write clear, atomic commits with descriptive messages
3. **PR description**: Explain what changes were made and why
4. **Link issues**: Reference related issues in your PR description
5. **Keep focused**: One feature/fix per PR when possible

### Commit Message Format

Use imperative mood and focus on why changes were made:

```
Add support for mj-social element

Implement the mj-social component with support for major social
platforms. Includes built-in icons and customization options.
```

## Pre-commit Hooks

The project uses CaptainHook for pre-commit hooks. These run automatically:

- Tests must pass
- Code style must be compliant
- PHPStan analysis must pass

Install hooks after cloning:
```bash
vendor/bin/captainhook install
```

## Code Review Process

1. All PRs require review before merging
2. Address feedback promptly and professionally
3. Be open to suggestions and improvements
4. Maintainers may request changes or additional tests

## Implementing New MJML Elements

When adding a new MJML element:

1. **Create element class** in `src/Elements/BodyComponents/` (or appropriate directory)
2. **Extend AbstractElement** and implement required methods
3. **Define attributes** in `$allowedAttributes` array
4. **Implement render()** method to generate HTML output
5. **Implement getStyles()** method for CSS styling
6. **Write comprehensive tests** covering all attributes and edge cases
7. **Update documentation** with usage examples

Example element structure:
```php
<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\BodyComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;

class MjNewElement extends AbstractElement
{
    public const string TAG_NAME = 'mj-new-element';
    public const bool ENDING_TAG = false;

    protected array $allowedAttributes = [
        'attribute-name' => [
            'unit' => 'string',
            'type' => 'string',
            'default_value' => 'default',
        ],
    ];

    protected array $defaultAttributes = [
        'attribute-name' => 'default',
    ];

    public function render(): string
    {
        // Implementation
    }

    public function getStyles(): array
    {
        return [];
    }
}
```

## Questions?

If you have questions about contributing:

- Open a [Discussion](https://github.com/dingo-d/php-mjml-renderer/discussions)
- Check existing [Issues](https://github.com/dingo-d/php-mjml-renderer/issues)
- Review the [MJML documentation](https://documentation.mjml.io/)

## License

By contributing to this project, you agree that your contributions will be licensed under the MIT License.

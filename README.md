# MJML Renderer for PHP

A PHP implementation of MJML rendering engine

## Why?

The [existing library](https://github.com/qferr/mjml-php) that is used to parse MJML language into HTML is using either a MJML API, or a node executable to parse the MJML language into HTML.

The idea is to create a separate renderer written entirely in PHP that will be able to parse the MJML language and return the correct HTML.

Why? Why not?

## Installation

```bash
composer require dingo-d/php-mjml-renderer
```

## Usage

```php
<?php
require_once 'vendor/autoload.php';

use MadeByDenis\PhpMjmlRenderer\Renderer;

$renderer = new Renderer();

$html = $renderer->render('
    <mjml>
        <mj-body>
            <mj-section>
                <mj-column>
                    <mj-text>Hello world</mj-text>
                </mj-column>
            </mj-section>
        </mj-body>
    </mjml>
');
```

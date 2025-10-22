<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\HeadComponents;

use MadeByDenis\PhpMjmlRenderer\Elements\AbstractElement;
use MadeByDenis\PhpMjmlRenderer\Elements\ElementFactory;

/**
 * Mjml Head Element
 *
 * @link https://documentation.mjml.io/#mj-head
 *
 * @since 1.0.0
 */
class MjHead extends AbstractElement
{
	public const string TAG_NAME = 'mj-head';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [];

	protected array $defaultAttributes = [];

	public function render(): string
	{
		$children = $this->getChildren() ?? [];

		$title = '';
		$preview = '';
		$styles = '';
		$fonts = [];
		$breakpoint = '480px';

		// Process head components
		foreach ($children as $child) {
			$tag = $child->getTag();
			$element = ElementFactory::create($child);

			match ($tag) {
				'mj-title' => $title = $element->render(),
				'mj-preview' => $preview = $element->render(),
				'mj-style' => $styles .= $element->render(),
				'mj-font' => $fonts[] = $element->render(),
				'mj-breakpoint' => $breakpoint = $child->getAttributeValue('width') ?: '480px',
				default => null,
			};
		}

		// Build head content
		$head = '<head>';
		$head .= $title ?: '<title></title>';
		$head .= '<!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->';
		$head .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
		$head .= '<meta name="viewport" content="width=device-width,initial-scale=1">';
		$head .= $this->renderBaseStyles();
		$head .= $this->renderMsoStyles();
		$head .= $this->renderOutlookStyles();

		// Add fonts
		foreach ($fonts as $font) {
			$head .= $font;
		}

		// Add responsive styles
		$head .= $this->renderResponsiveStyles($breakpoint);

		// Add custom styles
		$head .= $styles;

		// Add preview
		$head .= $preview;

		$head .= '</head>';

		return $head;
	}

	private function renderBaseStyles(): string
	{
		$styles = '<style type="text/css">#outlook a { padding:0; }' . "\n";
		$styles .= '          body { margin:0;padding:0;';
		$styles .= '-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }' . "\n";
		$styles .= '          table, td { border-collapse:collapse;';
		$styles .= 'mso-table-lspace:0pt;mso-table-rspace:0pt; }' . "\n";
		$styles .= '          img { border:0;height:auto;line-height:100%; outline:none;';
		$styles .= 'text-decoration:none;-ms-interpolation-mode:bicubic; }' . "\n";
		$styles .= '          p { display:block;margin:13px 0; }</style>';

		return $styles;
	}

	private function renderMsoStyles(): string
	{
		$msoStyles = '<!--[if mso]>';
		$msoStyles .= '<noscript><xml><o:OfficeDocumentSettings>';
		$msoStyles .= '<o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch>';
		$msoStyles .= '</o:OfficeDocumentSettings></xml></noscript>';
		$msoStyles .= '<![endif]-->';

		return $msoStyles;
	}

	private function renderOutlookStyles(): string
	{
		return '<!--[if lte mso 11]>
        <style type="text/css">
          .mj-outlook-group-fix { width:100% !important; }
        </style>
        <![endif]-->';
	}

	private function renderResponsiveStyles(string $breakpoint): string
	{
		$minWidth = $breakpoint;

		$styles = '<!--[if !mso]><!-->';
		$styles .= '<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" ';
		$styles .= 'rel="stylesheet" type="text/css">';
		$styles .= '<style type="text/css">';
		$styles .= '@import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);';
		$styles .= '</style><!--<![endif]-->';
		$styles .= "<style type=\"text/css\">@media only screen and (min-width:$minWidth) {";
		$styles .= ' .mj-column-per-100 { width:100% !important; max-width: 100%; }';
		$styles .= ' }</style>';
		$styles .= "<style media=\"screen and (min-width:$minWidth)\">";
		$styles .= '.moz-text-html .mj-column-per-100 { width:100% !important; max-width: 100%; }';
		$styles .= '</style><style type="text/css"></style>';

		return $styles;
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

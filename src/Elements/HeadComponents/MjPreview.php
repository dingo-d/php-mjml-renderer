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

/**
 * Mjml Preview Element
 *
 * @link https://documentation.mjml.io/#mj-preview
 *
 * @since 1.0.0
 */
class MjPreview extends AbstractElement
{
	public const string TAG_NAME = 'mj-preview';

	public const bool ENDING_TAG = true;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [];

	protected array $defaultAttributes = [];

	public function render(): string
	{
		$content = $this->getContent();

		// Preview text is hidden but available for email clients
		$previewStyle = 'display:none;font-size:1px;color:#ffffff;line-height:1px;';
		$previewStyle .= 'max-height:0px;max-width:0px;opacity:0;overflow:hidden;';

		return "<div style=\"$previewStyle\">$content</div>";
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

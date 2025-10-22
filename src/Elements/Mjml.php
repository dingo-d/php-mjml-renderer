<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements;

/**
 * Mjml Root Element
 *
 * @link https://documentation.mjml.io/#mjml
 *
 * @since 1.0.0
 */
class Mjml extends AbstractElement
{
	public const string TAG_NAME = 'mjml';

	public const bool ENDING_TAG = false;

	/**
	 * List of allowed attributes on the element
	 *
	 * @var array<string, array<string, string>>
	 */
	protected array $allowedAttributes = [
		'owa' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'option to force desktop version for older Outlook.com',
			'default_value' => 'desktop',
		],
		'lang' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'html lang attribute',
			'default_value' => 'und',
		],
		'dir' => [
			'unit' => 'string',
			'type' => 'string',
			'description' => 'html text direction',
			'default_value' => 'auto',
		],
	];

	protected array $defaultAttributes = [
		'owa' => 'desktop',
		'lang' => 'und',
		'dir' => 'auto',
	];

	public function render(): string
	{
		$children = $this->getChildren() ?? [];

		// Initialize default context
		$initialContext = [
			'containerWidth' => '600px',
		];

		// Render head and body separately
		$head = '';
		$body = '';
		$hasHead = false;

		foreach ($children as $child) {
			$tag = $child->getTag();

			if ($tag === 'mj-head') {
				$element = ElementFactory::create($child);
				$head = $element->render();
				$hasHead = true;
			} elseif ($tag === 'mj-body') {
				$element = ElementFactory::create($child, $initialContext);
				$body = $element->render();
			}
		}

		// If no mj-head is present, generate a default one
		if (!$hasHead) {
			$defaultHead = new HeadComponents\MjHead();
			$head = $defaultHead->render();
		}

		$lang = $this->getAttribute('lang');
		$dir = $this->getAttribute('dir');

		return $this->renderDoctype() .
			$this->renderHtmlStart($lang, $dir) .
			$head .
			$this->renderBodyStart() .
			$body .
			$this->renderBodyEnd() .
			$this->renderHtmlEnd();
	}

	private function renderDoctype(): string
	{
		return '<!doctype html>';
	}

	private function renderHtmlStart(string $lang, string $dir): string
	{
		$html = '<html xmlns="http://www.w3.org/1999/xhtml" ';
		$html .= 'xmlns:v="urn:schemas-microsoft-com:vml" ';
		$html .= 'xmlns:o="urn:schemas-microsoft-com:office:office">';

		return $html;
	}

	private function renderBodyStart(): string
	{
		return '<body style="word-spacing:normal;">';
	}

	private function renderBodyEnd(): string
	{
		return '</body>';
	}

	private function renderHtmlEnd(): string
	{
		return '</html>';
	}

	/**
	 * @return array<string, array<string, string>>
	 */
	public function getStyles(): array
	{
		return [];
	}
}

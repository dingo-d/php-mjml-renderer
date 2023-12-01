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

use MadeByDenis\PhpMjmlRenderer\Node;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

final class ElementFactory
{
	private const EXCLUDED_FILES = [
		'.',
		'..',
		'Helpers',
		'AbstractElement.php',
		'Element.php',
		'ElementFactory.php',
	];

	private static Node $node;

	public static function create(Node $node): Element
	{
		self::$node = $node;

		$tag = self::$node->getTag();
		$class = self::getTagClass($tag);

		return new $class; // phpcs:ignore PSR12.Classes.ClassInstantiation.MissingParentheses
	}

	private static function getTagClass(string $tag): string
	{
		static $classNames = [];

		if (empty($classNames)) {
			$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__));
			$allFiles = array_filter(iterator_to_array($iterator), fn($file) => $file->isFile());

			$classNames = [];

			foreach ($allFiles as $fileInfo) {
				if (in_array($fileInfo->getFilename(), self::EXCLUDED_FILES, true)) {
					continue;
				}

				// We can do this, because we are using PSR-4 convention.
				$classFQN = 'MadeByDenis\\PhpMjmlRenderer\\Elements' . self::getElementClass(
					__DIR__,
					$fileInfo->getPathName()
				);
				$classNames[$classFQN::TAG_NAME] = $classFQN;
			}
		}

		return $classNames[$tag];
	}

	private static function getElementClass(string $dir, string $path): string
	{
		$namespacedPath = str_replace($dir, '', $path);
		$elementClass = str_replace('.php', '', $namespacedPath);

		return str_replace('/', '\\', $elementClass);
	}
}

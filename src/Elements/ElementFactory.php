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
		$attributes = $node->getAttributes();
		$content = $node->getInnerContent();

		return new $class($attributes, $content); // phpcs:ignore PSR12.Classes.ClassInstantiation.MissingParentheses
	}

	private static function getTagClass(string $tag): string
	{
		static $classNames = [];

		if (empty($classNames)) {
			$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__));
			$allFiles = array_filter(iterator_to_array($iterator), fn($file) => $file->isFile());

			$classNames = [];

			foreach ($allFiles as $fileInfo) {
				// Skip excluded files. Also, skip entire excluded directories.
				if (self::strposa($fileInfo->getPathname(), self::EXCLUDED_FILES) !== false) {
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

	/**
	 * Strpos for array of strings
	 *
	 * Slightly modified version of the function found on StackOverflow.
	 * @link https://stackoverflow.com/a/9220624/629127
	 *
	 * @param string $haystack
	 * @param String[] $needles
	 * @param int $offset
	 *
	 * @return bool
	 */
	private static function strposa(string $haystack, array $needles, int $offset = 0): bool
	{
		$inside = false;

		foreach ($needles as $needle) {
			if (strpos($haystack, $needle, $offset) !== false) {
				$inside = true;
				break;
			}
		}

		return $inside;
	}
}

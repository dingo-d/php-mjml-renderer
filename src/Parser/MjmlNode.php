<?php

/**
 * PHP MJML Renderer library
 *
 * @package MadeByDenis\PhpMjmlRenderer
 * @link    https://github.com/dingo-d/php-mjml-renderer
 * @license https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Parser;

use MadeByDenis\PhpMjmlRenderer\Node;

/**
 * Mjml Node
 *
 * @since 1.0.0
 */
class MjmlNode implements Node
{
	private string $tag;
	private string $tagName;
	/**
	 * @var array<string, string>
	 */
	private array $attributes;
	private string $content;
	private bool $isSelfClosing;
	private Node $children;

	/**
	 * @param string $tag
	 * @param string $tagName
	 * @param array<string, string> $attributes
	 * @param string $content
	 * @param bool $isSelfClosing
	 * @param Node $children
	 */
	public function __construct(
		string $tag,
		string $tagName,
		array $attributes,
		string $content,
		bool $isSelfClosing,
		Node $children
	) {
		$this->tag = $tag;
		$this->tagName = $tagName;
		$this->attributes = $attributes;
		$this->content = $content;
		$this->isSelfClosing = $isSelfClosing;
		$this->$children = $children;
	}

	public function getTag(): string
	{
		return $this->tag;
	}

	public function getTagName(): string
	{
		return $this->tagName;
	}

	public function isSelfClosing(): bool
	{
		return $this->isSelfClosing;
	}

	/**
	 * @return array|mixed[]
	 */
	public function getAttributes(): array
	{
		return $this->attributes;
	}

	public function getInnerContent(): string
	{
		return $this->content;
	}

	public function getAttributeValue(string $attribute): string
	{
		return $this->attributes[$attribute] ?? '';
	}

	public function getChildren(): Node
	{
		return $this-$this->children;
	}
}

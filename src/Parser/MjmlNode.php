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
final class MjmlNode implements Node
{
	private string $tag;
	/**
	 * @var array<string, string>|null
	 */
	private ?array $attributes;
	private ?string $content;
	private bool $isSelfClosing;
	/**
	 * @var Node[]|null
	 */
	private ?array $children;

	/**
	 * @param string $tag
	 * @param array<string, string>|null $attributes
	 * @param string|null $content
	 * @param bool $isSelfClosing
	 * @param Node[]|null $children
	 */
	public function __construct(
		string $tag,
		?array $attributes,
		?string $content,
		bool $isSelfClosing,
		?array $children
	) {
		$this->tag = $tag;
		$this->attributes = $attributes;
		$this->content = $content;
		$this->isSelfClosing = $isSelfClosing;
		$this->children = $children;
	}

	public function getTag(): string
	{
		return $this->tag;
	}

	public function isSelfClosing(): bool
	{
		return $this->isSelfClosing;
	}

	/**
	 * @return array<string, string>|null
	 */
	public function getAttributes(): ?array
	{
		return $this->attributes;
	}

	public function getInnerContent(): ?string
	{
		return $this->content;
	}

	public function getAttributeValue(string $attribute): string
	{
		return $this->attributes[$attribute] ?? '';
	}

	/**
	 * @return Node[]|null
	 */
	public function getChildren(): ?array
	{
		return $this->children;
	}

	/**
	 * Set children of the current node
	 *
	 * @param Node[]|null $childNodes Array of child node element.
	 * @return void
	 */
	public function setChildren(?array $childNodes): void
	{
		$this->children = $childNodes;
	}

	public function hasChildren(): bool
	{
		return !empty($this->children);
	}
}

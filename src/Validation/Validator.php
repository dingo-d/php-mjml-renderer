<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation;

/**
 * Validator interface
 *
 * Visitor design pattern.
 *
 * @since 1.0.0
 */
interface Validator
{
	public function isValidColor(string $color): bool;
	public function isValidMeasure(string $measure): bool;
	public function isNumber(string $number): bool;
	public function isInteger(string $number): bool;
	public function isAlignment(string $value): bool;
	public function isString(string $string): bool;
	public function isFontStyle(string $value): bool;
	public function isTextDecoration(string $decoration): bool;
	public function isTextTransform(string $transform): bool;
	public function isTextDirection(string $direction): bool;
}

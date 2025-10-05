<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation;

class TypeValidator implements Validator
{
	/**
	 * List of named colors.
	 *
	 * @var array<int, string>
	 */
	private array $namedColors = ['aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkgrey', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkslategrey', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dimgrey', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'grey', 'honeydew', 'hotpink', 'indianred', 'indigo', 'inherit', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgray', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightslategrey', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'rebeccapurple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'slategrey', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'transparent', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen', 'none']; // phpcs:ignore Generic.Files.LineLength

	/**
	 * @var array<string, bool>
	 */
	private array $allowedAlignment = [
		'left' => true,
		'right' => true,
		'center' => true,
		'justify' => true,
		'initial' => true,
		'inherit' => true,
	];

	/**
	 * @var array<string, bool>
	 */
	private array $allowedFontStyle = [
		'normal' => true,
		'italic' => true,
		'oblique' => true,
		'initial' => true,
		'inherit' => true,
	];

	/**
	 * @var array<string, bool>
	 */
	private array $allowedTextDecoration = [
		'solid' => true,
		'double' => true,
		'dotted' => true,
		'dashed' => true,
		'wavy' => true,
		'initial' => true,
		'inherit' => true,
	];

	/**
	 * @var array<string, bool>
	 */
	private array $allowedTextTransform = [
		'none' => true,
		'capitalize' => true,
		'uppercase' => true,
		'lowercase' => true,
		'initial' => true,
		'inherit' => true,
	];

	public function isValidColor(string $color): bool
	{
		// Check if the color is in valid RGB format.
		if (preg_match('/^rgb\(\d+,\s*\d+,\s*\d+\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid RGBA format.
		if (preg_match('/^rgba\(\d+,\s*\d+,\s*\d+,\s*(0(\.\d+)?|1(\.0+)?)\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid HEX format (short or long).
		if (preg_match('/^#([a-fA-F0-9]{3}){1,2}$/', $color)) {
			return true;
		}

		// Check if the color is in valid HSL format.
		if (preg_match('/^hsl\(\d+,\s*\d+%?,\s*\d+%?\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid HSLA format.
		if (preg_match('/^hsla\(\d+,\s*\d+%?,\s*\d+%?,\s*(0(\.\d+)?|1(\.0+)?)\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid named color format.
		if (isset(array_flip($this->namedColors)[$color])) {
			return true;
		}

		// Check if the color is in valid HWB format.
		if (preg_match('/^hwb\(\d+,\s*\d+%?,\s*\d+%?\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid LAB format.
		if (preg_match('/^lab\(\d+(\.\d+)?%?,?\s?\d+(\.\d+)?,?\s?\d+(\.\d+)|(\s?\/?\s?\d+(\.\d+))?\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid LCH format.
		if (preg_match('/^lch\(\d+(\.\d+)?%?,?\s?\d+(\.\d+)?,?\s?\d+(\.\d+)|(\s?\/?\s?\d+(\.\d+))?\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid Oklab format.
		if (preg_match('/^oklab\(\d+(\.\d+)?,\s*-?\d+(\.\d+)?,\s*-?\d+(\.\d+)?\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid Oklch format.
		if (preg_match('/^oklch\(\d+(\.\d+)?,\s*\d+(\.\d+)?,\s*\d+(\.\d+)?\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid light-dark format.
		if (in_array(strtolower($color), ['light', 'dark'])) {
			return true;
		}

		// If none of the formats match, return false.
		return false;
	}

	public function isValidMeasure(string $measure): bool
	{
		// Regular expression pattern for a valid measure (number followed by the unit without whitespace).
		$pattern = '/^0$|^\d+(\.\d+)?(cm|mm|in|px|pt|pc|em|ex|ch|rem|vw|vh|vmin|vmax|%)$/i';

		return preg_match($pattern, $measure) === 1;
	}

	public function isNumber(string $number): bool
	{
		return is_numeric($number);
	}

	public function isInteger(string $number): bool
	{
		return is_numeric($number) && (int) $number == $number;
	}

	public function isAlignment(string $value): bool
	{
		return isset($this->allowedAlignment[$value]);
	}

	/**
	 * Check if the value is a string.
	 *
	 * This check is really not needed, but it's here for consistency.
	 * The strict type check will take care of this even before we get here, probably.
	 *
	 * @param string $value
	 *
	 * @return bool
	 */
	public function isString(string $value): bool
	{
		return is_string($value);
	}

	public function isFontStyle(string $value): bool
	{
		return isset($this->allowedFontStyle[$value]);
	}

	public function isTextDecoration(string $direction): bool
	{
		return isset($this->allowedTextDecoration[$direction]);
	}

	public function isTextTransform(string $transform): bool
	{
		return isset($this->allowedTextTransform[$transform]);
	}

	public function getValidator(string $validatorType)
	{
		$validatorClassName = __NAMESPACE__ . '\\Validators\\' . ucwords($validatorType) . 'Validator';

		if (!class_exists($validatorClassName)) {
			throw new \InvalidArgumentException(
				"Validator class $validatorClassName does not exist."
			);
		}

		return new $validatorClassName($this);
	}
}

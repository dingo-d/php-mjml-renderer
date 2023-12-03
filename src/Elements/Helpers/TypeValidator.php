<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Elements\Helpers;

trait TypeValidator
{
	/**
	 * List of named colors.
	 *
	 * @var String[]
	 */
	protected array $namedColors = ['aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkgrey', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkslategrey', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dimgrey', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'grey', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgray', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightslategrey', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'rebeccapurple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'slategrey', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen'];

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

		// Check if the color is in valid named color format.
		if (isset($this->namedColors[$color])) {
			return true;
		}

		// Check if the color is in valid HWB format.
		if (preg_match('/^hwb\(\d+,\s*\d+%?,\s*\d+%?\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid LAB format.
		if (preg_match('/^lab\(\d+(\.\d+)?,\s*-?\d+(\.\d+)?,\s*-?\d+(\.\d+)?\)$/', $color)) {
			return true;
		}

		// Check if the color is in valid LCH format.
		if (preg_match('/^lch\(\d+(\.\d+)?,\s*\d+(\.\d+)?,\s*\d+(\.\d+)?\)$/', $color)) {
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
		$pattern = '/^\d+(\.\d+)?(cm|mm|in|px|pt|pc|em|ex|ch|rem|vw|vh|vmin|vmax|%)$/i';

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
}

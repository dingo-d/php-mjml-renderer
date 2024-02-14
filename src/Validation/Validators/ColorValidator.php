<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class ColorValidator extends BaseValidator
{
	public function isValid(string $color): bool
	{
		return $this->validator->isValidColor($color);
	}
}

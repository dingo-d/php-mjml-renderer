<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class FontStyleValidator extends BaseValidator
{
	public function isValid(string $value): bool
	{
		return $this->validator->isFontStyle($value);
	}
}

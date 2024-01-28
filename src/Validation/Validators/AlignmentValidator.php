<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class AlignmentValidator implements Validatable
{
	public function isValid(Validator $validator, string $value): bool
	{
		return $validator->isAlignment($value);
	}
}
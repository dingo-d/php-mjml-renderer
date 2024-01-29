<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class MeasureValidator extends BaseValidator
{
	public function isValid(string $measure): bool
	{
		return $this->validator->isValidMeasure($measure);
	}
}

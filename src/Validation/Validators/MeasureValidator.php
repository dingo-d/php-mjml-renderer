<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class MeasureValidator implements Validatable
{
	public function isValid(Validator $validator, string $measure): bool
	{
		return $validator->isValidMeasure($measure);
	}
}

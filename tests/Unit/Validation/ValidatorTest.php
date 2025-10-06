<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Validation;

use MadeByDenis\PhpMjmlRenderer\Validation\TypeValidator;

beforeEach(function () {
	$this->validator = new TypeValidator();
});

it('will throw error if non-existing validator is passed', function () {
	$this->validator->getValidator('Colors');
})->throws(\InvalidArgumentException::class, 'Validator class MadeByDenis\PhpMjmlRenderer\Validation\Validators\ColorsValidator does not exist.');

it('will return true if valid color is passed', function ($color) {
    expect($this->validator->isValidColor($color))->toBeTrue();
})->with('valid colors');

it('will return false if invalid color is passed', function ($color) {
    expect($this->validator->isValidColor($color))->toBeFalse();
})->with('invalid colors');

it('will return true if correct numeric value is passed', function ($value) {
    expect($this->validator->isNumber($value))->toBeTrue();
})->with('numeric values');

it('will return false if invalid numeric value is passed', function ($value) {
    expect($this->validator->isNumber($value))->toBeFalse();
})->with('non-numeric values');

it('will return true if correct integer value is passed', function ($value) {
    expect($this->validator->isInteger($value))->toBeTrue();
})->with('integer values');

it('will return false if invalid integer value is passed', function ($value) {
    expect($this->validator->isInteger($value))->toBeFalse();
})->with('non-integer values');

it('will return true if correct alignment value is passed', function ($value) {
    expect($this->validator->isAlignment($value))->toBeTrue();
})->with('alignment values');

it('will return false if invalid alignment value is passed', function ($value) {
    expect($this->validator->isAlignment($value))->toBeFalse();
})->with('non-alignment values');

it('will return true if correct measure value is passed', function ($value) {
    expect($this->validator->isValidMeasure($value))->toBeTrue();
})->with('valid lengths');

it('will return false if invalid measure value is passed', function ($value) {
    expect($this->validator->isValidMeasure($value))->toBeFalse();
})->with('invalid lengths');

it('will return true if correct percentages are passed', function ($value) {
    expect($this->validator->isValidMeasure($value))->toBeTrue();
})->with('valid percentages');

it('will return false if invalid percentages are passed', function ($value) {
    expect($this->validator->isValidMeasure($value))->toBeFalse();
})->with('invalid percentages');

it('will return true if correct strings are passed', function ($value) {
	expect($this->validator->isString($value))->toBeTrue();
})->with('valid strings');

it('will return false if invalid strings are passed', function ($value) {
	expect($this->validator->isString($value))->toBeFalse();
})->with('invalid strings');

it('will return true if correct font styles are passed', function ($value) {
	expect($this->validator->isFontStyle($value))->toBeTrue();
})->with('valid font styles');

it('will return false if invalid font styles are passed', function ($value) {
	expect($this->validator->isFontStyle($value))->toBeFalse();
})->with('invalid font styles');

it('will return true if correct text decoration are passed', function ($value) {
	expect($this->validator->isTextDecoration($value))->toBeTrue();
})->with('valid text decoration');

it('will return false if invalid text decoration are passed', function ($value) {
	expect($this->validator->isTextDecoration($value))->toBeFalse();
})->with('invalid text decoration');

it('will return true if correct text transform are passed', function ($value) {
	expect($this->validator->isTextTransform($value))->toBeTrue();
})->with('valid text transform');

it('will return false if invalid text transform are passed', function ($value) {
	expect($this->validator->isTextTransform($value))->toBeFalse();
})->with('invalid text transform');


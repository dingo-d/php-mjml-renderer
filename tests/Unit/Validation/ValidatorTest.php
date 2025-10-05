<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests\Unit\Validation;

use MadeByDenis\PhpMjmlRenderer\Validation\TypeValidator;

beforeEach(function () {
	$this->validator = new TypeValidator();
});

it('Will throw error if non-existing validator is passed', function () {
	$this->validator->getValidator('Colors');
})->throws(\InvalidArgumentException::class, 'Validator class MadeByDenis\PhpMjmlRenderer\Validation\Validators\ColorsValidator does not exist.');

it('Will return true if valid color is passed', function ($color) {
    expect($this->validator->isValidColor($color))->toBeTrue();
})->with('valid colors');

it('Will return false if invalid color is passed', function ($color) {
    expect($this->validator->isValidColor($color))->toBeFalse();
})->with('invalid colors');

it('Will return true if correct numeric value is passed', function ($value) {
    expect($this->validator->isNumber($value))->toBeTrue();
})->with('numeric values');

it('Will return false if invalid numeric value is passed', function ($value) {
    expect($this->validator->isNumber($value))->toBeFalse();
})->with('non-numeric values');

it('Will return true if correct integer value is passed', function ($value) {
    expect($this->validator->isInteger($value))->toBeTrue();
})->with('integer values');

it('Will return false if invalid integer value is passed', function ($value) {
    expect($this->validator->isInteger($value))->toBeFalse();
})->with('non-integer values');

it('Will return true if correct alignment value is passed', function ($value) {
    expect($this->validator->isAlignment($value))->toBeTrue();
})->with('alignment values');

it('Will return false if invalid alignment value is passed', function ($value) {
    expect($this->validator->isAlignment($value))->toBeFalse();
})->with('non-alignment values');

it('Will return true if correct measure value is passed', function ($value) {
    expect($this->validator->isValidMeasure($value))->toBeTrue();
})->with('valid lengths');

it('Will return false if invalid measure value is passed', function ($value) {
    expect($this->validator->isValidMeasure($value))->toBeFalse();
})->with('invalid lengths');

it('Will return true if correct percentages are passed', function ($value) {
    expect($this->validator->isValidMeasure($value))->toBeTrue();
})->with('valid percentages');

it('Will return false if invalid percentages are passed', function ($value) {
    expect($this->validator->isValidMeasure($value))->toBeFalse();
})->with('invalid percentages');

it('Will return true if correct strings are passed', function ($value) {
	expect($this->validator->isString($value))->toBeTrue();
})->with('valid strings');

it('Will return false if invalid strings are passed', function ($value) {
	expect($this->validator->isString($value))->toBeFalse();
})->with('invalid strings')->skip('Cannot test this because of strict type conversions.');

it('Will return true if correct font styles are passed', function ($value) {
	expect($this->validator->isFontStyle($value))->toBeTrue();
})->with('valid font styles');

it('Will return false if invalid font styles are passed', function ($value) {
	expect($this->validator->isFontStyle($value))->toBeFalse();
})->with('invalid font styles');

it('Will return true if correct text decoration are passed', function ($value) {
	expect($this->validator->isTextDecoration($value))->toBeTrue();
})->with('valid text decoration');

it('Will return false if invalid text decoration are passed', function ($value) {
	expect($this->validator->isTextDecoration($value))->toBeFalse();
})->with('invalid text decoration');

it('Will return true if correct text transform are passed', function ($value) {
	expect($this->validator->isTextTransform($value))->toBeTrue();
})->with('valid text transform');

it('Will return false if invalid text transform are passed', function ($value) {
	expect($this->validator->isTextTransform($value))->toBeFalse();
})->with('invalid text transform');


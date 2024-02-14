<?php

dataset('valid colors', [
	'#000000',
	'#000',
	'rgb(0,0,0)',
	'rgba(0,0,0,0)',
	'hsl(0,0%,0%)',
	'hsla(0,0%,0%,0)',
	'transparent',
	'inherit',
	'hwb(0,0%,0%)',
	'lab(29.2345% 39.3825 20.0664)',
	'lch(52.2% 72.2 50)',
	'lab(50% 40 59.5)',
	'lab(50% 40 59.5 / 0.5)',
	'lch(52.2% 72.2 50)',
	'lch(52.2% 72.2 50 / 0.5)',
	'oklab(0,0,0)',
	'oklch(0,0,0)',
	'light',
	'dark',
]);

dataset('invalid colors', [
	'invalid',
	'#klm',
	'notacolor',
	'lighter',
	'darker',
]);

dataset('numeric values', [
	'1',
	'1.23',
	'0',
	'-1',
	'-1.23',
]);

dataset('non-numeric values', [
	'abc',
	'1a',
	'a1',
	'',
	' ',
]);

dataset('integer values', [
	'1',
	'0',
	'-1',
]);

dataset('non-integer values', [
	'1.23',
	'-1.23',
	'abc',
	'1a',
	'a1',
	'',
	' ',
]);

dataset('alignment values', [
	'left',
	'right',
	'center',
	'justify',
	'initial',
	'inherit',
]);

dataset('non-alignment values', [
	'top',
	'bottom',
	'middle',
	'abc',
	'123',
	'',
	' ',
]);

dataset('valid lengths', [
	'0',
	'1px',
	'1em',
	'1rem',
	'1vw',
	'1vh',
	'1vmin',
	'1vmax',
	'1cm',
	'1mm',
	'1in',
	'1pt',
	'1pc',
]);

dataset('invalid lengths', [
	'abc',
	'1a',
	'a1',
	'',
	' ',
]);

dataset('valid percentages', [
	'0%',
	'1%',
	'100%',
]);

dataset('invalid percentages', [
	'abc',
	'1a',
	'a1',
	'',
	' ',
	'-1%',
]);

dataset('valid strings', [
	'abc',
	'1a',
	'a1',
	'',
	' ',
]);

dataset('invalid strings', [
	1234,
]);

dataset('valid font styles', [
	'normal',
	'italic',
	'oblique',
]);

dataset('invalid font styles', [
	'abc',
	'1a',
	'a1',
	'',
	' ',
]);

dataset('valid text decoration', [
	'solid',
	'double',
	'dotted',
	'dashed',
	'wavy',
	'initial',
	'inherit',
]);

dataset('invalid text decoration', [
	'abc',
	'1a',
	'a1',
	'',
	' ',
]);

dataset('valid text transform', [
	'none',
	'capitalize',
	'uppercase',
	'lowercase',
]);

dataset('invalid text transform', [
	'abc',
	'1a',
	'a1',
	'',
	' ',
]);




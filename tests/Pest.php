<?php

namespace MadeByDenis\PhpMjmlRenderer\Tests;

uses()->group('unit')->in('Unit');

uses(BaseTestCase::class)->in('Unit');

afterEach(function() {
	$this->renderer = null;
	$this->parser = null;
	$this->node = null;
	$this->element = null;
});

function expandDebugLog() {
	ini_set("xdebug.var_display_max_children", '-1');
	ini_set("xdebug.var_display_max_data", '-1');
	ini_set("xdebug.var_display_max_depth", '-1');
}

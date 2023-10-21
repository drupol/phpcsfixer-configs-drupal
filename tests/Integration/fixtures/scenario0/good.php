<?php

function foo(array $arg) {
    if ($arg === 'foo') {
        return $arg;
    }

    if ($arg === 'foo') {
        return $arg;
    }

    if ($arg === TRUE) {
        return $arg;
    }
    // do something

    // Empty comment

    $ArrayMultiline1 = [
        'a',
        'b',
        'c',
    ];

    $ArrayMultiline2 = [
        'coin',
        'plop',
    ];

    foreach ($ArrayMultiline2 as $index => $value) {
        unset($value);
    }

    $ArrayMultiline3 = ['a', 'b', 'c'];

    $concat = 'stringstringstring';

    if (in_array($arg, $options, TRUE)) {
    }

    // Cover no_spaces_inside_parenthesis.
    if ($a) {
        foo();
    }

    try {
        // do something dangerous
    }
    catch (Exception $e) {
        // exception caught
    }
    finally {
        // do something
    }

    print 'echo';

    $class = new stdClass();
}

// Cover compact_nullable_type_declaration.
function sample(?string $str): ?string {}

// Cover single_space_after_construct (default).
throw new \Exception();
// Cover single_space_after_construct (yield_from).
yield from baz();

// Cover spaces_inside_parentheses.
function foo($bar, $baz) {}

// Cover braces_position for anonymous class.
$bar = new class() {

    private $baz;

};

// Cover braces_position for empty anonymous class.
$foo = new class() {

};

// Cover braces_position for single line anonymous function.
$foo = static function () { return TRUE; };

// Cover braces_position for anonymous function.
$bar = static function () {
    return TRUE;
};

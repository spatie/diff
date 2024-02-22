<?php

use Spatie\Diff\Differ;
use Spatie\Diff\Exceptions\CannotDiff;

beforeEach(function() {
   $this->differ = new Differ();
});

it('will thrown an exception if the types are not the same', function() {
    $this->differ->diff('a', ['a']);
})->throws(CannotDiff::class);

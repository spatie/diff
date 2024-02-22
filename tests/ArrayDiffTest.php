<?php

use Spatie\Diff\Differ;
use Spatie\Diff\Renderers\SimpleRenderer;

it('can diff two arrays', function () {
    $differ = new Differ();

    $result = $differ->diff(
        ['a' => 1, 'b' => 2, 'd' => 4],
        ['a' => 1, 'c' => 3, 'd' => 5]
    );

    $renderedResult = $result->render(new SimpleRenderer());

    dd($renderedResult);
});

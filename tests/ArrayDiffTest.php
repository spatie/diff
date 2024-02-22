<?php

use Spatie\Diff\Differ;
use Spatie\Diff\Renderers\SimpleRenderer;

it('can detect the same array', function() {
    $differ = new Differ();

    $result = $differ->diff(
        ['a' => 1, 'b' => 2, 'c' => 3],
        ['a' => 1, 'b' => 2, 'c' => 3],
    );

    $renderedResult = $result->render(new SimpleRenderer());

    expect($renderedResult)->toBe('');
});

it('can detect changes in two simple arrays', function () {
    $differ = new Differ();

    $result = $differ->diff(
        ['a' => 1, 'b' => 2, 'd' => 4],
        ['a' => 1, 'c' => 3, 'd' => 5]
    );

    $renderedResult = $result->render(new SimpleRenderer());

    expect($renderedResult)->toMatchSnapshot();
});

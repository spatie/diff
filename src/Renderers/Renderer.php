<?php

namespace Spatie\Diff\Renderers;

use Spatie\Diff\DiffResult;

interface Renderer
{
    public function render(DiffResult $diffResult): string;
}

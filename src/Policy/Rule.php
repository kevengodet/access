<?php

declare(strict_types=1);

namespace Keven\Access\Policy;

use Keven\Access\Model\Decision;
use Keven\Access\Model\Request;

interface Rule
{
    public function handle(Request $request, Rule $next): Decision;
}

<?php

declare(strict_types=1);

namespace Keven\Access\Policy;

use Keven\Access\Model\Decision;
use Keven\Access\Model\Request;

interface Policy
{
    public function applyTo(Request $request): Decision;
}

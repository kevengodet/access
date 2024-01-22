<?php

declare(strict_types=1);

namespace Mevia\Access\Policy;

use Mevia\Access\Model\Decision;
use Mevia\Access\Model\Request;

interface Policy
{
    public function applyTo(Request $request): Decision;
}

<?php

declare(strict_types=1);

namespace Keven\Access\Policy;

use Keven\Access\Factory;
use Keven\Access\Model\Decision;
use Keven\Access\Model\Request;

final class No implements Rule
{
    private Factory $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(Request $request, Rule $next): Decision
    {
        return $this->factory->createDecision($request, false);
    }
}

<?php

declare(strict_types=1);

namespace Mevia\Access\Policy;

use Mevia\Access\Factory;
use Mevia\Access\Model\Decision;
use Mevia\Access\Model\Request;

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

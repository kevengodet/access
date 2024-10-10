<?php

declare(strict_types=1);

namespace Keven\Access;

use Keven\Access\Model\Decision;
use Keven\Access\Model\Normalizer;
use Keven\Access\Model\Request;
use Keven\Access\Policy\Policy;
use Keven\Access\Tool\DumbNormalizer;
use Keven\Access\Tool\Factory;

final class Guard
{
    private Factory $factory;
    private Policy $policy;
    private Normalizer $normalizer;

    public function __construct(?Policy $policy = null, ?Normalizer $normalizer = null, ?Factory $factory = null)
    {
        $this->factory = $factory ?? new Factory();
        $this->normalizer = $normalizer ?? new DumbNormalizer($this->factory);
        $this->policy = $policy ?? new class($this->factory) implements Policy {
            private Factory $factory;
            public function __construct(Factory $factory)
            {
                $this->factory = $factory;
            }
            public function applyTo(Request $request): Decision
            {
                return $this->factory->createDecision($request, false);
            }
        };
    }

    public function isGranted($identity, $action, $resource): bool
    {
        return $this->policy->applyTo(
            $this->factory->createRequest(
                $this->normalizer->normalizeIdentity($identity),
                $this->normalizer->normalizeAction($action),
                $this->normalizer->normalizeResource($resource)
            )
        )->isGranted();
    }
}

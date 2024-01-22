<?php

declare(strict_types=1);

namespace Mevia\Access;

use Mevia\Access\Model\Decision;
use Mevia\Access\Model\Normalizer;
use Mevia\Access\Model\Request;
use Mevia\Access\Policy\Policy;
use Mevia\Access\Tool\DumbNormalizer;
use Mevia\Access\Tool\Factory;

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

<?php

declare(strict_types=1);

namespace Keven\Access\Tool;

use Keven\Access\Model\Action;
use Keven\Access\Model\Identity;
use Keven\Access\Model\Normalizer;
use Keven\Access\Model\Resource;

final class DumbNormalizer implements Normalizer
{
    private Factory $factory;

    public function __construct(?Factory $factory = null)
    {
        $this->factory = $factory ?? new Factory();
    }

    public function normalizeIdentity($identity): Identity
    {
        return $identity instanceof Identity ?
            $identity :
            $this->factory->createIdentity($identity)
        ;
    }

    public function normalizeAction($action): Action
    {
        return $action instanceof Action ?
            $action :
            $this->factory->createAction($action)
        ;
    }

    public function normalizeResource($resource): Resource
    {
        return $resource instanceof Resource ?
            $resource :
            $this->factory->createResource($resource)
        ;
    }
}

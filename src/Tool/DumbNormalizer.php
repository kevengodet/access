<?php

declare(strict_types=1);

namespace Mevia\Access\Tool;

use Mevia\Access\Model\Action;
use Mevia\Access\Model\Identity;
use Mevia\Access\Model\Normalizer;
use Mevia\Access\Model\Resource;

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

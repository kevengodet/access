<?php

declare(strict_types=1);

namespace Keven\Access\Tool;

use Keven\Access\Model\Action;
use Keven\Access\Model\Decision;
use Keven\Access\Model\Identity;
use Keven\Access\Model\Request;
use Keven\Access\Model\Resource;

final class Factory
{
    public function createRequest(Identity $identity, Action $action, Resource $resource): Request
    {
        return new class($identity, $action, $resource) implements Request
        {
            private Identity $identity;
            private Action $action;
            private Resource $resource;
            public function __construct(Identity $identity, Action $action, Resource $resource)
            {
                $this->identity = $identity;
                $this->action = $action;
                $this->resource = $resource;
            }

            public function getIdentity(): Identity
            {
                return $this->identity;
            }

            public function getAction(): Action
            {
                return $this->action;
            }

            public function getResource(): Resource
            {
                return $this->resource;
            }
        };
    }

    public function createDecision(Request $request, bool $isGranted): Decision
    {
        return new class($request, $isGranted) implements Decision
        {
            private Request $request;
            private bool $isGranted;
            public function __construct(Request $request, bool $isGranted)
            {
                $this->request = $request;
                $this->isGranted = $isGranted;
            }
            public function getRequest(): Request
            {
                return $this->request;
            }

            public function isGranted(): bool
            {
                return $this->isGranted;
            }
        };
    }

    public function createIdentity($value): Identity
    {
        return new class($value) implements Identity {
            private $value;

            public function __construct($value)
            {
                $this->value = $value;
            }
        };
    }

    public function createAction($value): Action
    {
        return new class($value) implements Action {
            private $value;

            public function __construct($value)
            {
                $this->value = $value;
            }
        };
    }

    public function createResource($value): Resource
    {
        return new class($value) implements Resource {
            private $value;

            public function __construct($value)
            {
                $this->value = $value;
            }
        };
    }
}

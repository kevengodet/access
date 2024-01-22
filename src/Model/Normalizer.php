<?php

declare(strict_types=1);

namespace Mevia\Access\Model;

interface Normalizer
{
    public function normalizeIdentity($identity): Identity;
    public function normalizeAction($action): Action;
    public function normalizeResource($resource): Resource;
}

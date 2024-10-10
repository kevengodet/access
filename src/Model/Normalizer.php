<?php

declare(strict_types=1);

namespace Keven\Access\Model;

interface Normalizer
{
    public function normalizeIdentity($identity): Identity;
    public function normalizeAction($action): Action;
    public function normalizeResource($resource): Resource;
}

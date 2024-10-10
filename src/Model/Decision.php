<?php

declare(strict_types=1);

namespace Keven\Access\Model;

interface Decision
{
    public function getRequest(): Request;
    public function isGranted(): bool;
}

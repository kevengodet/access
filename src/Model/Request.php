<?php

declare(strict_types=1);

namespace Mevia\Access\Model;

interface Request
{
    public function getIdentity(): Identity;
    public function getAction(): Action;
    public function getResource(): Resource;
}

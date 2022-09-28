<?php

namespace App\Core\Domain\Service;

use App\Core\Domain\Models\MabaAccount;
use App\Core\Domain\Models\User\User;

interface JwtManagerInterface
{
    public function createFromUser(User $user): string;

    public function decode(string $jwt): MabaAccount;
}

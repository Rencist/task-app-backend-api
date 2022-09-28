<?php

use App\Core\Domain\Repository\TaskRepositoryInterface;
use App\Infrastrucutre\Service\JwtManager;
use App\Core\Domain\Service\JwtManagerInterface;
use Illuminate\Contracts\Foundation\Application;
use App\Infrastrucutre\Repository\SqlUserRepository;
use App\Core\Domain\Repository\UserRepositoryInterface;
use App\Infrastrucutre\Repository\SqlTaskRepository;

/** @var Application $app */

$app->singleton(UserRepositoryInterface::class, SqlUserRepository::class);
$app->singleton(JwtManagerInterface::class, JwtManager::class);
$app->singleton(TaskRepositoryInterface::class, SqlTaskRepository::class);

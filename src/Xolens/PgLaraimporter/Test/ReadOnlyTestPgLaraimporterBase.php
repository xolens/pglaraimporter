<?php

namespace Xolens\PgLaraimporter\Test;

use Xolens\PgLarautil\Test\TestCase;
use Xolens\PgLarautil\Test\RepositoryTrait\ReadOnlyRepositoryTestTrait;

abstract class ReadOnlyTestPgLaraimporterBase extends TestCase
{
    use ReadOnlyRepositoryTestTrait;
    
    protected $repo;

    public function repository(){
        return $this->repo;
    }

    protected function getPackageProviders($app): array{
        return [
            'Xolens\PgLaraimporter\PgLaraimporterServiceProvider',
        ];
    }
}

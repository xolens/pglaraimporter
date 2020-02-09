<?php

namespace Xolens\PgLaraimporter\App\Repository\View;

use Xolens\PgLaraimporter\App\Model\Import;
use Xolens\PgLaraimporter\App\Model\View\ImportView;
use Xolens\PgLaraimporter\App\Repository\ImportRepository;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLarautil\App\Util\Model\Sorter;

class ImportViewRepository extends AbstractReadableRepository implements ImportViewRepositoryContract
{
    public function model(){
        return ImportView::class;
    }
}

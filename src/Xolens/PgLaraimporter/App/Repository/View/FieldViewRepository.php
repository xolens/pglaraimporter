<?php

namespace Xolens\PgLaraimporter\App\Repository\View;

use Xolens\PgLaraimporter\App\Model\Field;
use Xolens\PgLaraimporter\App\Model\View\FieldView;
use Xolens\PgLaraimporter\App\Repository\FieldRepository;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLarautil\App\Util\Model\Sorter;

class FieldViewRepository extends AbstractReadableRepository implements FieldViewRepositoryContract
{
    public function model(){
        return FieldView::class;
    }
}

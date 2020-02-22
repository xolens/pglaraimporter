<?php

namespace Xolens\PgLaraimporter\App\Repository\View;

use Xolens\PgLarautil\App\Repository\ReadableRepositoryContract;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLarautil\App\Util\Model\Sorter;

interface SheetViewRepositoryContract extends ReadableRepositoryContract
{

     public function paginateByImport($parentId, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page');

     public function paginateByImportSorted($parentId, Sorter $sorter, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page');

     public function paginateByImportFiltered($parentId, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page');

     public function paginateByImportSortedFiltered($parentId, Sorter $sorter, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page');

}

<?php

namespace Xolens\PgLaraimporter\Test\Repository;

use Xolens\PgLaraimporter\App\Model\Sheet;
use Xolens\PgLaraimporter\App\Repository\SheetRepository;
use Xolens\PgLaraimporter\App\Repository\ImportRepository;
use Xolens\PgLarautil\App\Util\Model\Sorter;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLaraimporter\Test\WritableTestPgLaraimporterBase;

final class SheetRepositoryTest extends WritableTestPgLaraimporterBase
{
    protected $importRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new SheetRepository();
        $this->importRepo = new ImportRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $importId = $this->importRepo->model()::inRandomOrder()->first()->id;
        $item = factory(Sheet::class)->make([
            'import_id' => $importId,
        ]);
        $this->assertTrue(true);
    }
    
    /** HELPERS FUNCTIONS --------------------------------------------- **/

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id');
        return $sorter;
    }

    public function generateFilterer(){
        $filterer = new Filterer();
        $filterer->between('id',[0,14]);
        return $filterer;
    }

    public function generateItems($toGenerateCount){
        $count = $this->repository()->count()->response();
        $generatedItemsId = [];
        for($i=$count; $i<($toGenerateCount+$count); $i++){
            $importId = $this->importRepo->model()::inRandomOrder()->first()->id;
            $data = factory(Sheet::class)->make([
                'import_id' => $importId,
            ]);
            $item = $this->repository()->create($data);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   


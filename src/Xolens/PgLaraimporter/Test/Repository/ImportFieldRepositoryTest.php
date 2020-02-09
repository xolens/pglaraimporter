<?php

namespace Xolens\PgLaraimporter\Test\Repository;

use Xolens\PgLaraimporter\App\Model\ImportField;
use Xolens\PgLaraimporter\App\Repository\ImportFieldRepository;
use Xolens\PgLaraimporter\App\Repository\ImportRepository;
use Xolens\PgLaraimporter\App\Repository\FieldRepository;
use Xolens\PgLarautil\App\Util\Model\Sorter;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLaraimporter\Test\WritableTestPgLaraimporterBase;

final class ImportFieldRepositoryTest extends WritableTestPgLaraimporterBase
{
    protected $importRepo;
    protected $fieldRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new ImportFieldRepository();
        $this->importRepo = new ImportRepository();
        $this->fieldRepo = new FieldRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $importId = $this->importRepo->model()::inRandomOrder()->first()->id;
        $fieldId = $this->fieldRepo->model()::inRandomOrder()->first()->id;
        $item = factory(ImportField::class)->make([
            'import_id' => $importId,
            'field_id' => $fieldId,
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
            $fieldId = $this->fieldRepo->model()::inRandomOrder()->first()->id;
            $data = factory(ImportField::class)->make([
                'import_id' => $importId,
                'field_id' => $fieldId,
            ]);
            $item = $this->repository()->create($data);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   


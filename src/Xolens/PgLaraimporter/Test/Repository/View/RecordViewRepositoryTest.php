<?php

namespace Xolens\PgLaraimporter\Test\Repository\View;

use Xolens\PgLaraimporter\App\Repository\View\RecordViewRepository;
use Xolens\PgLarautil\App\Util\Model\Sorter;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLaraimporter\Test\WritableTestPgLaraimporterBase;

final class RecordViewRepositoryTest extends WritableTestPgLaraimporterBase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $this->repo = new RecordViewRepository();
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $importId = $this->importRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            'sheet_name' => 'sheet_name'.$i,
            'data' => 'data'.$i,
            'import_id' => $importId,
            'import_date' => 'importDate'.$i,
            'completed' => 'completed'.$i,
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
            $item = $this->repository()->create([
                'sheet_name' => 'sheet_name'.$i,
                'data' => 'data'.$i,
                'import_id' => $importId,
                'import_date' => 'importDate'.$i,
                'completed' => $i%2==0,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   


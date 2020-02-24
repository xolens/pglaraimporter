<?php

namespace Xolens\PgLaraimporter\App\Repository;

use Xolens\PgLaraimporter\App\Model\Import;
use Xolens\PgLaraimporter\App\Model\Record;
use Xolens\PgLaraimporter\App\Model\Sheet;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaraimporterCreateTableImport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Collections\RowCollection;


class ImportRepository extends AbstractWritableRepository implements ImportRepositoryContract
{
    public function model(){
        return Import::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        return [
            'id' => ['required',Rule::unique(PgLaraimporterCreateTableImport::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })],
        ];
    }
    //*/

    
    public function importFile($importName, $importDescription, $file) {
        try{
            $import = new Import([
                'name' => $importName, 
                'description' => $importDescription,
                'record_count' => -1,
                'sheet_count' => -1
            ]);
                
            Excel::load($file, function ($reader) use(&$import, $importName, $importDescription){
                
                $reader->noHeading();
                $reader->formatDates(false);

                $import->save();
                
                if($reader->first() instanceof RowCollection){ // Multiple sheets
                    $reader->each(function($data)  use ($reader, $import) {
                        if(count($data)>0){
                            
                            $sheetName = $data->getTitle();
                            $columnCount = \PHPExcel_Cell::columnIndexFromString($reader->excel->getActiveSheet()->getHighestColumn());
                            $sheet = $this->saveSheet($import, $sheetName, $columnCount, -1);
                            
                            $data->each(function($row) use ($sheet) {
                                $this->importRow($sheet, $row);
                            });
                    
                            $sheet->update([
                                "record_count" => Record::where('sheet_id', $sheet->id)->count(),
                            ]);
                        }
                    });
                }else{  //instance of CellCollection, Single sheet
                    $activeSheet = $reader->excel->getActiveSheet();
                    $sheetName = $activeSheet->getTitle();
                    $columnCount = \PHPExcel_Cell::columnIndexFromString($reader->excel->getActiveSheet()->getHighestColumn());
                    $sheet = $this->saveSheet($import, $sheetName, $columnCount, -1);
                    
                    $reader->each(function($data)  use ($sheet) {
                        $this->importRow($sheet, $data);
                    });

                    $sheet->update([
                        "record_count" => Record::where('sheet_id', $sheet->id)->count(),
                    ]);                }

                    $import->update([
                        "record_count" => Record::where('import_id', $import->id)->count(),
                        "sheet_count" => Sheet::where('import_id', $import->id)->count(),
                        "state" => "UPLOADED"
                    ]);
            });
            return $this->returnResponse($import);
        }catch(\Exception $e) {
            return $this->returnErrors([$e->getMessage()]);
        }
    }

    private function saveSheet($import, $sheetName, $columnCount, $rowCount){
        $sheet = new Sheet([
            'name'=>  $sheetName,
            'import_id' => $import->id,
            'column_count' => $columnCount,
            'record_count' => $rowCount,
        ]);
        $sheet->save();
        return $sheet;
    }

    private function importRow($sheet, $row){
        $rowData = [];
        for($i=0; $i<count($row); $i++){
            $key = "col".$i;
            $rowData[$key] = $row[$i];
        }
        $record = new Record([
            'data' => $rowData,
            'import_id' => $sheet->import_id,
            'sheet_id'=>  $sheet->id
        ]);
        $record->save();
        return $record;
    }
    
}

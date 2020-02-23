<?php

namespace Xolens\PgLaraimporter\App\Service;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Collections\RowCollection;

use Xolens\PgLaraimporter\App\Model\Record;
use Xolens\PgLaraimporter\App\Model\Import;
use Xolens\PgLaraimporter\App\Model\Sheet;

class FileToDatabaseService
{
     /**
    * @return \Illuminate\Support\Collection
    */
    public function importFile($importName, $importDescription, $file) 
    {
        $file = Input::file('file');
       
            Excel::load($file, function ($reader) use($importName, $importDescription){
            
            $reader->noHeading();
            
            $import = new Import([
                'name' => $importName, 
                'description' => $importDescription,
                'record_count' => -1,
                'sheet_count' => -1
            ]);
    
            $import->save();
            
            if($reader->first() instanceof RowCollection){ // Multiple sheets
                $reader->each(function($data)  use ($reader, $import) {
                    if(count($data)>0){
                        
                        $sheetName = $data->getTitle();
                        $columnCount = \PHPExcel_Cell::columnIndexFromString($reader->excel->getActiveSheet()->getHighestColumn());
                        
                        $data->each(function($row) use ($sheetName, $import){
                            $this->importRow($import, $row, $sheetName);
                        });
                
                        $this->saveSheet($import, $sheetName, $columnCount, Record::where('import_id', $import->id)->where('sheet_name', $sheetName)->count());
                    }
                });
            }else{  //instance of CellCollection, Single sheet
                $activeSheet = $reader->excel->getActiveSheet();
                $sheetName = $activeSheet->getTitle();
                $columnCount = \PHPExcel_Cell::columnIndexFromString($reader->excel->getActiveSheet()->getHighestColumn());
                
                $reader->each(function($data)  use ($import, $sheetName) {
                    $this->importRow($import, $data, $sheetName);
                });

                $this->saveSheet($import, $sheetName, $columnCount, Record::where('import_id', $import->id)->where('sheet_name', $sheetName)->count());
            }

            $import->update([
                "record_count" => Record::where('import_id', $import->id)->count(),
                "state" => "UPLOADED"
            ]);
        });

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

    private function importRow($import, $row, $sheetName){
        $rowData = [];
        for($i=0; $i<count($row); $i++){
            $key = "col".$i;
            $rowData[$key] = $row[$i];
        }
        $record = new Record([
            'data' => $rowData,
            'import_id' => $import->id,
            'sheet_name'=>  $sheetName
        ]);
        $record->save();
        return $record;
    }
}

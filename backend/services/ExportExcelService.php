<?php
namespace backend\services;

use backend\models\MapPoints;
use JetBrains\PhpStorm\NoReturn;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;

/**
 * ExportExcelService class
 * @package backend\services
 */
class ExportExcelService
{

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */

    #[NoReturn]
    public function export(UploadedFile $file)
    {
        $excelReader = IOFactory::createReaderForFile($file->tempName);
        $excelObj = $excelReader->load($file->tempName);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();

        for ($row = 2; $row <= $lastRow; $row++) {
            $mapPoint = new MapPoints();
            $coordinateX = floatval(str_replace(',', '.', $worksheet->getCell('A' . $row)->getValue()));
            $coordinateY = floatval(str_replace(',', '.', $worksheet->getCell('B' . $row)->getValue()));
            $mapPoint->top_left_point_x = $coordinateX - 0.00089;
            $mapPoint->top_left_point_y = $coordinateY + 0.00062;
            $mapPoint->top_right_point_x = $coordinateX - 0.00118;
            $mapPoint->top_right_point_y = $coordinateY - 0.000258;
            $mapPoint->bottom_left_point_x = $coordinateX + 0.0002;
            $mapPoint->bottom_left_point_y = $coordinateY - 0.000378;
            $mapPoint->bottom_right_point_x = $coordinateX + 0.0005;
            $mapPoint->bottom_right_point_y = $coordinateY + 0.0005;
            $mapPoint->years_data = json_encode([
                'year_2019' => $worksheet->getCell('C' . $row)->getValue(),
                'year_2020' => $worksheet->getCell('D' . $row)->getValue(),
                'year_2021' => $worksheet->getCell('E' . $row)->getValue()
            ]);

            $mapPoint->save();
        }
    }
}
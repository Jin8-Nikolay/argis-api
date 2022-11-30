<?php
namespace frontend\services;

use backend\models\MapPoints;
use frontend\repositories\MapPointsRepository;
use JetBrains\PhpStorm\NoReturn;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;

/**
 * @MapPointsJSONCollection class
 * @package backend\services
 */
class MapPointsJSONCollection
{

    public function getData(): array
    {
        $data = MapPointsRepository::getAll();
        $arr = [];

        foreach ($data as $datum) {
            $coordinate = [
                'top_left_point_x' => $datum->top_left_point_x,
                'top_left_point_y' => $datum->top_left_point_y,
                'top_right_point_x' => $datum->top_right_point_x,
                'top_right_point_y' => $datum->top_right_point_y,
                'bottom_left_point_x' => $datum->bottom_left_point_x,
                'bottom_left_point_y' => $datum->bottom_left_point_y,
                'bottom_right_point_x' => $datum->bottom_right_point_x,
                'bottom_right_point_y' => $datum->bottom_right_point_y,
                'description' => json_decode($datum->years_data),
            ];
            $arr[] = $coordinate;
        }

        return $arr;
    }
}
<?php
namespace frontend\repositories;

use backend\models\MapPoints;
use JetBrains\PhpStorm\NoReturn;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;

/**
 * @MapPointsRepository class
 * @package backend\services
 */
class MapPointsRepository
{

    public static function getAll(): array
    {
        return MapPoints::find()->all();
    }
}
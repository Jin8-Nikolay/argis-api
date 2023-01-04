<?php

namespace backend\models\forms;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "map_points".
 *
 * @property int $id
 * @property float|null $coordinate_x
 * @property float|null $coordinate_y
 * @property string|null $year_dates
 */
class ExportExcelForm extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $excelFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['excelFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'excelFile' => 'Excel файл'
        ];
    }
}
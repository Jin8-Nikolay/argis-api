<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "map_points".
 *
 * @property int $id
 * @property double|null $top_left_point_x
 * @property double|null $top_left_point_y
 * @property double|null $top_right_point_x
 * @property double|null $top_right_point_y
 * @property double|null $bottom_left_point_x
 * @property double|null $bottom_left_point_y
 * @property double|null $bottom_right_point_x
 * @property double|null $bottom_right_point_y
 * @property string|null $years_data
 */
class MapPoints extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'map_points';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'top_left_point_x',
                    'top_left_point_y',
                    'top_right_point_x',
                    'top_right_point_y',
                    'bottom_left_point_x',
                    'bottom_left_point_y',
                    'bottom_right_point_x',
                    'bottom_right_point_y',
                ],
                'safe'
            ],
            [['years_data'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'years_data' => 'Years Data',
        ];
    }
}

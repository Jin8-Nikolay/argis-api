<?php

use backend\models\MapPoints;
use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m221025_134322_add_columns_in_map_points_table
 */
class m221025_134322_add_columns_in_map_points_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(MapPoints::tableName(), 'top_left_point_y', Schema::TYPE_DOUBLE);
        $this->addColumn(MapPoints::tableName(), 'top_right_point_y', Schema::TYPE_DOUBLE);
        $this->addColumn(MapPoints::tableName(), 'bottom_left_point_x', Schema::TYPE_DOUBLE);
        $this->addColumn(MapPoints::tableName(), 'bottom_left_point_y', Schema::TYPE_DOUBLE);
        $this->addColumn(MapPoints::tableName(), 'bottom_right_point_x', Schema::TYPE_DOUBLE);
        $this->addColumn(MapPoints::tableName(), 'bottom_right_point_y', Schema::TYPE_DOUBLE);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221025_134322_add_columns_in_map_points_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221025_134322_add_columns_in_map_points_table cannot be reverted.\n";

        return false;
    }
    */
}

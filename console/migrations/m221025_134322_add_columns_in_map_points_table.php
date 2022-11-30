<?php

use yii\db\Migration;

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
        $this->addColumn(\backend\models\MapPoints::tableName(), 'top_left_point_y', \yii\db\Schema::TYPE_DOUBLE);
        $this->addColumn(\backend\models\MapPoints::tableName(), 'top_right_point_y', \yii\db\Schema::TYPE_DOUBLE);
        $this->addColumn(\backend\models\MapPoints::tableName(), 'bottom_left_point_x', \yii\db\Schema::TYPE_DOUBLE);
        $this->addColumn(\backend\models\MapPoints::tableName(), 'bottom_left_point_y', \yii\db\Schema::TYPE_DOUBLE);
        $this->addColumn(\backend\models\MapPoints::tableName(), 'bottom_right_point_x', \yii\db\Schema::TYPE_DOUBLE);
        $this->addColumn(\backend\models\MapPoints::tableName(), 'bottom_right_point_y', \yii\db\Schema::TYPE_DOUBLE);
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

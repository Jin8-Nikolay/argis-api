<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m220605_113944_map_points_create_table
 */
class m220605_113944_map_points_create_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('map_points', [
            'id' => Schema::TYPE_PK,
            'top_left_point_x' => Schema::TYPE_DOUBLE,
            'top_right_point_x' => Schema::TYPE_DOUBLE,
            'years_data' => Schema::TYPE_JSON,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220605_113944_map_points_create_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220605_113944_map_points_create_table cannot be reverted.\n";

        return false;
    }
    */
}

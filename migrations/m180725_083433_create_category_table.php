<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180725_083433_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->batchInsert('category', [ 'name'], [
            ['Home'],
            ['Garden'],
            ['Electrical'],
            ['Motors'],
            ['Sports & Fitness'],
            ['Clothing'],
            ['Other'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}

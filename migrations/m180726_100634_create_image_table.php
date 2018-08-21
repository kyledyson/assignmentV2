<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 * Has foreign keys to the tables:
 *
 * - `item`
 */
class m180726_100634_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'path' => $this->string()->notNull(),
            'item_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `item_id`
        $this->createIndex(
            'idx-image-item_id',
            'image',
            'item_id'
        );

        // add foreign key for table `item`
        $this->addForeignKey(
            'fk-image-item_id',
            'image',
            'item_id',
            'item',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `item`
        $this->dropForeignKey(
            'fk-image-item_id',
            'image'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            'idx-image-item_id',
            'image'
        );

        $this->dropTable('image');
    }
}

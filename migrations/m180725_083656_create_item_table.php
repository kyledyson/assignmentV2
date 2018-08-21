<?php

use yii\db\Migration;

/**
 * Handles the creation of table `item`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `category`
 */
class m180725_083656_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('item', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'condition' => $this->integer()->notNull(),
            'location' => $this->string()->notNull(),
            'price' => $this->double()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),

        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-item-user_id',
            'item',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-item-user_id',
            'item',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-item-category_id',
            'item',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-item-category_id',
            'item',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-item-user_id',
            'item'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-item-user_id',
            'item'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-item-category_id',
            'item'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-item-category_id',
            'item'
        );

        $this->dropTable('item');
    }
}

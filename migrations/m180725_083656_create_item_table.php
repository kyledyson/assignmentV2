<?php

use app\models\Item;
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
            'location_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'condition' => $this->integer()->notNull(),
            'price' => $this->double()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),
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

        // creates index for column `location_id`
        $this->createIndex(
            'idx-item-location_id',
            'item',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-item-location_id',
            'item',
            'location_id',
            'location',
            'id',
            'CASCADE'
        );

        $faker = Faker\Factory::create();
        // create 5 users for testing
        for ($i = 0; $i < 10; $i++) {
            $this->insert('item',
                [
                    'title' => $faker->word,
                    'location_id' => $faker->numberBetween(1, 87),
                    'category_id' => $faker->numberBetween(1, 7),
                    'user_id' => $faker->numberBetween(1, 5),
                    'description'  => $faker->sentence,
                    'condition' => $faker->randomElement(['New', 'Old']),
                    'status' => $faker->numberBetween(0,1),
                    'price' => $faker->numberBetween(10, 200),
                    'created_at' => time(),
                ]);
        }

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

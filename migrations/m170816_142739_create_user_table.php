<?php

use app\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m170816_142739_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(25)->notNull(),
            'email' => $this->string(255)->notNull(),
            'profile_picture' => $this->string(),
            'mobile_number' => $this->string(30)->notNull(),
            'postcode' => $this->string(20)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(60)->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'created_at' => $this->integer()->notNull()->defaultValue(strtotime('today')),
            'updated_at' => $this->integer()->notNull()->defaultValue(strtotime('today')),
        ]);
        $faker = Faker\Factory::create();

        $user = new User([
            'username' => 'test_user',
            'email' => $faker->email,
            'mobile_number' => '07983984993',
            'postcode' => 'm278sj',
            'password' => 'password123',
            'auth_key' => 'ewdvhiujh3jnv'
        ]);
        $user->save();
    }

    public function down()
    {

    }

}

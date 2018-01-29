<?php

use yii\db\Migration;

/**
 * Class m180104_134559_fill_users_table
 */
class m180104_134559_fill_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        \Yii::$app->db->createCommand()->insert('users', [
            'username' => 'admin', 'first_name' => 'admin', 'second_name' => 'admin',
            'email' => 'admin@email.ru', 'status' => 10, 'password' => \Yii::$app->getSecurity()->generatePasswordHash(123123),
            'created_at' => date('Y-m-d H:i:s')
        ])->execute();

        for ($i = 0; $i < 5; ++$i) {
            $faker = Faker\Factory::create('ru_RU');

            \Yii::$app->db->createCommand()->insert('users', [
                'username' => $faker->userName, 'first_name' => $faker->firstName, 'second_name' => $faker->lastName,
                'email' => $faker->email, 'status' => 10, 'password' => \Yii::$app->getSecurity()->generatePasswordHash($faker->password(6, 20)),
                'created_at' => date('Y-m-d H:i:s'),
            ])->execute();
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->truncateTable('users');
    }
}

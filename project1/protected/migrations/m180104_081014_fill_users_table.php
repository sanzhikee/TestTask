<?php
require_once __DIR__.'/../../../project2/vendor/fzaninotto/faker/src/autoload.php';

class m180104_081014_fill_users_table extends CDbMigration
{
    public function up()
    {
        $command = Yii::app()->db->createCommand();
        $command->insert('users', [
            'username' => 'admin', 'first_name' => 'admin', 'second_name' => 'admin',
            'email' => 'admin@email.ru', 'status' => 10, 'password' => CPasswordHelper::hashPassword(123123),
            'created_at' => date('Y-m-d H:i:s'), 'role' => 'admin'
        ]);
        for ($i = 0; $i < 5; ++$i) {
            $faker = Faker\Factory::create('ru_RU');

            $command = Yii::app()->db->createCommand();
            $command->insert('users', [
                'username' => $faker->userName, 'first_name' => $faker->firstName, 'second_name' => $faker->lastName,
                'email' => $faker->email, 'status' => 10, 'password' => CPasswordHelper::hashPassword($faker->password(6, 20)),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function down()
    {
        $this->truncateTable('users');
    }
}
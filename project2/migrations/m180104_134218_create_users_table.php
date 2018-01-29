<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m180104_134218_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime(),
            'username' => $this->string()->unique()->notNull(),
            'first_name' => $this->string()->notNull(),
            'second_name' => $this->string()->notNull(),
            'email' => $this->string()->unique(),
            'status' => $this->string(),
            'password' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}

<?php

class m171228_055207_create_users_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('users', array(
            'id' => 'pk',
            'created_at' => 'DATETIME NOT NULL',
            'username' => 'VARCHAR(255) NOT NULL',
            'first_name' => 'VARCHAR(255) NOT NULL',
            'second_name'  => 'VARCHAR(255) NOT NULL',
            'email'  => 'VARCHAR(255) NOT NULL',
            'status'  => 'INT NOT NULL',
            'password'  => 'VARCHAR(255) NOT NULL',
            'role'  => 'VARCHAR(255) NOT NULL',

            'UNIQUE KEY `username` (`username`)',
            'UNIQUE KEY `email` (`email`)',
            'KEY `created_at` (`created_at`)',
        ));
	}

	public function safeDown()
	{
		$this->dropTable('users');
	}
}
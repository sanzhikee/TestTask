<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 10;

    const STATUSES = [
        0 => 'Заблокирован',
        10 => 'Активен'
    ];

    public $new_password = "";
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public function rules()
    {
        return [
            [['username', 'first_name', 'second_name', 'email', 'status', 'password'], 'required'],
            [['username', 'first_name', 'second_name', 'email', 'status', 'password', 'new_password'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'username' => 'Username',
            'first_name' => 'First Name',
            'second_name' => 'Second Name',
            'email' => 'Email',
            'status' => 'Status',
            'password' => 'Password',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return User::find()->where(['password' => $token])->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     */
    public static function findByUsername($username)
    {
        return User::find()->where(['username' => $username])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        // Да про аутхкеи я прекрасно понимаю, но у меня нет времени чтобы реализовывать их отдельно, поэтому отправлять будем хэш пароля
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->password === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public static function tableName()
    {
        return 'users';
    }

    public function beforeSave($insert)
    {
        if($insert) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }else {
            if ($this->new_password) {
                $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->new_password);
            }
        }

        return parent::beforeSave($insert);
    }
}

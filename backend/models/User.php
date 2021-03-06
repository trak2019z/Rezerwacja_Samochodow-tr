<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property int $user_rent
 * @property int $user_adm
 *
 * @property Rental $userRent
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'first_name', 'last_name', 'user_adm'], 'required'],
            [['status', 'created_at', 'updated_at', 'user_rent'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['user_adm'], 'string', 'max' => 1],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['user_rent'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['user_rent'], 'exist', 'skipOnError' => true, 'targetClass' => Rental::className(), 'targetAttribute' => ['user_rent' => 'rental_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'user_rent' => 'User Rent',
            'user_adm' => 'User Adm',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRent()
    {
        return $this->hasOne(Rental::className(), ['rental_id' => 'user_rent']);
    }
}

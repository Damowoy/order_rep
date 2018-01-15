<?php

namespace backend\models;


use Yii;
use backend\models\Roles;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $phone
 * @property string $lastname
 * @property string $firstname
 * @property integer $role_id
 */
class Users extends \yii\db\ActiveRecord
{
    public $firm_id;
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
            [['username', 'email','role_id','password_hash','firstname'], 'required'],
            [['username', 'lastname', 'firstname','phone' ], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password',
            'email'    => 'Email',
            'phone'    => 'Phone',
            'lastname' => 'Last name',
            'firstname'=> 'First name',
            'role_id'  => 'Role ID'
        ];
    }

    public function getRoles()
    {
        return $this->hasMany(Roles::className(), ['id' => 'role_id']);
    }

}

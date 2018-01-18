<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * User Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class User extends ActiveRecord implements IdentityInterface
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
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'username'  => 'Username',
            'email'     => 'Email',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'username' => 'username',
            'email' => 'email',

        ];
    }

    /**
     * Define rules for validation
     */
    public function rules()
    {

        return [
            [['id', 'username', 'email'], 'required']
        ];
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
}

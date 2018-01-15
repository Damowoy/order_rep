<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
/**
 * User Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class User extends ActiveRecord
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
  /*  public static function primaryKey()
    {
        return ['id'];
    }*/
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'username'  => 'Username',
            'email'     => 'Email',
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
}

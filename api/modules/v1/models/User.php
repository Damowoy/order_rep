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

    public function fields()
    {
        return [
            // field name is the same as the attribute name
            'id',
            // field name is "email", the corresponding attribute name is "email_address"
            'username' => 'username',

            'email' => 'email',

            // field name is "name", its value is defined by a PHP callback

        ];

       // $fields = parent::fields();
        // remove fields that contain sensitive information
        //unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);
        //return $fields;
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['user/view', 'id' => $this->id], true),
            'edit' => Url::to(['user/view', 'id' => $this->id], true),
            'profile' => Url::to(['user/profile/view', 'id' => $this->id], true),
            'index' => Url::to(['users'], true),
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

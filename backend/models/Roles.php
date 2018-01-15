<?php

namespace backend\models;

use backend\models\Users;
use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $name
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['role_id' => 'id']);
    }

}

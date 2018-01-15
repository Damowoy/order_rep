<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "firm".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $description
 * @property string $address
 * @property string $name
 */
class Firms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'firm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['description'], 'string'],
            [['address'], 'required'],
            [['address', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'description' => 'Description',
            'address' => 'Address',
            'name' => 'Name',
        ];
    }
}

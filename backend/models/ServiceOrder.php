<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $engener_id
 * @property integer $status_id
 * @property string $name_service
 * @property string $description
 * @property string $company
 * @property string $place
 * @property string $address
 */
class ServiceOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'engener_id', 'status_id'], 'integer'],
            [['description'], 'string'],
            [['name_service', 'company', 'address'], 'string', 'max' => 255],
            [['place'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'engener_id' => 'Engener ID',
            'status_id' => 'Status ID',
            'name_service' => 'Name Service',
            'description' => 'Description',
            'company' => 'Company',
            'place' => 'Place',
            'address' => 'Address',
        ];
    }
}

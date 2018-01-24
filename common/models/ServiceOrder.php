<?php
namespace common\models;

use yii\db\ActiveRecord;


/**
 * Service order Model
 *
 */
class ServiceOrder extends  ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'service_order';
    }
    
    /**
     * Define rules for validation
     */
    public function rules()
    {
        return [
            [['user_id', 'engener_id', 'status_id'], 'integer'],
            [['status_id','name_service', 'description','company','place','address'], 'required'],
            [['description'], 'string'],
            [['name_service', 'company', 'address'], 'string', 'max' => 255],
            [['place'], 'string', 'max' => 50],
        ];
    }

    
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'user_id'       => 'User ID',
            'name_service'  => 'Name service',
            'description'   => 'Description',
            'status_id'     => 'Status id',
            'engener_id'    => 'Engenr id',
            'company'       => 'Company',
            'place'         => 'Place',
            'address'       => 'Address'
        ];
    }
}

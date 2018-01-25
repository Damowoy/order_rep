<?php
namespace common\models;


use yii\db\ActiveRecord;

class OrderStdate extends ActiveRecord
{
    
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'order_stdate';
    }
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['status_id','service_order_id'], 'required']
        ];
    }
    
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'status_id'       => 'Status id',
            'service_order_id'=> 'Order id',
            'created_at'      => 'Date'
        ];
    }
    
}

?>
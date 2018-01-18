<?php
namespace api\modules\v1\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class OrderStdate extends ActiveRecord
{


    public static function tableName()
    {
        return 'order_stdate';
    }

    public function rules()
    {
        return [
            [['status_id','service_order_id'], 'required']
        ];
    }

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
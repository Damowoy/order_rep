<?php
namespace common\models;


use \yii\db\ActiveRecord;
/**
 * Comment Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Comment extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'comment';
    }
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['service_order_id', 'user_id','comment','created_dt'], 'required']
        ];
    }
    
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'comment'           => 'Comment name',
            'service_order_id'  => 'Service order id',
            'user_id'           => 'User id',
            'created_dt'        => 'Created date'
        ];
    }
    
}

<?php
namespace api\modules\v1\models;
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
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    public function rules()
    {
        return [
            [['service_order_id', 'user_id','comment','created_dt'], 'required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id'               => 'ID',
            'service_order_id' => 'Order id',
            'user_id'          => 'User id',
            'comment'          => 'Comment',
            'created_dt'       => 'Created date',
        ];
    }

}

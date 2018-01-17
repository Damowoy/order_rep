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
            [['id', 'service_order_id', 'user_id','comment','created_dt'], 'required']
        ];
    }
    public function attributeLabels()
    {
        return [
           'id'          => 'ID',
           'comment'     => 'Comment name',
            /* 'description' => 'Description',*/
        ];
    }

}

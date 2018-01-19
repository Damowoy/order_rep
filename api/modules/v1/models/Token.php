<?php
namespace api\modules\v1\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Token extends ActiveRecord
{
    public static function tableName()
    {
        return 'token';
    }
    public function fields()
    {
        return [
            'user_id' => 'user_id',
        ];

    }
}

?>
<?php
namespace common\models;

use \yii\db\ActiveRecord;
/**
 * Firm Model
 *
 */
class Firm extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'firm';
    }
    
    /**
     * @return array
     */
    public function rules()
    {
        
        return [
            [['name', 'description'], 'required']
        ];
    }
    
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Name',
            'description' => 'Description',
        ];
    }

}

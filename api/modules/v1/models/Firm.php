<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
/**
 * Firm Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Firm extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
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
   /* public static function primaryKey()
    {
        return ['id'];
    }*/

    /**
     * Define rules for validation
     */
    public function rules()
    {

        return [
            [['id', 'name', 'description'], 'required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Name',
            'description' => 'Description',
        ];
    }

   /* public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name','description'];
        return $scenarios;
    */
}

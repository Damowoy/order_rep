<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Status;


/**
 * bidForm is the model behind the bid form.
 */
class BidForm extends Model
{

    public $name_service;
    public $description;
    public $company;
    public $place;
    public $address;
    public $status_id;
    public $user_id;


    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name_service', 'description', 'company', 'place', 'address','user_id','status_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'name_service'  => 'Name_service',
            'description'   => 'Description',
            'company'       => 'Company',
            'place'         => 'Place',
            'address'       => 'Address',
            'status_id'     => 'Status_id',
            'user_id'       => 'User_id',
        ];
    }

    public function insertOrder($data){




    }
}
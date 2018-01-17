<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
//use api\modules\v1\models\ServiceOrder;

/**
 * Firm Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ServiceOrderController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\ServiceOrder';

}

<?php
namespace api\modules\v1\controllers;

use common\models\OrderStdate;

/**
 * Comment Controller API
 */
class OrderStdateController extends BaseauthController
{
    public $modelClass = '\common\models\OrderStdate';
    
    /**
     * @SWG\Get(
     *   path="/times",
     *   tags={"time status"},
     *   summary="List time status",
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   )
     * )
     *
     **/
    
    /**
     * @SWG\Get(
     *   path="/times/{id}",
     *   tags={"time status"},
     *   summary="Time status",
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   ),
     *   @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        description = "Order id",
     *        required = true,
     *        type = "integer"
     *    )
     * )
     *
     **/
    
    
    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        return $actions;
    }
    
    
    /**
     * @param $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = OrderStdate::find()->where(['service_order_id' => $id])->all();
        
        return $model;
    }
}

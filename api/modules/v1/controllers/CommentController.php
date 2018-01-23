<?php
namespace api\modules\v1\controllers;


/**
 * Comment Controller API
 */
class CommentController extends BaseauthController
{
    public $modelClass = '\common\models\Comment';
    
    /**
     * @SWG\Get(
     *   path="/comments",
     *   tags={"comment"},
     *   summary="List comment",
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   )
     * )
     *
     **/
    
    /**
     * @SWG\Get(
     *   path="/comments/{id}",
     *   tags={"comment"},
     *   summary="List comment",
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   ),
     *   @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        description = "User id",
     *        required = true,
     *        type = "integer"
     *    )
     * )
     *
     **/
    
    /**
     * @SWG\Delete(
     *   path="/comments/{id}",
     *   tags={"comment"},
     *   summary="List comment",
     *   @SWG\Response(
     *     response=200,
     *     description="success"
     *   ),
     *   @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        description = "User id",
     *        required = true,
     *        type = "integer"
     *    )
     * )
     *
     **/
    
    /**
     * @SWG\Post(
     *   path="/comments",
     *   tags={"comment"},
     *   summary="Insert comment",
     *   produces = {"application/json"},
     *	 consumes = {"application/json"},
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "service_order_id",
     *        description = "Order id",
     *        required = true,
     *        type = "integer"
     *    ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "user_id",
     *        description = "User id",
     *        required = true,
     *        type = "integer"
     *    ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "comment",
     *        description = "Comment",
     *        required = true,
     *        type = "string"
     *    ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "created_dt",
     *        description = "Engener id",
     *        required = true,
     *        type = "string",
     *        format ="date-time"
     *    ),
     *   @SWG\Response(
     *     response=200,
     *     description="success",
     *     @SWG\Header(header="Allow", type="POST"),
     *     @SWG\Header(header="Content-Type", type="application/json; charset=UTF-8")
     *   )
     * )
     *
     **/
}

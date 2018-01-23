<?php
namespace api\modules\v1\controllers;

use yii\web\Controller;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="api.orderrep",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Test Rest api",
 *         description="Api description...",
 *     )
 * )
 */


/**
 * @SWG\SecurityScheme(
 *   securityDefinition="api_key",
 *   type="apiKey",
 *   in="header",
 *   name="Authorization"
 * )
 */

class SwaggerController extends Controller{



}
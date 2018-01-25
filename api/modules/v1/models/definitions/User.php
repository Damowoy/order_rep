<?php
namespace api\modules\v1\models\definitions;

/**
 * @SWG\Definition()
 */

class User
{
    /**
     * The id
     * @var integer
     * @SWG\Property()
     */
    public $id;
    
    /**
     * The email
     * @var string
     * @SWG\Property()
     */
    public $email;
    
    /**
     * The username
     * @var string
     * @SWG\Property()
     */
    public $username;
}
?>

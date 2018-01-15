<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="content_account">
        <div class="row">
          <div class="col-md-12">
             <form method="post" action="">
              <div class="text-right">
                 <a href="<?php echo $urlAdd; ?>" class="">add</a>
              </div>
              <table class="table">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <p>Record nod found</p>

                        </td>
                    </tr>
               </table>
             </form>
          </div>
        </div>
    </div>

</div>

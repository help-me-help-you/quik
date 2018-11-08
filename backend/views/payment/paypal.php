<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 05-03-2016
 * Time: 13:20
 */

$this->title = 'Payment Setting';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-8">
        <h3>Payment settings</h3>
    </div>

    <div class="col-lg-4" align="right">
        <h2>
            <a href="<?= \yii\helpers\Url::toRoute('payment/add') ?>" class="btn btn-sm btn-info">Add new</a>

        </h2>

    </div>


    <div class="col-lg-12">
        <hr>
        <div class="list-group">
            <?php
            foreach( $payment as $code) {
                ?>
                <div class="list-group-item">
                    <a href="#" title="status" data-toggle="popover" data-placement="right" data-content="<?= $code['status']; ?>">

                        <?php
                        if($code['status'] == "enable")
                        {
                            echo "<i title='selected' class='fa fa-check-circle'></i> &nbsp;" . $code['name'];
                        }
                        else
                        {
                            echo "<span>&nbsp;&nbsp;&nbsp;</span>;" . $code['name'];

                        }
                        ?>
                    </a>


                    <div style="float: right;display: block">
                        <a title="Edit" href="<?= \yii\helpers\Url::to('index.php?r=payment/edit&id='.$code['id'],false) ?>">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a title="Delete" href="<?= \yii\helpers\Url::toRoute('index.php?r=payment/delete&id='.$code['id'],false) ?>">
                            <span class="fa fa-trash"></span>
                        </a>

                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
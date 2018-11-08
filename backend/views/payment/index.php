<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 05-03-2016
 * Time: 13:20
 */

$this->title = 'Listed paypal Account';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-8 ">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom: 5px;">
                <strong>
                    <i class="fa fa-paypal"></i> Paypal
                </strong>
                <a  href="<?= \yii\helpers\Url::toRoute('payment/add') ?>" class="btn btn-sm btn-info pull-right">Add new</a>

                <div class="clearfix"></div>
            </div>
            <div class="panel-body">

                <?php
                foreach( $payment as $code) {
                    ?>
                    <div class="list-group-item">
                        <a href="#" title="status" data-toggle="popover" data-placement="right" data-content="<?= $code['status']; ?>">

                            <?php
                            if($code['status'] == "enable")
                            {
                                echo "<i title='selected' class='fa fa-check-circle'></i>  " ."&nbsp;". $code['name'];
                            }
                            else
                            {
                                echo "<span>&nbsp;&nbsp;&nbsp;</span>" . $code['name'];

                            }
                            ?>
                        </a>


                        <div style="float: right;display: block">
                            <a title="Edit" href="<?= \yii\helpers\Url::toRoute('payment/edit/'.$code['id'],false) ?>">
                                <span class="fa fa-pencil"></span>
                            </a>
                            <a title="Delete" href="<?= \yii\helpers\Url::toRoute('payment/delete/'.$code['id']) ?><?= $code['id'] ?>">
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

</div>


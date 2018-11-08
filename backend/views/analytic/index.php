<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 05-03-2016
 * Time: 13:20
 */

$this->title = 'Analytic Code Setting';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-8">
        <h3>Analytic Code</h3>
    </div>

    <div class="col-lg-4" align="right">
        <h2>
            <a href="<?= \yii\helpers\Url::toRoute('analytic/add') ?>" class="btn btn-sm btn-info">Add new</a>

        </h2>

    </div>


    <div class="col-lg-12">
        <hr>
        <div class="list-group">
            <?php
            foreach( $analytic as $code) {
                ?>
                <div class="list-group-item">
                    <a href="#" title="status" data-toggle="popover" data-placement="right" data-content="<?= $code['flag']; ?>">
                        <?= $code['name']; ?>
                    </a>


                   <div style="float: right;display: block">
                       <a href="<?= \yii\helpers\Url::to('index.php?r=analytic/edit&id='.$code['id']) ?>">
                           <span class="pe-7s-pen"></span>
                       </a>
                       <a href="<?= \yii\helpers\Url::to('index.php?r=analytic/delete&id='.$code['id']) ?>">
                           <span class="pe-7s-trash"></span>
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
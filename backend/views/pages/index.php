<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 05-03-2016
 * Time: 13:20
 */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-8">
        <h3>All created page</h3>
    </div>

    <div class="col-lg-4" align="right">
        <h2>
            <a href="<?= \yii\helpers\Url::toRoute('pages/add') ?>" class="btn btn-sm btn-info">Add new</a>

        </h2>

    </div>


    <div class="col-lg-12">
        <hr>
        <div class="list-group">
            <?php
            foreach( $pages as $code) {
                ?>
                <div class="list-group-item">
                    <a href="#" title="status" >
                        <?= $code['title']; ?>
                    </a>


                    <div style="float: right;display: block">
                        <a href="<?= \yii\helpers\Url::toRoute('pages/edit?id='.$code['id']) ?>">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('pages/delete?id='.$code['id']) ?>">
                            <span class="fa fa-trash-o"></span>
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
<?php
$this->title = "Currency List";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="header">
                <span class="title" style="font-size: 22px;">List of all currency added by admin</span>
                <a  href="<?= \yii\helpers\Url::toRoute('currency/add') ?>" class="btn btn-info pull-right">
                    New
                </a>
                <hr>
            </div>
            <div class="content">
                <!-- start project list -->
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">currency name</th>
                        <th style="width: 0%">currency Symbol</th>
                        <th>currency value</th>
                        <th>currency initia;</th>
                        <th>status</th>
                        <th style="width: 20%">#Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach($model as $list)
                    {
                        ?>
                        <tr>
                            <td>#</td>
                            <td>
                                <a><?=  $list->currency_name ?></a>
                                <br />
                            </td>
                            <td>
                                <h3>
                                    <i class="<?= $list->currency_symbol; ?>" ></i>
                                </h3>
                            </td>
                            <td>
                                <?=  $list->currency_value ?>
                            </td>
                            <td>
                                <?=  $list->currency_initial ?>
                            </td>

                            <td>
                                <?php
                                if($list->currency_status == 'default')
                                {
                                    ?>
                                    <button type="button" class="btn btn-success btn-xs">
                                        default
                                    </button>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="button" class="btn btn-info btn-xs">
                                        -
                                    </button>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?= \yii\helpers\Url::toRoute('currency/edit') ?>?id=<?= $list->id ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="<?= \yii\helpers\Url::toRoute('currency/delete') ?>?id=<?= $list->id ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                        </tr>
                    <?php

                    }
                    ?>


                    </tbody>
                </table>
                <!-- end project list -->
            </div>
        </div>

    </div>
</div>



<?php
$this->title = 'Ads Management';

?>
<div class="row">



    <div class="col-md-6">

        <div class="card ">
            <div class="header">
                <h4 class="title">All Ads</h4>
                <p class="category">All Ads showing here!!</p>
            </div>
            <div class="content">
                <table class="table">
                    <tr>
                        <th>Approve</th>
                        <th>Ads Title</th>
                        <th>Ads Category</th>
                        <th>Action</th>

                    </tr>
                    <?php
                    foreach($all as $list)
                    {
                        ?>
                        <tr>
                            <td>

                                <?php
                                if($list['active'] == "yes")
                                {
                                    ?>
                                    <span class="label label-success"> Approved</span>
                                <?php
                                }
                                ?>
                                <?php
                                if($list['active'] == "no")
                                {
                                    ?>
                                    <span class="label label-danger"> Rejected</span>
                                <?php
                                }
                                ?>
                                <?php
                                if($list['active'] == "pending")
                                {
                                    ?>
                                    <span class="label label-warning"> Pending</span>
                                <?php
                                }
                                ?>

                            </td>
                            <td>
                                <a href="<?= \yii\helpers\Url::toRoute('ads/view') ?>?id=<?= $list['id']; ?>">
                                    <?= $list['ad_title']; ?>
                                </a>

                            </td>
                            <td><?= $list['category']; ?></td>
                            <td>
                                <a title="Approve" href="<?= \yii\helpers\Url::toRoute('ads/approved?id='.$list['id']) ?>">
                                    <span class="fa fa-check"></span>
                                </a>
                                <a title="Reject" href="<?= \yii\helpers\Url::toRoute('ads/reject?id='.$list['id']) ?>">
                                    <span class="fa fa-trash"></span>
                                </a>

                            </td>
                        </tr>
                    <?php

                    }
                    ?>
                </table>

            </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="card ">
            <div class="header">
                <h4 class="title">All Pending Ads</h4>
                <p class="category">All Pending Ads showing here!!</p>
            </div>
            <div class="content">
                <table class="table">
                    <tr>
                        <th>Approve</th>
                        <th>Ads Title</th>
                        <th>Ads Category</th>
                        <th>Action</th>

                    </tr>
                    <?php
                    foreach($pending as $list)
                    {
                        ?>
                        <tr>
                            <td>

                                <span class="label label-warning"> <?= $list['active']; ?></span>
                            </td>
                            <td>
                                <?= $list['ad_title']; ?>

                            </td>
                            <td><?= $list['category']; ?></td>
                            <td>
                                <a title="Approve" href="<?= \yii\helpers\Url::toRoute('ads/approved?id='.$list['id']) ?>">
                                    <span class="fa fa-check"></span>
                                </a>
                                <a title="Reject" href="<?= \yii\helpers\Url::toRoute('ads/reject?id='.$list['id']) ?>">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    <?php

                    }
                    ?>
                </table>

            </div>
        </div>
    </div>
</div>

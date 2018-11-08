<?php
$this->title = 'User statics';

?>
<div class="row">



    <div class="col-md-12">

        <div class="card ">
            <div class="header">
                <h4 class="title">user statics</h4>
                <p class="category">user/ visitor info</p>
            </div>
            <div class="content">
                <table class="table">
                    <tr>
                        <th>Visitor Agent</th>
                        <th>Visitor Browser</th>
                        <th>Visitor System</th>
                        <th>Visitor iP</th>
                        <th>Visitor City / Country</th>
                        <th>Refer Url</th>
                        <th>Page View</th>

                    </tr>
                    <?php
                    foreach($all as $list)
                    {
                        ?>
                        <tr>

                            <td><?= \common\models\Track::ExactOs($list['agent']) ; ?></td>
                            <td><?= \common\models\Track::ExactBrowserName($list['agent']) ; ?></td>
                            <td> <?= $list['system']; ?></td>
                            <td> <?= $list['ip']; ?></td>
                            <td><?= $list['city']; ?> - <?= $list['country']; ?></td>
                            <td>
                            <a target="_blank" href="<?= $list['ref']; ?>">
                                <?= $list['ref']; ?>
                            </a>
                            </td>
                            <td> <?= $list['page_view']; ?></td>
                        </tr>
                    <?php

                    }
                    ?>
                </table>
                <?php
                // display pagination

                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]);

                ?>
            </div>
        </div>
    </div>

</div>

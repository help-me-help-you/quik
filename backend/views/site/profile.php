<?php
$this->title = "User profile";
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/user/'.$member['image'] ?>" alt="User profile picture">
                <h3 class="profile-username text-center">
                    <?= $member['username'] ?>
                </h3>
                <p class="text-muted text-center">
                    <?= $member['city'] ?>, <?= $member['country'] ?>

                </p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>User Join</b> <a class="pull-right">
                            <?= \common\models\Analytic::time_elapsed_string($member['created_at'] )?> ago
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>total ads</b> <a class="pull-right">
                            <?= count($ads); ?>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>premium ad</b> <a class="pull-right">
                            <?= $premium; ?>
                        </a>
                    </li>
                </ul>

                <a href="#settings" class="btn btn-primary btn-block"><b>Edit</b></a>
            </div><!-- /.box-body -->
        </div><!-- /.box -->


    </div><!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li  class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
                <li><a href="#settings" data-toggle="tab">Edit User</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <li class="time-label">
                        <span class="bg-red">
                          <?= date("d-M-Y",$member['created_at']) ?>
                        </span>
                        </li>
                        <!-- /.timeline-label -->



                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-user bg-aqua"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?= \common\models\Analytic::time_elapsed_string($member['created_at'] )?> ago</span>
                                <h3 class="timeline-header no-border"> <a href="#"><?= $member['username'] ?> </a> create account</h3>
                            </div>
                        </li>
                        <!-- END timeline item -->

                        <?php
                        foreach($ads as $lists)
                        {
                            ?>
                            <li class="time-label">
                                <span class="bg-green">
                                  <?= date("d-M-Y",$lists['created_at']) ?>
                                </span>
                            </li>
                            <!-- /.timeline-label -->

                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-comments bg-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i>
                                        <?= \common\models\Analytic::time_elapsed_string($lists['created_at']) ?>  ago</span>
                                    <h3 class="timeline-header"><a href="#"><?= $member['username'] ?></a> Post a <b><?= $lists['premium'] ?></b> ad</h3>
                                    <div class="timeline-body">
                                        <strong>Ad title</strong> : <?= $lists['ad_title'] ?>
                                        <p>
                                            <strong>Ad description</strong> : <?= $lists['ad_description'] ?>
                                        </p>
                                        <p>
                                            <strong>Ad category</strong> : <?= $lists['category'] ?>
                                        </p>
                                        <p>
                                            <strong>Ad sub_category</strong> : <?= $lists['sub_category'] ?>
                                        </p>
                                        <p>
                                            <strong>Ad type</strong> : <?= $lists['type'] ?>
                                        </p>
                                        <p>
                                            <strong>Price</strong> : $<?= $lists['price'] ?>
                                        </p>

                                    </div>

                                </div>
                            </li>
                            <!-- END timeline item -->

                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i>
                                        <?= \common\models\Analytic::time_elapsed_string($lists['created_at']) ?>
                                        ago</span>
                                    <h3 class="timeline-header"><a href="#"><?= $member['username'] ?></a> uploaded new photos for ad</h3>
                                    <div class="timeline-body">
                                        <?php
                                        $image = $lists->image;
                                        $imgChunck = explode(",",$image);

                                        foreach($imgChunck as $arr => $img)
                                        {
                                            ?>
                                            <img style="width: 20%;" src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/products/'.$img ?>" class="margin">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->

                        <?php
                        }
                        ?>
                        <!-- timeline time label -->


                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="settings">

                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'layout' => 'horizontal',]); ?>

                    <?= $form->field($member, 'email') ?>

                    <?= $form->field($member, 'name')->label('Country name') ?>

                    <?= $form->field($member, 'city') ?>

                    <?= $form->field($member, 'state') ?>

                    <?= $form->field($member, 'country') ?>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <?= Html::submitButton('save', ['class' => 'btn btn-danger', 'name' => 'country-button']) ?>

                        </div>
                    </div>


                    <?php ActiveForm::end(); ?>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
</div><!-- /.row -->
<?php
$this->title = "Select States";
?>

<div role="main" class="ui-content">
    <h6 class="ui-bar ui-bar-a ui-corner-all">
        Choose States of <img src="<?= Yii::getAlias('@web').'/images/country-flags/'.$country->sortname.".png"; ?>"> <?= $country['name'] ?>
    </h6>
    <hr>
    <div class="col-lg-12 white" style="padding: 10px;">
        <?php
        echo "<div class='col-lg-2 setState'>";
        foreach($model as $k=> $state)
        {
            if ($k == "0")
            {
                $k  = 1;

            }

            // echo $k."<br>";
            $url = \yii\helpers\Url::toRoute('location/citiesm')."?id=".$state['id']."&countryId=".$country->id;
            echo "<a data-ajax='false' href='".$url."' title='".$state['name']."'><span>".substr($state['name'],0,15)."</span></a><br>";
            // echo $k."<br>";
            if ($k % 10 == 0)
            {
                echo "</div>";
                echo "<div class='col-lg-2 setState'>";

            }
            //

        }
        ?>
    </div>
</div>
</div>
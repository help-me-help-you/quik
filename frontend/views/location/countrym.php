<?php
$this->title = "Select Country";
?>
<div role="main" class="ui-content">
    <h6 class="ui-bar ui-bar-a ui-corner-all">
        Select Country
    </h6>
    <hr>
    <div class="col-lg-12 white" style="padding: 10px;">
        <?php
        echo "<div class='col-lg-2 setCountryFlag'>";
        foreach($model as $k=> $country)
        {
            if ($k == "0")
            {
                $k  = 1;

            }

           // echo $k."<br>";
            $ImgUrl = Yii::getAlias('@web').'/images/country-flags/'.$country['sortname'].".png";
            $url = \yii\helpers\Url::toRoute('location/statesm')."?id=".$country['id'];
            echo "<a data-ajax='false' href='".$url."' title='".$country['name']."'><img src='$ImgUrl' width='15px'><span>".substr($country['name'],0,15)."</span></a><br>";
          // echo $k."<br>";
            if ($k % 24 == 0)
            {
                echo "</div>";
                echo "<div class='col-lg-2 setCountryFlag'>";

            }
            //

        }
        ?>
        </div>
    </div>
</div>
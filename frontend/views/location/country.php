<?php
$this->title = "Select Country";
?>

<div class="row">
    <div class="col-lg-12">
        <h2>
            Choose Country World Wide
        </h2>
    </div>

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
            $url = \yii\helpers\Url::toRoute('location/states')."?id=".$country['id'];
            echo "<a href='".$url."' title='".$country['name']."'><img src='$ImgUrl' width='15px'><span>".substr($country['name'],0,15)."</span></a><br>";
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
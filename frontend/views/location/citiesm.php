<?php
$this->title = "Select City";
?>

<div role="main" class="ui-content">
    <h6 class="ui-bar ui-bar-a ui-corner-all">
        <img src="<?= Yii::getAlias('@web').'/images/country-flags/'.$country->sortname.".png"; ?>">
        <?= $country['name'] ?>
        <i class="fa fa-angle-right"></i>
        <?= $state['name'] ?>
        <i class="fa fa-angle-right"></i>
        city <?=  \yii\helpers\Url::previous('currency_p'); ?>    </h6>
    <hr>

    <div class="col-lg-12 white" style="padding: 10px;">
        <?php
        echo "<div class='col-lg-2 setState'>";
        foreach($model as $k=> $city)
        {
            if ($k == "0")
            {
                $k  = 1;

            }

            // echo $k."<br>";
            $url = \yii\helpers\Url::toRoute('ads/scity')."?param=".$city['name'];
            ?>
            <a data-method="post" onclick="setcity('<?= $city['name']; ?>')" href="<?= $url; ?>" >
                <i class='fa fa-angle-right'></i>
                <span>
                    <?= $city['name']; ?>
                </span>
            </a>
            <br>
            <?php
           // echo "<a href='".$url."' title='".$city['name']."'> <span> ".substr($city['name'],0,15)."</span></a><br>";
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

<script>

    document.getElementById("citydefault").innerHTML = localStorage.getItem("setcity");
    var url = "<?= \yii\helpers\Url::toRoute('ads/scity?param=') ?>";
    function setcity(city)
    {
        // alert(city);
        var imgUrl = "<?= $ImgUrl = Yii::getAlias('@web').'/images/country-flags/'.$country['sortname'].".png"?>";
        // Check browser support
        if (typeof(Storage) !== "undefined")
        {
//            var requests = {reqId2 : reqObj, reqId2 : reqObj};
//            localStorage.setItem("ajax_requests", JSON.stringify(requests));
            // Store
            localStorage.setItem("setcity", city);
            localStorage.setItem("countryFlag", imgUrl);

            // Retrieve
            $('#countryFlag').attr('src',localStorage.getItem("countryFlag"));
            document.getElementById("citydefault").innerHTML = localStorage.getItem("setcity");
        }
        else {
            alert("Sorry, your browser does not support Web Storage...");
        }

//        $.post(url+city, function(data, status){
//            alert(data + "\nStatus: " + status);
//        });

    }
</script>
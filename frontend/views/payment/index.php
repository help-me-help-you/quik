<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 17-03-2016
 * Time: 14:58
 */

$notifyUrl = $rerunUrl;
?>
<style type="text/css">
    <!--
    .style1 {
        font-size: 14px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }
    -->
</style>
<form name="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?= $paypalAddress;?>">
    <input type="hidden" name="item_name" value="Deposit into <?= $item_name; ?>">
    <input type="hidden" name="amount" value="<?= $amount; ?>">
    <input type="hidden" name="custom" value="<?= $type; ?>">
    <input type="hidden" name="return" value="<?= $rerunUrl ?>">
    <input type="hidden" name="notify_url" value="<?= $notifyUrl; ?>">
    <input type="hidden" name="currency_code" value="USD">
</form>
<div class="container">
    <div class="row">
        <div class="col-lg-12" align="center">
            <br><br><br><br><br><br><br><br>
            <h3 style="font-family: roboto-bold;color:#999">
                Secure Payment WIth
            </h3>
            <br>
            <p>
                <img src="<?= Yii::getAlias('@web') ?>/images/site/paypal.png" class="img-responsive" width="250px;">
            </p>
            <div align="center" style="padding: 150px;padding-top: 50px;display: block;position: relative">
                Transfering you to the Paypal.com Secure payment system, if you are not forwarded
                <a href="javascript:document.paypal.submit();">click here</a>
            </div>
        </div>
    </div>
</div>
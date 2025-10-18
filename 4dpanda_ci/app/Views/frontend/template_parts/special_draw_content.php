<?php
if(!isset($results['option_value'])) return;
$dates = explode(";", $results['option_value']);
//var_dump($dates);

?>
<div class="col-xs-12 gn_aac_1" style="padding-top:10px;">
    <div class="resultsh3">
        <?php if(isset($h1)):?>
            <?php echo $h1['option_value'];?>
        <?php else:?>
            <h1>Special Draw Dates: 4D Tuesday Draw </h1>
        <?php endif;?>
    </div>
</div>
<div class="col-xs-12 gn_aac_1">
    <?php foreach ($dates as $date):?>
        <div style="margin-bottom: 1rem;" class="text-center">
            <h4><?php echo date("d-M-Y (D)",strtotime($date));?></h4>
            <img src="/assets/images/logo_magnum.gif" alt="magnum" width="35px" height="30px">
            <img src="/assets/images/logo_damacai.gif" alt="damacai" width="35px" height="30px">
            <img src="/assets/images/logo_toto.gif" alt="toto" width="35px" height="30px">
            <img src="/assets/images/logo_sabah88.gif" alt="sabah88" width="35px" height="30px">
            <img src="/assets/images/logo_sarawak.png" alt="sarawak" width="35px" height="30px">
            <img src="/assets/images/logo_stc4d.gif" alt="sandakan" width="35px" height="30px">
        </div>
    <?php endforeach;?>
</div>
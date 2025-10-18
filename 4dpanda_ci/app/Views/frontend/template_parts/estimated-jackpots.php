<?php if(!isset($results)) return;
$data = json_decode($results);
?>
<div class="col-xs-12 gn_aac_1">
        <div class="col-md-12 col-xs-12" style="margin-top: 20px; padding:0;">
            <?php if(isset($h1)):?>
                <div class="resultsh3"><?php echo $h1['option_value'];?></div>
            <?php endif;?>
            <div class="col-xs-12" style="font-size: 16px; padding-top:5px; padding-bottom:5px; font-weight:700; background-color:#444; color:#fff; vertical-align: middle;">
                <img style="vertical-align: middle; padding-right:10px; height:32px;" src="/assets/images/logo_toto.gif">Toto Estimated Jackpots
            </div>
            <div class="col-xs-12" style="padding-top:5px; padding-bottom:5px;">
                <table class="ui-responsive table-stroke" style="line-height:1.5;">
                    <tbody>
                        <tr><td style="font-size:15px;width:165px">4D Jackpot 1</td><td style="font-size:15px;color:red;"><b><?php removeAfterDot($data->TT->ESTJP1);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">4D Jackpot 2</td><td style="font-size:15px;color:red;"><b><?php removeAfterDot($data->TT->ESTJP2);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">Star 6/50 Jackpot 1</td><td style="font-size:15px;color:red;"><b><?php removeAfterDot($data->TT->ESTP650JP1);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">Star 6/50 Jackpot 2</td><td style="font-size:15px;color:red;"><b><?php removeAfterDot($data->TT->ESTP650JP2);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">Power 6/55 Jackpot</td><td style="font-size:15px;color:red;"><b><?php removeAfterDot($data->TT->ESTP655);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">Supreme 6/58 Jackpot</td><td style="font-size:15px;color:red;"><b><?php removeAfterDot($data->TT->ESTP658);?></b></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12" style="font-size: 16px; padding-top:5px; padding-bottom:5px; font-weight:700; background-color:#444; color:#fff; vertical-align: middle; margin:auto;">
                <img style="vertical-align: middle; padding-right:10px; height:32px;" src="/assets/images/logo_magnum.gif">Magnum Estimated Jackpots
            </div>
            <div class="col-xs-12" style="padding-top:5px; padding-bottom:5px;">
                <table class="ui-responsive table-stroke" style="line-height:1.5;">
                    <tbody>
                        <tr><td style="font-size:15px;width:165px">4D Jackpot 1</td><td style="font-size:15px;color:#800080;"><b><?php removeAfterDot($data->M4D->ESTJP1);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">4D Jackpot 2</td><td style="font-size:15px;color:#800080;"><b><?php removeAfterDot($data->M4D->ESTJP2);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">4D Gold Jackpot 1</td><td style="font-size:15px;color:#800080;"><b><?php removeAfterDot($data->M4D->ESTGJP1);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">4D Gold Jackpot 2</td><td style="font-size:15px;color:#800080;"><b><?php removeAfterDot($data->M4D->ESTGJP2);?></b></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12" style="font-size: 16px; padding-top:5px; padding-bottom:5px; font-weight:700; background-color:#444; color:#fff; vertical-align: middle;">
                <img style="vertical-align: middle; padding-right:10px; height:32px;" src="/assets/images/logo_damacai.gif">Damacai Estimated Jackpots
            </div>
            <div class="col-xs-12" style="padding-top:5px; padding-bottom:5px;">
                <table class="ui-responsive table-stroke" style="line-height:1.5;">
                    <tbody>
                        <tr><td style="font-size:15px;width:165px">1+3D Jackpot 1</td><td style="font-size:15px;color:blue;"><b><?php removeAfterDot($data->DMC4D->EJP1);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">1+3D Jackpot 2</td><td style="font-size:15px;color:blue;"><b><?php removeAfterDot($data->DMC4D->EJP2);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">3D Jackpot</td><td style="font-size:15px;color:blue;"><b><?php removeAfterDot($data->DMC4D->EJP3);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">3+3D Jackpot 1</td><td style="font-size:15px;color:blue;"><b><?php removeAfterDot($data->DMC6D->EJ61);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">3+3D Jackpot 2</td><td style="font-size:15px;color:blue;"><b><?php removeAfterDot($data->DMC6D->EJ62);?></b></td></tr>
                        <tr><td style="font-size:15px;width:165px">3+3D Jackpot 3</td><td style="font-size:15px;color:blue;"><b><?php removeAfterDot($data->DMC6D->EJ63);?></b></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php 
    function removeAfterDot($p){
        $data = trim(str_replace("RM","",$p));
        $data = explode(".", $data);
        //var_dump($data); 
        if(isset($data[1]) && $data[1] == '00')
            echo "RM ". $data[0];
        else if(isset($data[1])) 
            echo "RM ".$data[0].'.'.$data[1];
        else
            echo "RM ".$data[0];
    }
    ?>
<?php 
if(!isset($past_results)) return;
foreach ($past_results as $past_result):

$data = json_decode($past_result);
if(!isset($data->M4D)&&!isset($data->DMC4D)&&!isset($data->TT)) continue;
//var_dump($data);exit();
?>
        <div class="malaysia-content">          
            <div class="col-xs-12 gn_aac_1">
                <a class="anchor" id="section-wm"></a>
                <div class="col-xs-12 resultprizelable  section-header">
                    <span>
                     <h2>Past <?= isset($headings['heading_1'])?strip_tags($headings['heading_1']):'Malaysia 4D Results';?>: <?php echo date("d-m-Y (D)", strtotime($data->date));?></h2>
                    </span>
                </div>
            </div>
            <?php if(isset($data->M4D)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2">
                <div class="result outerbox magnum">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultm4dlable" style="width:20%"><img src="/assets/images/logo_magnum.gif"
                                        width="50" height="38" alt="Magnum 4D"></td>
                                <td class="resultm4dlable">Magnum 4D 萬能</td>
                                <td class="resultm4dlable">
                                    <span id="mlive" class="live-icon" style="display:none;">
                                        <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" title="Live Draw"></i>
                                        <span>Live</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2 headname">
                        <tbody>
                            <tr>
                                <td class="resultdrawdate" id="mdd"><?=$data->M4D->DD?></td>
                                <td class="resultdrawdate" id="mdn" style="text-align:right"><?=$data->M4D->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td style="width:33%" class="resultprizelable separator">1st Prize <br> 首獎</td>
                                <td style="width:33%" class="resultprizelable separator">2nd Prize <br> 二獎</td>
                                <td style="width:33%" class="resultprizelable">3rd Prize <br> 三獎</td>
                            </tr>
                            <tr>
                                <td class="resultviewtop separator" id="mp1"><?=$data->M4D->P1?></td>
                                <td class="resultviewtop separator" id="mp2"><?=$data->M4D->P2?></td>
                                <td class="resultviewtop" id="mp3"><?=$data->M4D->P3?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tobdy>
                            <tr>
                                <td class="separator" style="width:50%;">
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Special 特別獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ms1"><?=$data->M4D->S1?></td>
                                                <td class="resultviewbottom" id="ms2"><?=$data->M4D->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ms3"><?=$data->M4D->S3?></td>
                                                <td class="resultviewbottom" id="ms4"><?=$data->M4D->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ms5"><?=$data->M4D->S5?></td>
                                                <td class="resultviewbottom" id="ms6"><?=$data->M4D->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ms7"><?=$data->M4D->S7?></td>
                                                <td class="resultviewbottom" id="ms8"><?=$data->M4D->S8?></td>
                                            </tr>
                                                <td class="resultviewbottom" id="ms9"><?=$data->M4D->S9?></td>
                                                <td class="resultviewbottom" id="ms10"><?=$data->M4D->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ms11"><?=$data->M4D->S11?></td>
                                                <td class="resultviewbottom" id="ms12"><?=$data->M4D->S12?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="resultviewbottom" id="ms13"><?=$data->M4D->S13?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Consolation 安慰獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mc1"><?=$data->M4D->C1?></td>
                                                <td class="resultviewbottom" id="mc2"><?=$data->M4D->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mc3"><?=$data->M4D->C3?></td>
                                                <td class="resultviewbottom" id="mc4"><?=$data->M4D->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mc5"><?=$data->M4D->C5?></td>
                                                <td class="resultviewbottom" id="mc6"><?=$data->M4D->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mc7"><?=$data->M4D->C7?></td>
                                                <td class="resultviewbottom" id="mc8"><?=$data->M4D->C8?></td>
                                            </tr>
                                            <tr>    
                                                <td class="resultviewbottom" id="mc9"><?=$data->M4D->C9?></td>
                                                <td class="resultviewbottom" id="mc10"><?=$data->M4D->C10?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="resultviewbottom">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="resultviewbottom">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2" style="display:none;">
                        <tbody>
                            <tr>
                                <td style="width:50%" class="resultprizelable">4D Jackpot 1 Prize</td>
                                <td style="width:50%" class="resultprizelable">4D Jackpot 2 Prize</td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable"><b id="mjp1"><?=$data->M4D->JP1?></b><br><span class="blink"
                                        id="mjp1won"><?=($data->M4D->JP1WON >=1)?"Won": "Partially Won";?></span></td>
                                <td class="result5dprizelable"><b id="mjp2"><?=$data->M4D->JP2?></b><br><span class="blink"
                                        id="mjp2won"><?=($data->M4D->JP2WON >=1)?"Won": "Partially Won";?></span></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2" style="display:none;">
                        <tbody>
                            <tr>
                                <td colspan="2" class="estjpamtlable">Next Draw Estimated Amount</td>
                            </tr>
                            <tr>
                                <td style="width:50%" class="resultprizelable">4D Jackpot 1 Prize</td>
                                <td style="width:50%" class="resultprizelable">4D Jackpot 2 Prize</td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable"><b id="mestjp1"><?=$data->M4D->ESTJP1?></b></td>
                                <td class="result5dprizelable"><b id="mestjp2"><?=$data->M4D->ESTJP2?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->DMC4D)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_3">
                <div class="result outerbox damacai">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultdamacailable" style="width:20%">
                                    <img src="/assets/images/logo_damacai.gif" width="50" height="38" alt="Damacai"></td>
                                <td class="resultdamacailable">Da Ma Cai 1+3D 大馬彩</td>
                                <td class="resultdamacailable">
                                    <span id="dlive" class="live-icon" style="display:none;">
                                        <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" title="Live Draw"></i>
                                        <span>Live</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2 headname">
                        <tbody>
                            <tr>
                                <td class="resultdrawdate" id="ddd"><?=$data->DMC4D->DD?></td>
                                <td class="resultdrawdate" id="ddn" style="text-align:right"><?=$data->DMC4D->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td style="width:33%" class="resultprizelable separator">1st Prize <br> 首獎</td>
                                <td style="width:33%" class="resultprizelable separator">2nd Prize <br> 二獎</td>
                                <td style="width:33%" class="resultprizelable">3rd Prize <br> 三獎</td>
                            </tr>
                            <tr>
                                <td class="resultviewtop separator" id="dp1"><?=$data->DMC4D->P1?></td>
                                <td class="resultviewtop separator" id="dp2"><?=$data->DMC4D->P2?></td>
                                <td class="resultviewtop" id="dp3"><?=$data->DMC4D->P3?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="separator" style="width:50%;">
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Special 特別獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ds1"><?=$data->DMC4D->S1?></td>
                                                <td class="resultviewbottom" id="ds2"><?=$data->DMC4D->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ds3"><?=$data->DMC4D->S3?></td>
                                                <td class="resultviewbottom" id="ds4"><?=$data->DMC4D->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ds5"><?=$data->DMC4D->S5?></td>
                                                <td class="resultviewbottom" id="ds6"><?=$data->DMC4D->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ds7"><?=$data->DMC4D->S7?></td>
                                                <td class="resultviewbottom" id="ds8"><?=$data->DMC4D->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ds9"><?=$data->DMC4D->S9?></td>
                                                <td class="resultviewbottom" id="ds10"><?=$data->DMC4D->S10?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="resultviewbottom">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="resultviewbottom">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Consolation 安慰獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="dc1"><?=$data->DMC4D->C1?></td>
                                                <td class="resultviewbottom" id="dc2"><?=$data->DMC4D->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="dc3"><?=$data->DMC4D->C3?></td>
                                                <td class="resultviewbottom" id="dc4"><?=$data->DMC4D->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="dc5"><?=$data->DMC4D->C5?></td>
                                                <td class="resultviewbottom" id="dc6"><?=$data->DMC4D->C6?></td>
                                            </tr> 
                                            <tr>
                                                <td class="resultviewbottom" id="dc7"><?=$data->DMC4D->C7?></td>
                                                <td class="resultviewbottom" id="dc8"><?=$data->DMC4D->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="dc9"><?=$data->DMC4D->C9?></td>
                                                <td class="resultviewbottom" id="dc10"><?=$data->DMC4D->C10?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="resultviewbottom">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="resultviewbottom">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->TT)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_4">
                <div class="result outerbox toto">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resulttotolable" style="width:20%"><img src="/assets/images/logo_toto.gif"
                                        width="50" height="38" alt="Sport Toto"></td>
                                <td class="resulttotolable">SportsToto 4D 多多</td>
                                <td class="resulttotolable">
                                    <span id="tlive" class="live-icon" style="display:none;">
                                        <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" title="Live Draw"></i>
                                        <span>Live</span>
                                    </span>    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2 headname">
                        <tbody>
                            <tr>
                                <td class="resultdrawdate" id="tdd"><?=$data->TT->DD?></td>
                                <td class="resultdrawdate" id="tdn" style="text-align:right"><?=$data->TT->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td style="width:33%" class="resultprizelable separator">1st Prize <br> 首獎</td>
                                <td style="width:33%" class="resultprizelable separator">2nd Prize <br> 二獎</td>
                                <td style="width:33%" class="resultprizelable">3rd Prize <br> 三獎</td>
                            </tr>
                            <tr>
                                <td class="resultviewtop separator" id="tp1"><?=$data->TT->P1?></td>
                                <td class="resultviewtop separator" id="tp2"><?=$data->TT->P2?></td>
                                <td class="resultviewtop" id="tp3"><?=$data->TT->P3?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2" style="height:222px;">
                        <tbody>
                            <tr>
                                <td class="separator" style="width:50%;">
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Special 特別獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ts1"><?=$data->TT->S1?></td>
                                                <td class="resultviewbottom" id="ts2"><?=$data->TT->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ts3"><?=$data->TT->S3?></td>
                                                <td class="resultviewbottom" id="ts4"><?=$data->TT->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ts5"><?=$data->TT->S5?></td>
                                                <td class="resultviewbottom" id="ts6"><?=$data->TT->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ts7"><?=$data->TT->S7?></td>
                                                <td class="resultviewbottom" id="ts8"><?=$data->TT->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ts9"><?=$data->TT->S9?></td>
                                                <td class="resultviewbottom" id="ts10"><?=$data->TT->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ts11"><?=$data->TT->S11?></td>
                                                <td class="resultviewbottom" id="ts12"><?=$data->TT->S12?></td>
                                            </tr>
                                                <td colspan="2" class="resultviewbottom" id="ts13"><?=$data->TT->S13?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Consolation 安慰獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="tc1"><?=$data->TT->C1?></td>
                                                <td class="resultviewbottom" id="tc2"><?=$data->TT->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="tc3"><?=$data->TT->C3?></td>
                                                <td class="resultviewbottom" id="tc4"><?=$data->TT->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="tc5"><?=$data->TT->C5?></td>
                                                <td class="resultviewbottom" id="tc6"><?=$data->TT->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="tc7"><?=$data->TT->C7?></td>
                                                <td class="resultviewbottom" id="tc8"><?=$data->TT->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="tc9"><?=$data->TT->C9?></td>
                                                <td class="resultviewbottom" id="tc10"><?=$data->TT->C10?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="resultView2" style="margin-top:8px; margin-bottom:-1px; border-top:1px solid #e00a15; ">
                                        <tbody>
                                            <tr>
                                                <td style="writing-mode: vertical-rl;font-size:12px; color:white; background:#e00a15; height:48px; font-weight:bold;" class="separator">ZODIAC</td>
                                                <td id="tzodiac" style="height:48px;"><?php if($data->TT->ZODIAC!="images/zodiac/.png"):?><img src="<?= base_url($data->TT->ZODIAC);?>" style="width:43px;" alt="Zodiac"/><?php endif;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2" style="display:none;">
                        <tbody>
                            <tr>
                                <td style="width:50%" class="resultprizelable">4D Jackpot 1 Prize</td>
                                <td style="width:50%" class="resultprizelable">4D Jackpot 2 Prize</td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable"><b id="tjp1"><?=$data->TT->JP1?></b><br>
                                    <span class="blink" id="tjp1won">
                                        <?php if($data->TT->JP1WON>=1)
                                                echo "Won";
                                            else if($data->TT->JP1WON>0)
                                                echo "Partially Won";
                                            else    echo "";
                                            ?>
                                    </span></td>
                                <td class="result5dprizelable"><b id="tjp2"><?=$data->TT->JP2?></b><br><span class="blink"
                                        id="tjp2won">
                                        <?php if($data->TT->JP2WON>=1)
                                                echo "Won";
                                            else if($data->TT->JP2WON>0)
                                                echo "Partially Won";
                                            else    echo "";
                                            ?>
                                    </span></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2" style="display:none;">
                        <tbody>
                            <tr>
                                <td colspan="2" class="estjpamtlable">Next Draw Estimated Amount</td>
                            </tr>
                            <tr>
                                <td style="width:50%" class="resultprizelable">4D Jackpot 1 Prize</td>
                                <td style="width:50%" class="resultprizelable">4D Jackpot 2 Prize</td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable"><b id="testjp1"><?=$data->TT->ESTJP1;?></b></td>
                                <td class="result5dprizelable"><b id="testjp2"><?=$data->TT->ESTJP2;?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_9">
            <?php if(isset($data->DMC6D)):?>
                <div class="outerbox damacai">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultdamacailable" style="width:20%"><img src="/assets/images/logo_damacai.gif"
                                        width="50" height="38" alt="Damacai"></td>
                                <td class="resultdamacailable">Da Ma Cai 3+3D 大馬彩</td>
                                <td class="resultdamacailable">
                                    <span id="d3live" class="live-icon" style="display:none;">
                                        <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" title="Live Draw"></i>
                                        <span>Live</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2 headname">
                        <tbody>
                            <tr>
                                <td class="resultdrawdate" id="d3dd"><?=$data->DMC6D->DD?></td>
                                <td class="resultdrawdate" id="d3dn" style="text-align:right"><?=$data->DMC6D->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td style="width:33%" class="resultprizelable separator">1st Prize <br> 首獎</td>
                                <td style="width:33%" class="resultprizelable separator">2nd Prize <br> 二獎</td>
                                <td style="width:33%" class="resultprizelable">3rd Prize <br> 三獎</td>
                            </tr>
                            <tr>
                                <td class="resultviewtop separator" id="d3p1"><?=$data->DMC6D->P1?></td>
                                <td class="resultviewtop separator" id="d3p2"><?=$data->DMC6D->P2?></td>
                                <td class="resultviewtop" id="d3p3"><?=$data->DMC6D->P3?></td>
                            </tr>
                            <tr>
                                <td class="separator" id="d3p1zodiac" style="background:red; color:white; padding-top:5px; padding-bottom:5px;"><?=$data->DMC6D->P1B?></td>
                                <td class="separator" id="d3p2zodiac" style="background:red; color:white; padding-top:5px; padding-bottom:5px;"><?=$data->DMC6D->P2B?></td>
                                <td class="" id="d3p3zodiac" style="background:red; color:white; padding-top:5px; padding-bottom:5px;"><?=$data->DMC6D->P3B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable separator">Bonus 1</td>
                                <td class="result5dprizelable separator">Bonus 2</td>
                                <td class="result5dprizelable">Bonus 3</td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable separator">
                                    <b id="d3jp1"><?=$data->DMC6D->J61?></b>
                                        <span class="blink" id="d3jp1won">
                                            <?php 
                                            if($data->DMC6D->J61WON == 1)
                                                echo "Won";
                                            else if($data->DMC6D->J61WON == 2)
                                                echo "Partially Won";
                                            else   
                                                echo "";
                                            ?>
                                        </span></td>
                                <td class="result5dprizelable separator">
                                    <b id="d3jp2"><?=$data->DMC6D->J62?></b>
                                    <span class="blink" id="d3jp2won">
                                        <?php 
                                            if($data->DMC6D->J62WON == 1)
                                                echo "Won";
                                            else if($data->DMC6D->J62WON == 2)
                                                echo "Partially Won";
                                            else   
                                                echo "";
                                            ?>
                                        </span></td>
                                <td class="result5dprizelable">
                                    <b id="d3jp3"><?=$data->DMC6D->J63?></b>
                                    <span class="blink" id="d3jp3won">
                                    <?php 
                                    if($data->DMC6D->J63WON == 1)
                                        echo "Won";
                                        else if($data->DMC6D->J63WON == 2)
                                            echo "Partially Won";
                                        else   
                                            echo "";
                                        ?>
                                    </span>
                                </td>       
                            </tr>
                            <!--<tr>
                                <td class="resultviewbottomtoto2" id="d3p3b"
                                    style="color: #fff;font-size:16px;background-color: #cc0000"><?=$data->DMC6D->P3B?></td>
                            </tr>-->
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="separator" style="width:50%;">
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Special 特別獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="d3s1"><?=$data->DMC6D->S1?></td>
                                                <td class="resultviewbottom" id="d3s2"><?=$data->DMC6D->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="d3s3"><?=$data->DMC6D->S3?></td>
                                                <td class="resultviewbottom" id="d3s4"><?=$data->DMC6D->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="d3s5"><?=$data->DMC6D->S5?></td>
                                                <td class="resultviewbottom" id="d3s6"><?=$data->DMC6D->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="d3s7"><?=$data->DMC6D->S7?></td>
                                                <td class="resultviewbottom" id="d3s8"><?=$data->DMC6D->S8?></td>
                                            </tr> 
                                                <td class="resultviewbottom" id="d3s9"><?=$data->DMC6D->S9?></td>
                                                <td class="resultviewbottom" id="d3s10"><?=$data->DMC6D->S10?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Consolation 安慰獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="d3c1"><?=$data->DMC6D->C1?></td>
                                                <td class="resultviewbottom" id="d3c2"><?=$data->DMC6D->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="d3c3"><?=$data->DMC6D->C3?></td>                         
                                                <td class="resultviewbottom" id="d3c4"><?=$data->DMC6D->C4?></td>
                                            </tr>
                                                <td class="resultviewbottom" id="d3c5"><?=$data->DMC6D->C5?></td>
                                                <td class="resultviewbottom" id="d3c6"><?=$data->DMC6D->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="d3c7"><?=$data->DMC6D->C7?></td>
                                                <td class="resultviewbottom" id="d3c8"><?=$data->DMC6D->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="d3c9"><?=$data->DMC6D->C9?></td>
                                                <td class="resultviewbottom" id="d3c10"><?=$data->DMC6D->C10?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif;?>
            <?php if(isset($data->M4D)):?>
                <div class="result outerbox magnum">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td style="height:74px;">
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="outerbox magnum">
                    <table class="resultTable" align="center">
                        <tbody>
                            <tr>
                                <td colspan="8">
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td class="resultm4dlable" style="width:20%"><img
                                                        src="/assets/images/logo_magnum.gif" width="50" height="38" alt="Magnum"></td>
                                                <td class="resultm4dlable">Magnum Life<br>万能天天彩</td>
                                                <td class="resultm4dlable">
                                                        <span id="mllive" class="live-icon" style="display:none;">
                                                            <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" title="Live Draw"></i>
                                                            <span>Live</span>
                                                        </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <table class="resultView2 headname">
                                        <tbody>
                                            <tr>
                                                <td class="resultdrawdate" id="mpbdd"><?=$data->M4D->DD?></td>
                                                <td class="resultdrawdate" id="mpbdn" style="text-align:right"><?=$data->M4D->DN?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="resultprizelable">Winning Numbers</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="ml1"><?=$data->M4D->L1?></td>
                                <td class="resultviewbottomtoto2" id="ml2"><?=$data->M4D->L2?></td>
                                <td class="resultviewbottomtoto2" id="ml3"><?=$data->M4D->L3?></td>
                                <td class="resultviewbottomtoto2" id="ml4"><?=$data->M4D->L4?></td>
                                <td class="resultviewbottomtoto2" id="ml5"><?=$data->M4D->L5?></td>
                                <td class="resultviewbottomtoto2" id="ml6"><?=$data->M4D->L6?></td>
                                <td class="resultviewbottomtoto2" id="ml7"><?=$data->M4D->L7?></td>
                                <td class="resultviewbottomtoto2" id="ml8"><?=$data->M4D->L8?></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="resultprizelable">Bonus Numbers</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="resultviewbottomtoto2" id="mlb1"><?=$data->M4D->LB1?></td>
                                <td colspan="4" class="resultviewbottomtoto2" id="mlb2"><?=$data->M4D->LB2?></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="resultprizelable">Grand Prize</td>
                            </tr>
                            <tr>
                                <td colspan="8" class="result5dprizelable">RM 1,000 everyday for 20 years </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="resultprizelable">2nd Prize</td>
                            </tr>
                            <tr>
                                <td colspan="8" class="result5dprizelable">RM 1,000 everyday for 100 days</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif;?>
            </div>
            <?php if(isset($data->TT)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_8"> 
                <div class="outerbox toto">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resulttotolable" style="width:20%"><img src="/assets/images/logo_toto.gif"
                                        width="50" height="38" alt="Sport Toto"></td>
                                <td class="resulttotolable">SportsToto 5D, 6D<br>多多六合彩</td>
                                <td class="resulttotolable">
                                    <span id="ttlive" class="live-icon" style="display:none;">
                                        <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" title="Live Draw"></i>
                                        <span>Live</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2 headname">
                        <tbody>
                            <tr>
                                <td class="resultdrawdate" id="ttdd"><?=$data->TT->DD?></td>
                                <td class="resultdrawdate" id="ttdn" style="text-align:right"><?=$data->TT->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td colspan="5" class="resultprizelable">5D</td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">1st</td>
                                <td class="resultviewbottom" id="tt5d1"><?=$data->TT->P5D1?></td>
                                <td class="result5dprizelable">4th</td>
                                <td class="resultviewbottom" id="tt5d4"><?=$data->TT->P5D4?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">2nd</td>
                                <td class="resultviewbottom" id="tt5d2"><?=$data->TT->P5D2?></td>
                                <td class="result5dprizelable">5th</td>
                                <td class="resultviewbottom" id="tt5d5"><?=$data->TT->P5D5?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">3rd</td>
                                <td class="resultviewbottom" id="tt5d3"><?=$data->TT->P5D3?></td>
                                <td class="result5dprizelable">6th</td>
                                <td class="resultviewbottom" id="tt5d6"><?=$data->TT->P5D6?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td colspan="5" class="resultprizelable">6D</td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">1st</td>
                                <td colspan="3" class="resultviewbottom" id="tt6d1"><?=$data->TT->P6D1?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">2nd</td>
                                <td class="resultviewbottom" id="tt6d2a"><?=$data->TT->P6D2A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="tt6d2b"><?=$data->TT->P6D2B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">3rd</td>
                                <td class="resultviewbottom" id="tt6d3a"><?=$data->TT->P6D3A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="tt6d3b"><?=$data->TT->P6D3B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">4th</td>
                                <td class="resultviewbottom" id="tt6d4a"><?=$data->TT->P6D4A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="tt6d4b"><?=$data->TT->P6D4B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">5th</td>
                                <td class="resultviewbottom" id="tt6d5a"><?=$data->TT->P6D5A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="tt6d5b"><?=$data->TT->P6D5B?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td colspan="8" class="resultprizelable">Star Toto 6/50</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="tt6501"><?=$data->TT->P6501?></td>
                                <td class="resultviewbottomtoto2" id="tt6502"><?=$data->TT->P6502?></td>
                                <td class="resultviewbottomtoto2" id="tt6503"><?=$data->TT->P6503?></td>
                                <td class="resultviewbottomtoto2" id="tt6504"><?=$data->TT->P6504?></td>
                                <td class="resultviewbottomtoto2" id="tt6505"><?=$data->TT->P6505?></td>
                                <td class="resultviewbottomtoto2" id="tt6506"><?=$data->TT->P6506?></td>
                                <td class="resultviewbottomtoto2" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomtoto2" id="tt650ex"><?=$data->TT->P650EX?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 1</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="tt650jp1"><?=$data->TT->P650JP1?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 2</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="tt650jp2"><?=$data->TT->P650JP2?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td colspan="6" class="resultprizelable">Power Toto 6/55</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto" id="tt6551"><?=$data->TT->P6551?></td>
                                <td class="resultviewbottomtoto" id="tt6552"><?=$data->TT->P6552?></td>
                                <td class="resultviewbottomtoto" id="tt6553"><?=$data->TT->P6553?></td>
                                <td class="resultviewbottomtoto" id="tt6554"><?=$data->TT->P6554?></td>
                                <td class="resultviewbottomtoto" id="tt6555"><?=$data->TT->P6555?></td>
                                <td class="resultviewbottomtoto" id="tt6556"><?=$data->TT->P6556?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Jackpot</td>
                                <td colspan="4" class="resultviewbottomtotojpval" id="tt655jp"><?=$data->TT->P655JP?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td colspan="6" class="resultprizelable">Supreme Toto 6/58</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto" id="tt6581"><?=$data->TT->P6581?></td>
                                <td class="resultviewbottomtoto" id="tt6582"><?=$data->TT->P6582?></td>
                                <td class="resultviewbottomtoto" id="tt6583"><?=$data->TT->P6583?></td>
                                <td class="resultviewbottomtoto" id="tt6584"><?=$data->TT->P6584?></td>
                                <td class="resultviewbottomtoto" id="tt6585"><?=$data->TT->P6585?></td>
                                <td class="resultviewbottomtoto" id="tt6586"><?=$data->TT->P6586?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Jackpot</td>
                                <td colspan="4" class="resultviewbottomtotojpval" id="tt658jp"><?=$data->TT->P658JP?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="result outerbox toto">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td style="height:153px;">
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->M4DJG)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_7">
                <div class="outerbox magnum">
                    <table class="resultTable" align="center">
                        <tbody>
                            <tr>
                                <td colspan="10">
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td class="resultm4dlable" style="width:20%"><img
                                                        src="/assets/images/logo_magnum.gif" width="50" height="38" alt="Magnum Jackpot"></td>
                                                <td class="resultm4dlable">Magnum Jackpot Gold<br>萬能黃金万字积宝</td>
                                                <td class="resultm4dlable">
                                                    <span id="mjglive" class="live-icon" style="display:none;">
                                                        <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" title="Live Draw"></i>
                                                        <span>Live</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <table class="resultView2 headname">
                                        <tbody>
                                            <tr>
                                                <td class="resultdrawdate" id="mjgdd"><?=$data->M4DJG->DD?></td>
                                                <td class="resultdrawdate" id="mjgdn" style="text-align:right"><?=$data->M4DJG->DN?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultprizelable">Jackpot 1</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4d"><span class="mjg1"><?=$data->M4DJG->P1?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg6"><?=$data->M4DJG->P6?></span></td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4d"><span class="mjg7"><?=$data->M4DJG->P7?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg8"><?=$data->M4DJG->P8?></span></td>
                            </tr>
                            <tr>
                                <td colspan="10" class="result5dprizelable" style="display:none;" >Prize : <b><?=$data->M4DJG->JP1;?></b>
                                <span class="blink">
                                    <?php if($data->M4DJG->JP1WON == 1)
                                            echo "Won";
                                        else if($data->M4DJG->JP1WON > 0)
                                            echo  "Partially Won";
                                        else   
                                            echo "";
                                        ?>
                                </span></td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultprizelable">Jackpot 2</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4d"><span class="mjg1"><?=$data->M4DJG->P1?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4d"><span class="mjg7"><?=$data->M4DJG->P7?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg8"><?=$data->M4DJG->P8?></span></td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultor">or</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg6"><?=$data->M4DJG->P6?></span></td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4d"><span class="mjg7"><?=$data->M4DJG->P7?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg8"><?=$data->M4DJG->P8?></span></td>
                            </tr>
                            <tr>
                                <td colspan="10" class="result5dprizelable" style="display:none;">Prize : <b><?=$data->M4DJG->JP2;?></b><span class="blink">
                                        <?php if($data->M4DJG->JP2WON == 1)
                                            echo "Won";
                                        else if($data->M4DJG->JP2WON > 0)
                                            echo  "Partially Won";
                                        else   
                                            echo "";
                                        ?>
                                        </span></td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultprizelable">3rd Prize</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4d"><span class="mjg1"><?=$data->M4DJG->P1?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg6"><?=$data->M4DJG->P6?></span></td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultprizelable">4th Prize</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4d"><span class="mjg1"><?=$data->M4DJG->P1?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultor">or</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg6"><?=$data->M4DJG->P6?></span></td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultprizelable">5th Prize</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4d"><span class="mjg1"><?=$data->M4DJG->P1?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultor">or</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg6"><?=$data->M4DJG->P6?></span></td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultprizelable">6th Prize</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4d"><span class="mjg1"><?=$data->M4DJG->P1?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultor">or</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg6"><?=$data->M4DJG->P6?></span></td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultprizelable">7th Prize</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4d"><span class="mjg1"><?=$data->M4DJG->P1?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg2"><?=$data->M4DJG->P2?></span></td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultor">or</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d"><span class="mjg3"><?=$data->M4DJG->P3?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg4"><?=$data->M4DJG->P4?></span></td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="10" class="resultor">or</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4d"><span class="mjg5"><?=$data->M4DJG->P5?></span></td>
                                <td class="resultviewbottomm4d"><span class="mjg6"><?=$data->M4DJG->P6?></span></td>
                                <td class="resultviewbottomm4d" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                                <td class="resultviewbottomm4doff">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <div class="clearfix gn_aac_10"></div>
        </div>
<?php endforeach;?>
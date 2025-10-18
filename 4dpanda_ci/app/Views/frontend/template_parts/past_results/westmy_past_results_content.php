<?php 
if(!isset($past_results)) return;
foreach ($past_results as $past_result):
$data = json_decode($past_result);
if(!isset($data->STC) && !isset($data->SCS) && !isset($data->SB) && !isset($data->SBLT)) continue;

?>
        <div class="west-content">             
            <p class="gn_aac_17"><a class="anchor" id="section-ss"></a></p>
            <div class="col-xs-12 resultprizelable  section-header gn_aac_18">
                <span>
                    <h2>Past <?= isset($headings['heading_3'])?strip_tags($headings['heading_3']):'Sabah Sarawak 4D Results';?>: <?php echo date("d-m-Y (D)", strtotime($data->date));?></h2>
                </span>
            </div>
            <?php if(isset($data->STC)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_19">
                <div class="result outerbox st">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultstc4dlable" style="width:20%"><img src="/assets/images/logo_stc4d.gif" alt="Sandakan"></td>
                                <td class="resultstc4dlable">Sandakan 4D<br>山打根赛马会</td>
                                <td class="resultstc4dlable">
                                    <span id="stclive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="stdd"><?=$data->STC->DD?></td>
                                <td class="resultdrawdate" id="stdn" style="text-align:right"><?=$data->STC->DN?></td>
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
                                <td class="resultviewtop separator" id="stp1"><?=$data->STC->P1?></td>

                                <td class="resultviewtop separator" id="stp2"><?=$data->STC->P2?></td>
                                <td class="resultviewtop" id="stp3"><?=$data->STC->P3?></td>
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
                                                <td class="resultviewbottom" id="sts1"><?=$data->STC->S1?></td>
                                                <td class="resultviewbottom" id="sts2"><?=$data->STC->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sts3"><?=$data->STC->S3?></td>
                                                <td class="resultviewbottom" id="sts4"><?=$data->STC->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sts5"><?=$data->STC->S5?></td>
                                                <td class="resultviewbottom" id="sts6"><?=$data->STC->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sts7"><?=$data->STC->S7?></td>
                                                <td class="resultviewbottom" id="sts8"><?=$data->STC->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sts9"><?=$data->STC->S9?></td>
                                                <td class="resultviewbottom" id="sts10"><?=$data->STC->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sts11"><?=$data->STC->S11?></td>
                                                <td class="resultviewbottom" id="sts12"><?=$data->STC->S12?></td>
                                            </tr>
                                            <tr>
                                                <td colspan ="2" class="resultviewbottom" id="sts13"><?=$data->STC->S13?></td>
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
                                                <td class="resultviewbottom" id="stc1"><?=$data->STC->C1?></td>
                                                <td class="resultviewbottom" id="stc2"><?=$data->STC->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="stc3"><?=$data->STC->C3?></td>
                                                <td class="resultviewbottom" id="stc4"><?=$data->STC->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="stc5"><?=$data->STC->C5?></td>
                                                <td class="resultviewbottom" id="stc6"><?=$data->STC->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="stc7"><?=$data->STC->C7?></td>
                                                <td class="resultviewbottom" id="stc8"><?=$data->STC->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="stc9"><?=$data->STC->C9?></td>
                                                <td class="resultviewbottom" id="stc10"><?=$data->STC->C10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" colspan="2">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2" style="height:146px ;">
                        <tbody>
                            <tr>
                                <td class="resultviewbottom">4DPANDA.COM</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->SCS)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_19">
                <div class="result outerbox sw">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultsteclable" style="width:20%"><img src="/assets/images/logo_cashsweep.gif" alt="Special Cash Sweep 特別獎">
                                </td>
                                <td class="resultsteclable">Special Cash Sweep 大萬</td>
                                <td class="resultsteclable">
                                    <span id="swlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="swdd"><?=$data->SCS->DD?></td>
                                <td class="resultdrawdate" id="swdn" style="text-align:right"><?=$data->SCS->DN?></td>
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
                                <td class="resultviewtop separator" id="swp1"><?=$data->SCS->P1?></td>
                                <td class="resultviewtop separator" id="swp2"><?=$data->SCS->P2?></td>
                                <td class="resultviewtop" id="swp3"><?=$data->SCS->P3?></td>
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
                                                <td class="resultviewbottom" id="sws1"><?=$data->SCS->S1?></td>
                                                <td class="resultviewbottom" id="sws2"><?=$data->SCS->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sws3"><?=$data->SCS->S3?></td>
                                                <td class="resultviewbottom" id="sws4"><?=$data->SCS->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sws5"><?=$data->SCS->S5?></td>                                     
                                                <td class="resultviewbottom" id="sws6"><?=$data->SCS->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sws7"><?=$data->SCS->S7?></td>
                                                <td class="resultviewbottom" id="sws8"><?=$data->SCS->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sws9"><?=$data->SCS->S9?></td>
                                                <td class="resultviewbottom" id="sws10"><?=$data->SCS->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" colspan="2">&nbsp;</td>
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
                                                <td class="resultviewbottom" id="swc1"><?=$data->SCS->C1?></td>
                                                <td class="resultviewbottom" id="swc2"><?=$data->SCS->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="swc3"><?=$data->SCS->C3?></td>
                                                <td class="resultviewbottom" id="swc4"><?=$data->SCS->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="swc5"><?=$data->SCS->C5?></td>
                                                <td class="resultviewbottom" id="swc6"><?=$data->SCS->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="swc7"><?=$data->SCS->C7?></td>
                                                <td class="resultviewbottom" id="swc8"><?=$data->SCS->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="swc9"><?=$data->SCS->C9?></td>
                                                <td class="resultviewbottom" id="swc10"><?=$data->SCS->C10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" colspan="2">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>    
                    <table class="resultView2">
                        <tbody>
                            <tr><td class="resultprizelable">3D BIG</td></tr>
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
                                <td class="resultviewtop separator" id="swp13d"><?=$data->SCS->P13D?></td>
                                <td class="resultviewtop separator" id="swp23d"><?=$data->SCS->P23D?></td>
                                <td class="resultviewtop" id="swp33d"><?=$data->SCS->P33D?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2" style="height:56px ;">
                        <tbody>
                            <tr>
                                <td class="resultviewbottom">4DPANDA.COM</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->SB)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_20">
                <div class="result outerbox sb">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultsabahlable" style="width:20%"><img src="/assets/images/logo_sabah88.gif" alt="Sabah 88"></td>
                                <td class="resultsabahlable">Sabah 88 4D 沙巴萬字</td>
                                <td class="resultsabahlable">
                                    <span id="sblive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="sbdd"><?=$data->SB->DD?></td>
                                <td class="resultdrawdate" id="sbdn" style="text-align:right"><?=$data->SB->DN?></td>
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
                                <td class="resultviewtop separator" id="sbp1"><?=$data->SB->P1?></td>
                                <td class="resultviewtop separator" id="sbp2"><?=$data->SB->P2?></td>
                                <td class="resultviewtop" id="sbp3"><?=$data->SB->P3?></td>
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
                                                <td class="resultviewbottom" id="sbs1"><?=$data->SB->S1?></td>
                                                <td class="resultviewbottom" id="sbs2"><?=$data->SB->S2?></td>
                                            </tr>
                                            <tr>   
                                                <td class="resultviewbottom" id="sbs3"<?=$data->SB->S3?>></td>
                                                <td class="resultviewbottom" id="sbs4"><?=$data->SB->S4?></td>
                                            </tr>
                                            <tr>    
                                                <td class="resultviewbottom" id="sbs5"><?=$data->SB->S5?></td>
                                                <td class="resultviewbottom" id="sbs6"><?=$data->SB->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sbs7"><?=$data->SB->S7?></td>
                                                <td class="resultviewbottom" id="sbs8"><?=$data->SB->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sbs9"><?=$data->SB->S9?></td>
                                                <td class="resultviewbottom" id="sbs10"><?=$data->SB->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sbs11"><?=$data->SB->S11?></td>
                                                <td class="resultviewbottom" id="sbs12"><?=$data->SB->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sbs13" colspan="2"><?=$data->SB->S13?></td>
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
                                                <td class="resultviewbottom" id="sbc1"><?=$data->SB->C1?></td>
                                                <td class="resultviewbottom" id="sbc2"><?=$data->SB->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sbc3"><?=$data->SB->C3?></td>
                                                <td class="resultviewbottom" id="sbc4"><?=$data->SB->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sbc5"><?=$data->SB->C5?></td>
                                                <td class="resultviewbottom" id="sbc6"><?=$data->SB->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sbc7"><?=$data->SB->C7?></td>
                                                <td class="resultviewbottom" id="sbc8"><?=$data->SB->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sbc9"><?=$data->SB->C9?></td>
                                                <td class="resultviewbottom" id="sbc10"><?=$data->SB->C10?></td>
                                            </tr>
                                            <tr><td class="resultviewbottom" colspan="2">&nbsp;</td></tr>
                                            <tr><td class="resultviewbottom" colspan="2">&nbsp;</td></tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td style="width:50%" class="resultprizelable separator">Jackpot 1 Prize</td>
                                <td style="width:50%" class="resultprizelable">Jackpot 2 Prize</td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable separator"><b id="sbjp1"><?=$data->SB->JP1?></b></td>
                                <td class="result5dprizelable"><b id="sbjp2"><?=$data->SB->JP2?></b></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultprizelable">3D</td>
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
                            <td class="resultviewtop separator" id="sb3dp1"><?=$data->SB->P13D?></td>
                                <td class="resultviewtop separator" id="sb3dp2"><?=$data->SB->P23D?></td>
                                <td class="resultviewtop" id="sb3dp3"><?=$data->SB->P33D?></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->SBLT)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_21">
                <div class="outerbox sblt">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultsabahlable" style="width:20%"><img src="/assets/images/logo_sabah88.gif" alt="Sabah 88"></td>
                                <td class="resultsabahlable">Sabah 88 Lotto 沙巴樂透</td>
                                <td class="resultsabahlable">
                                    <span id="sbltlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="sbltdd"><?=$data->SBLT->DD?></td>
                                <td class="resultdrawdate" id="sbltdn" style="text-align:right"><?=$data->SBLT->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td colspan="8" class="resultprizelable">Lotto 6/45</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt1"><?=$data->SBLT->LT1?></td>
                                <td class="resultviewbottomtoto2" id="sblt2"><?=$data->SBLT->LT2?></td>
                                <td class="resultviewbottomtoto2" id="sblt3"><?=$data->SBLT->LT3?></td>
                                <td class="resultviewbottomtoto2" id="sblt4"><?=$data->SBLT->LT4?></td>
                                <td class="resultviewbottomtoto2" id="sblt5"><?=$data->SBLT->LT5?></td>
                                <td class="resultviewbottomtoto2" id="sblt6"><?=$data->SBLT->LT6?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt7"><?=$data->SBLT->LT7?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 1</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sbltjp1"><?=$data->SBLT->LTJP1?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 2</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sbltjp2"><?=$data->SBLT->LTJP2?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td colspan="8" class="resultprizelable">Lotto 6</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt6g11"><?=$data->SBLT->LT6G11?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g12"><?=$data->SBLT->LT6G12?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g13"><?=$data->SBLT->LT6G13?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g14"><?=$data->SBLT->LT6G14?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g15"><?=$data->SBLT->LT6G15?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt6g16"><?=$data->SBLT->LT6G16?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 1</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt6g1jp">RM 144,153.32</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt6g21"><?=$data->SBLT->LT6G21?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g22"><?=$data->SBLT->LT6G22?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g23"><?=$data->SBLT->LT6G23?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g24"><?=$data->SBLT->LT6G24?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g25"><?=$data->SBLT->LT6G25?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt6g26"><?=$data->SBLT->LT6G26?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 2</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt6g2jp">RM 30,622.99</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt6g31"><?=$data->SBLT->LT6G31?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g32"><?=$data->SBLT->LT6G32?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g33"><?=$data->SBLT->LT6G33?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g34"><?=$data->SBLT->LT6G34?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g35"><?=$data->SBLT->LT6G35?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt6g36"><?=$data->SBLT->LT6G36?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 3</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt6g3jp">RM 9,745.36</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt6g41"><?=$data->SBLT->LT6G41?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g42"><?=$data->SBLT->LT6G42?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g43"><?=$data->SBLT->LT6G43?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g44"><?=$data->SBLT->LT6G44?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g45"><?=$data->SBLT->LT6G45?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt6g46"><?=$data->SBLT->LT6G46?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 4</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt6g4jp"><?=$data->SBLT->LT6G4JP?></td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt6g51"><?=$data->SBLT->LT6G51?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g52"><?=$data->SBLT->LT6G52?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g53"><?=$data->SBLT->LT6G53?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g54"><?=$data->SBLT->LT6G54?></td>
                                <td class="resultviewbottomtoto2" id="sblt6g55"><?=$data->SBLT->LT6G44?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt6g56"><?=$data->SBLT->LT6G56?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 5</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt6g5jp"><?=$data->SBLT->LT6G5JP;?></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="" style="height:48px;"><b>4DPANDA.COM</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->SBLT)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_21">
                <div class="outerbox sblt">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultsabahlable" style="width:20%"><img src="/assets/images/logo_sabah88.gif" alt="Sabah 88"></td>
                                <td class="resultsabahlable">Sabah 88 Lotto 沙巴樂透</td>
                                <td class="resultsabahlable">
                                    <span id="sbltlive2" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="sbltdd2"><?=$data->SBLT->DD?></td>
                                <td class="resultdrawdate" id="sbltdn2" style="text-align:right"><?=$data->SBLT->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td colspan="8" class="resultprizelable">Lotto 5</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt5g11"><?=$data->SBLT->LT5G11?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g12"><?=$data->SBLT->LT5G12?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g13"><?=$data->SBLT->LT5G13?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g14"><?=$data->SBLT->LT5G14?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt5g15"><?=$data->SBLT->LT5G15?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 1</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt5g1jp"><?=$data->SBLT->LT5G1JP?></td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt5g21"><?=$data->SBLT->LT5G21?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g22"><?=$data->SBLT->LT5G22?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g23"><?=$data->SBLT->LT5G23?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g24"><?=$data->SBLT->LT5G24?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt5g25"><?=$data->SBLT->LT5G25?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 2</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt5g2jp"><?=$data->SBLT->LT5G2JP?></td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt5g31"><?=$data->SBLT->LT5G31?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g32"><?=$data->SBLT->LT5G32?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g33"><?=$data->SBLT->LT5G33?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g34"><?=$data->SBLT->LT5G34?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt5g35"><?=$data->SBLT->LT5G35?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 3</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt5g3jp"><?=$data->SBLT->LT5G3JP?></td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt5g41"><?=$data->SBLT->LT5G41?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g42"><?=$data->SBLT->LT5G42?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g43"><?=$data->SBLT->LT5G43?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g44"><?=$data->SBLT->LT5G44?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt5g45"><?=$data->SBLT->LT5G45?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 4</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt5g4jp"><?=$data->SBLT->LT5G4JP?></td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt5g51"><?=$data->SBLT->LT5G51?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g52"><?=$data->SBLT->LT5G52?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g53"><?=$data->SBLT->LT5G53?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g54"><?=$data->SBLT->LT5G54?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt5g55"><?=$data->SBLT->LT5G55?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 5</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt5g5jp"><?=$data->SBLT->LT5G5JP?></td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt5g61"><?=$data->SBLT->LT5G61?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g62"><?=$data->SBLT->LT5G62?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g63"><?=$data->SBLT->LT5G63?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g64"><?=$data->SBLT->LT5G63?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt5g65"><?=$data->SBLT->LT5G65?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 6</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt5g6jp"><?=$data->SBLT->LT5G6JP?></td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt5g71"><?=$data->SBLT->LT5G71?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g72"><?=$data->SBLT->LT5G72?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g73"><?=$data->SBLT->LT5G73?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g74"><?=$data->SBLT->LT5G74?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt5g75"><?=$data->SBLT->LT5G75?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 7</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt5g7jp"><?=$data->SBLT->LT5G7JP?></td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sblt5g81"><?=$data->SBLT->LT5G81?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g82"><?=$data->SBLT->LT5G82?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g83"><?=$data->SBLT->LT5G83?></td>
                                <td class="resultviewbottomtoto2" id="sblt5g84"><?=$data->SBLT->LT5G84?></td>
                                <td class="resultviewbottomtoto2" style="color: #cc0000;">+</td>
                                <td class="resultviewbottomtoto2" id="sblt5g85"><?=$data->SBLT->LT5G85?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="resultviewbottomtotojp">Jackpot 8</td>
                                <td colspan="5" class="resultviewbottomtotojpval" id="sblt5g8jp"><?=$data->SBLT->LT5G8JP?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <div class="clearfix gn_aac_22"></div>
        </div>
<?php endforeach;?>
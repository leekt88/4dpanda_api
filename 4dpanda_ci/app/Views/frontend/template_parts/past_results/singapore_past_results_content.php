<?php 
if(!isset($past_results)) return;
foreach ($past_results as $past_result):
$data = json_decode($past_result);
if(!isset($data->SGP4D) && !isset($data->SGPTT)) continue;
?> 
        <div class="singapore-content">            
            <p class="gn_aac_11">
                <a class="anchor" id="section-sg"></a>
            </p>
            <div class="col-xs-12 resultprizelable gn_aac_12  section-header">
                <span>
                 <h2>Past <?= isset($headings['heading_2'])?strip_tags($headings['heading_2']):'Singapore 4D Results';?>: <?php echo date("d-m-Y (D)", strtotime($data->date));?></h2>
                </span>
            </div>
            <?php if(isset($data->SGP4D)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_13">
                <div class="result outerbox sg4d">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultsg4dlable"><img src="/assets/images/logo_sg4d.gif?singaporepool" alt="Singapore Pool"></td>
                                <td class="resultsg4dlable" colspan="2">Singapore 4D</td>
                                <td class="resultsabahlable">
                                    <span id="sgp4dlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="sdn"><?=$data->SGP4D->DN?></td>
                                <td class="resultdrawdate" id="sdd" style="text-align:right"><?=$data->SGP4D->DD?></td>
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
                                <td class="resultviewtop separator" id="sp1"><?=$data->SGP4D->P1?></td>
                                <td class="resultviewtop separator" id="sp2"><?=$data->SGP4D->P2?></td>
                                <td class="resultviewtop" id="sp3"><?=$data->SGP4D->P3?></td>
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
                                                <td class="resultviewbottom" id="ss1"><?=$data->SGP4D->S1?></td>
                                                <td class="resultviewbottom" id="ss2"><?=$data->SGP4D->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ss3"><?=$data->SGP4D->S3?></td>
                                                <td class="resultviewbottom" id="ss4"><?=$data->SGP4D->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ss5"><?=$data->SGP4D->S5?></td>                                          
                                                <td class="resultviewbottom" id="ss6"><?=$data->SGP4D->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ss7"><?=$data->SGP4D->S7?></td>
                                                <td class="resultviewbottom" id="ss8"><?=$data->SGP4D->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ss9"><?=$data->SGP4D->S9?></td>
                                                <td class="resultviewbottom" id="ss10"><?=$data->SGP4D->S10?></td>
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
                                                <td class="resultviewbottom" id="sc1"><?=$data->SGP4D->C1?></td>
                                                <td class="resultviewbottom" id="sc2"><?=$data->SGP4D->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sc3"><?=$data->SGP4D->C3?></td>
                                                <td class="resultviewbottom" id="sc4"><?=$data->SGP4D->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sc5"><?=$data->SGP4D->C5?></td>
                                                <td class="resultviewbottom" id="sc6"><?=$data->SGP4D->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sc7"><?=$data->SGP4D->C7?></td>
                                                <td class="resultviewbottom" id="sc8"><?=$data->SGP4D->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="sc9"><?=$data->SGP4D->C8?></td>
                                                <td class="resultviewbottom" id="sc10"><?=$data->SGP4D->C10?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="resultviewbottom" style="height:42px;">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultviewbottom" style="height:50px;">4DPANDA.COM</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php endif?>
            <?php if(isset($data->SGPTT)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_15">
                <div class="outerbox sg4d">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultsg4dlable"><img src="/assets/images/logo_sg4d.gif?singaporepool" alt="Singapore Pool"></td>
                                <td class="resultsg4dlable" colspan="2">Singapore Toto</td>
                                <td class="resultsabahlable">
                                    <span id="sgpttlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="sgtdn"><?=$data->SGPTT->DN?></td>
                                <td class="resultdrawdate" id="sgtdd" style="text-align:right"><?=$data->SGPTT->DD?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2" style="height:327px;">
                        <tbody>
                            <tr>
                                <td colspan="8" class="resultprizelable">Toto</td>
                            </tr>
                            <tr>
                                <td class="resultviewbottomtoto2" id="sgtp1"><?=$data->SGPTT->P1?></td>
                                <td class="resultviewbottomtoto2" id="sgtp2"><?=$data->SGPTT->P2?></td>
                                <td class="resultviewbottomtoto2" id="sgtp3"><?=$data->SGPTT->P3?></td>
                                <td class="resultviewbottomtoto2" id="sgtp4"><?=$data->SGPTT->P4?></td>
                                <td class="resultviewbottomtoto2" id="sgtp5"><?=$data->SGPTT->P5?></td>
                                <td class="resultviewbottomtoto2" id="sgtp6"><?=$data->SGPTT->P6?></td>
                                <td class="resultviewbottomtoto2" style="color: #fff;background-color: #cc0000">+</td>
                                <td class="resultviewbottomtoto2" id="sgtp7"><?=$data->SGPTT->P7?></td>
                            </tr>
                            <tr>
                                <td colspan="8">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp"
                                    style="color: #fff;background-color: #48486F">Prize Group</td>
                                <td colspan="3" class="resultviewbottomtotojp"
                                    style="color: #fff;background-color: #48486F">Share Amount (Each)</td>
                                <td colspan="3" class="resultviewbottomtotojp"
                                    style="color: #fff;background-color: #48486F">No. of Winning Shares</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Group 1</td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjp1"><?=$data->SGPTT->JP1?></td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjpw1"><?=$data->SGPTT->JPW1?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Group 2</td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjp2"><?=$data->SGPTT->JP2?></td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjpw2"><?=$data->SGPTT->JPW2?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Group 3</td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjp3"><?=$data->SGPTT->JP3?></td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjpw3"><?=$data->SGPTT->JPW3?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Group 4</td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjp4"><?=$data->SGPTT->JP4?></td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjpw4"><?=$data->SGPTT->JPW4?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Group 5</td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjp5"><?=$data->SGPTT->JP5?></td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjpw5"><?=$data->SGPTT->JPW5?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Group 6</td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjp6"><?=$data->SGPTT->JP6?></td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjpw6"><?=$data->SGPTT->JPW6?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="resultviewbottomtotojp">Group 7</td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjp6"><?=$data->SGPTT->JP7?></td>
                                <td colspan="3" class="resultviewbottomtotojpval" id="sgtjpw6"><?=$data->SGPTT->JPW7?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <div class="clearfix gn_aac_16"></div>
        </div>
<?php endforeach;?>
<?php 
if(!isset($results)) return;
$data = json_decode($results);
if(!isset($data->GD) && !isset($data->P4D1) && !isset($data->P4D2) && !isset($data->H4D6D1) && !isset($data->H4D6D2) && !isset($data->GD) &&!isset($data->NLT)) return;
?>   
        <div class="cambodia-content">          
            <p class="gn_aac_23"><a class="anchor" id="section-cam"></a></p>
            <div class="col-xs-12 resultprizelable gn_aac_24 section-header">
                <span>
                    <?= isset($headings['heading_4'])?$headings['heading_4']:'Cambodia 4D Results';?>
                </span>
            </div>
            <?php if(isset($data->GD)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_25">
                <div class="result outerbox camg">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultgdlottolable"><img src="/assets/images/logo_gdlotto.jpg?granddragonlotto" alt="Grand Dragon">
                                </td>
                                <td class="resultgdlottolable">Grand Dragon 4D 豪龙</td>
                                <td class="resultgdlottolable">
                                    <span id="gdlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="gdd"><?=$data->GD->DD?></td>
                                <td class="resultdrawdate" id="gdn" style="text-align:right"></td>
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
                                <td class="resultviewtop separator" id="gp1"><?=$data->GD->P1?></td>
                                <td class="resultviewtop separator" id="gp2"><?=$data->GD->P2?></td>
                                <td class="resultviewtop" id="gp3"><?=$data->GD->P3?></td>
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
                                                <td class="resultviewbottom" id="gs1"><?=$data->GD->S1?></td>
                                                <td class="resultviewbottom" id="gs2"><?=$data->GD->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gs3"><?=$data->GD->S3?></td>
                                                <td class="resultviewbottom" id="gs4"><?=$data->GD->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gs5"><?=$data->GD->S5?></td>
                                                <td class="resultviewbottom" id="gs6"><?=$data->GD->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gs7"><?=$data->GD->S7?></td>
                                                <td class="resultviewbottom" id="gs8"><?=$data->GD->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gs9"><?=$data->GD->S9?></td>
                                                <td class="resultviewbottom" id="gs10"><?=$data->GD->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gs11"><?=$data->GD->S11?></td>
                                                <td class="resultviewbottom" id="gs12"><?=$data->GD->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gs13" colspan="2"><?=$data->GD->S13?></td>
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
                                                <td class="resultviewbottom" id="gc1"><?=$data->GD->C1?></td>
                                                <td class="resultviewbottom" id="gc2"><?=$data->GD->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gc3"><?=$data->GD->C3?></td>
                                                <td class="resultviewbottom" id="gc4"><?=$data->GD->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gc5"><?=$data->GD->C5?></td>
                                                <td class="resultviewbottom" id="gc6"><?=$data->GD->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gc7"><?=$data->GD->C7?></td>
                                                <td class="resultviewbottom" id="gc8"><?=$data->GD->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="gc9"><?=$data->GD->C9?></td>
                                                <td class="resultviewbottom" id="gc10"><?=$data->GD->C10?></td>
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
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->P4D1)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_26">
                <div class="result outerbox camp">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultperdanalable"><img src="/assets/images/logo_perdana.jpg?perdana" alt="Perdana"></td>
                                <td class="resultperdanalable">Perdana 4D
                                    <br> 15:30
                                </td>
                                <td class="resultperdanalable">
                                    <span id="plive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="pdd"><?=$data->P4D1->DD?></td>
                                <td class="resultdrawdate" id="pdn" style="text-align:right"></td>
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
                                <td class="resultviewtop separator" id="pp1"><?=$data->P4D1->P1?></td>
                                <td class="resultviewtop separator" id="pp2"><?=$data->P4D1->P2?></td>
                                <td class="resultviewtop" id="pp3"><?=$data->P4D1->P3?></td>
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
                                                <td class="resultviewbottom" id="ps1"><?=$data->P4D1->S1?></td>
                                                <td class="resultviewbottom" id="ps2"><?=$data->P4D1->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps3"><?=$data->P4D1->S3?></td>
                                                <td class="resultviewbottom" id="ps4"><?=$data->P4D1->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps5"><?=$data->P4D1->S5?></td>
                                                <td class="resultviewbottom" id="ps6"><?=$data->P4D1->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps7"><?=$data->P4D1->S7?></td>
                                                <td class="resultviewbottom" id="ps8"><?=$data->P4D1->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps9"><?=$data->P4D1->S9?></td>
                                                <td class="resultviewbottom" id="ps10"><?=$data->P4D1->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps11"><?=$data->P4D1->S11?></td>
                                                <td class="resultviewbottom" id="ps12"><?=$data->P4D1->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps13" colspan="2"><?=$data->P4D1->S13?></td>
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
                                                <td class="resultviewbottom" id="pc1"><?=$data->P4D1->C1?></td>
                                                <td class="resultviewbottom" id="pc2"><?=$data->P4D1->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="pc3"><?=$data->P4D1->C3?></td>
                                                <td class="resultviewbottom" id="pc4"><?=$data->P4D1->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="pc5"><?=$data->P4D1->C5?></td>
                                                <td class="resultviewbottom" id="pc6"><?=$data->P4D1->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="pc7"><?=$data->P4D1->C7?></td>
                                                <td class="resultviewbottom" id="pc8"><?=$data->P4D1->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="pc9"><?=$data->P4D1->C9?></td>
                                                <td class="resultviewbottom" id="pc10"><?=$data->P4D1->C10?></td>
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
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->P4D2)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_26">
                <div class="result outerbox camp">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultperdanalable"><img src="/assets/images/logo_perdana.jpg?perdana" alt="Perdana"></td>
                                <td class="resultperdanalable">Perdana 4D
                                    <br> 19:30
                                </td>
                                <td class="resultperdanalable">
                                    <span id="plive2" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="pdd_2"><?=$data->P4D2->DD?></td>
                                <td class="resultdrawdate" id="pdn_2" style="text-align:right"></td>
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
                                <td class="resultviewtop separator" id="pp1_2"><?=$data->P4D2->P1?></td>
                                <td class="resultviewtop separator" id="pp2_2"><?=$data->P4D2->P2?></td>
                                <td class="resultviewtop" id="pp3_2"><?=$data->P4D2->P3?></td>
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
                                                <td class="resultviewbottom" id="ps1_2"><?=$data->P4D2->S1?></td>
                                                <td class="resultviewbottom" id="ps2_2"><?=$data->P4D2->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps3_2"><?=$data->P4D2->S3?></td>
                                                <td class="resultviewbottom" id="ps4_2"><?=$data->P4D2->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps5_2"><?=$data->P4D2->S5?></td>
                                                <td class="resultviewbottom" id="ps6_2"><?=$data->P4D2->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps7_2"><?=$data->P4D2->S7?></td>
                                                <td class="resultviewbottom" id="ps8_2"><?=$data->P4D2->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps9_2"><?=$data->P4D2->S9?></td>
                                                <td class="resultviewbottom" id="ps10_2"><?=$data->P4D2->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps11_2"><?=$data->P4D2->S11?></td>
                                                <td class="resultviewbottom" id="ps12_2"><?=$data->P4D2->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="ps13_2" colspan="2"><?=$data->P4D2->S13?></td>
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
                                                <td class="resultviewbottom" id="pc1_2"><?=$data->P4D2->C1?></td>
                                                <td class="resultviewbottom" id="pc2_2"><?=$data->P4D2->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="pc3_2"><?=$data->P4D2->C3?></td>
                                                <td class="resultviewbottom" id="pc4_2"><?=$data->P4D2->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="pc5_2"><?=$data->P4D2->C5?></td>
                                                <td class="resultviewbottom" id="pc6_2"><?=$data->P4D2->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="pc7_2"><?=$data->P4D2->C7?></td>
                                                <td class="resultviewbottom" id="pc8_2"><?=$data->P4D2->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="pc9_2"><?=$data->P4D2->C9?></td>
                                                <td class="resultviewbottom" id="pc10_2"><?=$data->P4D2->C10?></td>
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
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->H4D6D1)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 rpad gn_aac_27">
                <div class="result outerbox camh">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resulthariharilable"><img src="/assets/images/logo_harihari.jpg?luckyharihari" alt="Lucky Hari Hari"></td>
                                <td class="resulthariharilable">Lucky HariHari 4D <br>
                                    天天好运
                                    <br> 15:30
                                </td>
                                <td class="resulthariharilable">
                                    <span id="hlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="hdd"><?=$data->H4D6D1->DD?></td>
                                <td class="resultdrawdate" id="hdn" style="text-align:right"><?=$data->H4D6D1->DN?></td>
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
                                <td class="resultviewtop separator" id="hp1"><?=$data->H4D6D1->P1?></td>
                                <td class="resultviewtop separator" id="hp2"><?=$data->H4D6D1->P2?></td>
                                <td class="resultviewtop" id="hp3"><?=$data->H4D6D1->P3?></td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="resultView2">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="resultprizelable">Special 特別獎</td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs1"><?=$data->H4D6D1->S1?></td>
                                                <td class="resultviewbottom" id="hs2"><?=$data->H4D6D1->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs3"><?=$data->H4D6D1->S3?></td>
                                                <td class="resultviewbottom" id="hs4"><?=$data->H4D6D1->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs5"><?=$data->H4D6D1->S5?></td>                                            
                                                <td class="resultviewbottom" id="hs6"><?=$data->H4D6D1->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs7"><?=$data->H4D6D1->S7?></td>
                                                <td class="resultviewbottom" id="hs8"><?=$data->H4D6D1->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs9"><?=$data->H4D6D1->S9?></td>
                                                <td class="resultviewbottom" id="hs10"><?=$data->H4D6D1->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs11"><?=$data->H4D6D1->S11?></td>
                                                <td class="resultviewbottom" id="hs12"><?=$data->H4D6D1->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs13" colspan="2"><?=$data->H4D6D1->S13?></td>
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
                                                <td class="resultviewbottom" id="hc1"><?=$data->H4D6D1->C1?></td>
                                                <td class="resultviewbottom" id="hc2"><?=$data->H4D6D1->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hc3"><?=$data->H4D6D1->C3?></td>
                                                <td class="resultviewbottom" id="hc4"><?=$data->H4D6D1->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hc5"><?=$data->H4D6D1->C5?></td>
                                                <td class="resultviewbottom" id="hc6"><?=$data->H4D6D1->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hc7"><?=$data->H4D6D1->C7?></td>
                                                <td class="resultviewbottom" id="hc8"><?=$data->H4D6D1->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hc9"><?=$data->H4D6D1->C9?></td>
                                                <td class="resultviewbottom" id="hc10"><?=$data->H4D6D1->C10?></td>
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
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->H4D6D1)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_27">
                <div class="outerbox camh">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resulthariharilable" style="width:20%">
                                    <img src="/assets/images/logo_harihari.jpg?luckyharihari" alt="Lucky Hari Hari"></td>
                                <td class="resulthariharilable">Lucky HariHari 6D 
                                    <br> 天天好运
                                    <br> 15:30
                                </td>
                                <td class="resulthariharilable">
                                        <span id="h6dlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="hdd6d"><?=$data->H4D6D1->DD?></td>
                                <td class="resultdrawdate" id="hdn6d" style="text-align:right">Draw No: <?=$data->H4D6D1->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="result5dprizelable">1st</td>
                                <td colspan="3" class="resultviewbottom" id="h6d1"><?=$data->H4D6D1->prize6D?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">2nd</td>
                                <td class="resultviewbottom" id="h6d2a1"><?=$data->H4D6D1->prize6D_2A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="h6d2b1"><?=$data->H4D6D1->prize6D_2B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">3rd</td>
                                <td class="resultviewbottom" id="h6d3a1"><?=$data->H4D6D1->prize6D_3A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="h6d3b1"><?=$data->H4D6D1->prize6D_3B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">4th</td>
                                <td class="resultviewbottom" id="h6d4a1"><?=$data->H4D6D1->prize6D_4A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="h6d4b1"><?=$data->H4D6D1->prize6D_4B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">5th</td>
                                <td class="resultviewbottom" id="h6d5a1"><?=$data->H4D6D1->prize6D_5A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="h6d5b1"><?=$data->H4D6D1->prize6D_5B?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultviewbottom" style="height:160px;">4DPANDA.COM</td>
                            </tr>
                        </tbody>
                    </table>      
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->H4D6D2)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_27">
                <div class="outerbox camh">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resulthariharilable"><img src="/assets/images/logo_harihari.jpg?luckyharihari" alt="Lucky Hari Hari"></td>
                                <td class="resulthariharilable">Lucky HariHari 4D <br>
                                天天好运
                                <br> 19:30
                                </td>
                                <td class="resulthariharilable">
                                    <span id="hlive2" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="hdd2"><?=$data->H4D6D2->DD?></td>
                                <td class="resultdrawdate" id="hdn2" style="text-align:right"><?=$data->H4D6D2->DN?></td>
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
                            <td class="resultviewtop separator" id="hp12"><?=$data->H4D6D2->P1?></td>
                                <td class="resultviewtop separator" id="hp22"><?=$data->H4D6D2->P2?></td>
                                <td class="resultviewtop" id="hp32"><?=$data->H4D6D2->P3?></td>
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
                                                <td class="resultviewbottom" id="hs1_2"><?=$data->H4D6D2->S1?></td>
                                                <td class="resultviewbottom" id="hs2_2"><?=$data->H4D6D2->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs3_2"><?=$data->H4D6D2->S3?></td>
                                                <td class="resultviewbottom" id="hs4_2"><?=$data->H4D6D2->S4?></td>
                                            </tr>
                                            <tr>  
                                                <td class="resultviewbottom" id="hs5_2"><?=$data->H4D6D2->S5?></td>
                                                <td class="resultviewbottom" id="hs6_2"><?=$data->H4D6D2->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs7_2"><?=$data->H4D6D2->S7?></td>
                                                <td class="resultviewbottom" id="hs8_2"><?=$data->H4D6D2->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs9_2"><?=$data->H4D6D2->S9?></td>
                                                <td class="resultviewbottom" id="hs10_2"><?=$data->H4D6D2->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs11_2"><?=$data->H4D6D2->S11?></td>
                                                <td class="resultviewbottom" id="hs12_2"><?=$data->H4D6D2->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hs13_2" colspan="2"><?=$data->H4D6D2->S13?></td>
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
                                                <td class="resultviewbottom" id="hc1_2"><?=$data->H4D6D2->C1?></td>
                                                <td class="resultviewbottom" id="hc2_2"><?=$data->H4D6D2->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hc3_2"><?=$data->H4D6D2->C3?></td>
                                                <td class="resultviewbottom" id="hc4_2"><?=$data->H4D6D2->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hc5_2"><?=$data->H4D6D2->C5?></td>
                                                <td class="resultviewbottom" id="hc6_2"><?=$data->H4D6D2->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hc7_2"><?=$data->H4D6D2->C7?></td>
                                                <td class="resultviewbottom" id="hc8_2"><?=$data->H4D6D2->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="hc9_2"><?=$data->H4D6D2->C9?></td>
                                                <td class="resultviewbottom" id="hc10_2"><?=$data->H4D6D2->C10?></td>
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
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->H4D6D2)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_27">
                <div class="outerbox camh">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resulthariharilable" style="width:20%">
                                    <img src="/assets/images/logo_harihari.jpg?luckyharihari" alt='Lucky Hari Hari'></td>
                                <td class="resulthariharilable">Lucky HariHari 6D 
                                    <br> 天天好运
                                <br> 19:30
                                </td>
                                <td class="resulthariharilable">
                                    <span id="h6dlive2" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="hdd26d"><?=$data->H4D6D2->DD?></td>
                                <td class="resultdrawdate" id="hdn26d" style="text-align:right">Draw No: <?=$data->H4D6D2->DN?></td>

                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="result5dprizelable">1st</td>
                                <td colspan="3" class="resultviewbottom" id="h6d2"><?=$data->H4D6D2->prize6D?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">2nd</td>
                                <td class="resultviewbottom" id="h6d2a2"><?=$data->H4D6D2->prize6D_2A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="h6d2b2"><?=$data->H4D6D2->prize6D_2B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">3rd</td>
                                <td class="resultviewbottom" id="h6d3a2"><?=$data->H4D6D2->prize6D_3A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="h6d3b2"><?=$data->H4D6D2->prize6D_3B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">4th</td>
                                <td class="resultviewbottom" id="h6d4a2"><?=$data->H4D6D2->prize6D_4A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="h6d4b2"><?=$data->H4D6D2->prize6D_4B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">5th</td>
                                <td class="resultviewbottom" id="h6d5a2"><?=$data->H4D6D2->prize6D_5A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="h6d5b2"><?=$data->H4D6D2->prize6D_5B?></td>
                            </tr>
                            <tr>
                                <td style="height:123px;" colspan="4"><b>4DPANDA.COM</b></td>
                            </tr>
                        </tbody>
                    </table>       
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->GD)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_27">
                <div class="outerbox camg">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultgdlottolable" style="width:20%">
                                    <img src="/assets/images/logo_gdlotto.jpg?granddragonlotto" alt="Grand Dragon"></td>
                                <td class="resultgdlottolable">Grand Dragon 6D 
                                    <br>  豪龙
                                </td>
                                <td class="resultgdlottolable">
                                    <span id="glive2" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="gdd2"><?=$data->GD->DD?></td>
                                <td class="resultdrawdate" id="gdn2" style="text-align:right"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="result5dprizelable">1st</td>
                                <td colspan="3" class="resultviewbottom" id="gd6d1"><?=$data->GD->GD6D1?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">2nd</td>
                                <td class="resultviewbottom" id="gd6da1"><?=$data->GD->GD6DA1?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="gd6da2"><?=$data->GD->GD6DA2?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">3rd</td>
                                <td class="resultviewbottom" id="gd6db1"><?=$data->GD->GD6DB1?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="gd6db2"><?=$data->GD->GD6DB2?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">4th</td>
                                <td class="resultviewbottom" id="gd6dc1"><?=$data->GD->GD6DC1?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="gd6dc2"><?=$data->GD->GD6DC2?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">5th</td>
                                <td class="resultviewbottom" id="gd6dd1"><?=$data->GD->GD6DD1?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="gd6dd2"><?=$data->GD->GD6DD2?></td>
                            </tr>
                            <tr>
                                <td style="height:143px;" colspan="4"><b>4DPANDA.COM</b></td>
                            </tr>
                        </tbody>
                    </table>       
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->NLT)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_25">
                <div class="result outerbox nlt 9lotto">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="result9lottolable"><img src="/assets/images/boards-images/9lotto.png?9lotto" style="width:45px;" alt="Nine Lotto">
                                </td>
                                <td class="result9lottolable">9 Lotto 4D</td>
                                <td class="result9lottolable">
                                    <span id="nltlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="nltdd"><?=$data->NLT->DD?></td>
                                <td class="resultdrawdate" id="nltdn" style="text-align:right"><?=$data->NLT->DN?></td>
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
                                <td class="resultviewtop separator" id="nltp1"><?=$data->NLT->P1?></td>
                                <td class="resultviewtop separator" id="nltp2"><?=$data->NLT->P2?></td>
                                <td class="resultviewtop" id="nltp3"><?=$data->NLT->P3?></td>
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
                                                <td class="resultviewbottom" id="nlts1"><?=$data->NLT->S1?></td>
                                                <td class="resultviewbottom" id="nlts2"><?=$data->NLT->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nlts3"><?=$data->NLT->S3?></td>
                                                <td class="resultviewbottom" id="nlts4"><?=$data->NLT->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nlts5"><?=$data->NLT->S5?></td>
                                                <td class="resultviewbottom" id="nlts6"><?=$data->NLT->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nlts7"><?=$data->NLT->S7?></td>
                                                <td class="resultviewbottom" id="nlts8"><?=$data->NLT->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nlts9"><?=$data->NLT->S9?></td>
                                                <td class="resultviewbottom" id="nlts10"><?=$data->NLT->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nlts11"><?=$data->NLT->S11?></td>
                                                <td class="resultviewbottom" id="nlts12"><?=$data->NLT->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nlts13" colspan="2"><?=$data->NLT->S13?></td>
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
                                                <td class="resultviewbottom" id="nltc1"><?=$data->NLT->C1?></td>
                                                <td class="resultviewbottom" id="nltc2"><?=$data->NLT->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nltc3"><?=$data->NLT->C3?></td>
                                                <td class="resultviewbottom" id="nltc4"><?=$data->NLT->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nltc5"><?=$data->NLT->C5?></td>
                                                <td class="resultviewbottom" id="nltc6"><?=$data->NLT->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nltc7"><?=$data->NLT->C7?></td>
                                                <td class="resultviewbottom" id="nltc8"><?=$data->NLT->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="nltc9"><?=$data->NLT->C9?></td>
                                                <td class="resultviewbottom" id="nltc10"><?=$data->NLT->C10?></td>
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
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($data->NLT)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_27">
                <div class="outerbox nlt">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="result9lottolable" style="width:20%">
                                    <img src="/assets/images/boards-images/9lotto.png?9lotto" style="width:45px;" alt="Nine Lotto"></td>
                                <td class="result9lottolable">9 Lotto 6D
                                </td>
                                <td class="result9lottolable">
                                    <span id="nltlive2" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="nltdd2"><?=$data->NLT->DD?></td>
                                <td class="resultdrawdate" id="nltdn2" style="text-align:right"><?=$data->NLT->DN?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="result5dprizelable">1st</td>
                                <td colspan="3" class="resultviewbottom" id="nltd6d1"><?=$data->NLT->P6D1?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">2nd</td>
                                <td class="resultviewbottom" id="nltd6d2a"><?=$data->NLT->P6D2A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="nltd6d2b"><?=$data->NLT->P6D2B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">3rd</td>
                                <td class="resultviewbottom" id="nltd6d3a"><?=$data->NLT->P6D3A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="nltd6d3b"><?=$data->NLT->P6D3B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">4th</td>
                                <td class="resultviewbottom" id="nltd6d4a"><?=$data->NLT->P6D4A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="nltd6d4b"><?=$data->NLT->P6D4B?></td>
                            </tr>
                            <tr>
                                <td class="result5dprizelable">5th</td>
                                <td class="resultviewbottom" id="nltd6d5a"><?=$data->NLT->P6D5A?></td>
                                <td class="result5dprizelable">or</td>
                                <td class="resultviewbottom" id="nltd6d5b"><?=$data->NLT->P6D5B?></td>
                            </tr>
                        </tbody>
                    </table> 
                    <table class="resultView2">
                        <tbody>
                            <tr><td class="resultviewbottom">6D + 1</td></tr>
                        </tbody>
                    </table>   
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultviewbottom separator" id="nlt7d" style="width:75%;"><?=$data->NLT->P7D?></td>
                                <td class="resultviewbottom separator" style="width:10%;">+</td>
                                <td class="resultviewbottom" id="nlt7d1" style="width:15%;"><?=$data->NLT->P7D1?></td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
            </div>
            <?php endif;?>
            <?php if(!isset($api)):?>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-xxs-12 gn_aac_25">
                <div class="result outerbox nlt 9lotto">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td style="height:277px;">
                                    <?php if(isset($ads['ads_position_4'])):?>
                                        <?= $ads['ads_position_4'];?>
                                    <?php else:?>
                                        Adverstisement 4 (ads_position_4)
                                    <?php endif;?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>
            <div class="clearfix gn_aac_28"></div>
        </div>
<?php 
if(!isset($results)) return;
$data = json_decode($results);
if(!isset($data->LMC1)&&!isset($data->LMC)&&!isset($data->MTH)) return;
?>   
        <div class="cambodia-content">          
            <p class="gn_aac_23"><a class="anchor" id="section-cam"></a></p>
            <div class="col-xs-12 resultprizelable gn_aac_24 section-header">
                <span>
                    <?= isset($headings['heading_5'])?$headings['heading_5']:'Other Lottery 4D Results';?>
                </span>
            </div>
            <?php if(isset($data->LMC1)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_25">
                <div class="result outerbox lmc">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultlmclable"><img src="/assets/images/lottomacaologo.png?lotterymacao" height="50px" alt="Lotto Macao">
                                </td>
                                <td class="resultlmclable">Lottery Macao
                                    <br> 15:30
                                </td>
                                <td class="resultlmclable">
                                    <span id="lmclive1" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="lmcdd_1"><?=$data->LMC1->DD?></td>
                                <td class="resultdrawdate" id="lmcdn_1" style="text-align:right"><?=$data->LMC1->DN?></td>
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
                                <td class="resultviewtop separator" id="lmcp1_1"><?=$data->LMC1->P1?></td>
                                <td class="resultviewtop separator" id="lmcp2_1"><?=$data->LMC1->P2?></td>
                                <td class="resultviewtop" id="lmcp3_1"><?=$data->LMC1->P3?></td>
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
                                                <td class="resultviewbottom" id="lmcs1_1"><?=$data->LMC1->S1?></td>
                                                <td class="resultviewbottom" id="lmcs2_1"><?=$data->LMC1->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs3_1"><?=$data->LMC1->S3?></td>
                                                <td class="resultviewbottom" id="lmcs4_1"><?=$data->LMC1->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs5_1"><?=$data->LMC1->S5?></td>
                                                <td class="resultviewbottom" id="lmcs6_1"><?=$data->LMC1->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs7_1"><?=$data->LMC1->S7?></td>
                                                <td class="resultviewbottom" id="lmcs8_1"><?=$data->LMC1->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs9_1"><?=$data->LMC1->S9?></td>
                                                <td class="resultviewbottom" id="lmcs10_1"><?=$data->LMC1->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs11_1"><?=$data->LMC1->S11?></td>
                                                <td class="resultviewbottom" id="lmcs12_1"><?=$data->LMC1->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs13_1" colspan="2"><?=$data->LMC1->S13?></td>
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
                                                <td class="resultviewbottom" id="lmcc1_1"><?=$data->LMC1->C1?></td>
                                                <td class="resultviewbottom" id="lmcc2_1"><?=$data->LMC1->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcc3_1"><?=$data->LMC1->C3?></td>
                                                <td class="resultviewbottom" id="lmcc4_1"><?=$data->LMC1->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcc5_1"><?=$data->LMC1->C5?></td>
                                                <td class="resultviewbottom" id="lmcc6_1"><?=$data->LMC1->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcc7_1"><?=$data->LMC1->C7?></td>
                                                <td class="resultviewbottom" id="lmcc8_1"><?=$data->LMC1->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcc9_1"><?=$data->LMC1->C9?></td>
                                                <td class="resultviewbottom" id="lmcc10_1"><?=$data->LMC1->C10?></td>
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
            <?php if(isset($data->LMC)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_25">
                <div class="result outerbox lmc">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultlmclable"><img src="/assets/images/lottomacaologo.png?lotterymacao" height="50px" alt="Lotto Macao">
                                </td>
                                <td class="resultlmclable">Lottery Macao
                                    <br> 19:30
                                </td>
                                <td class="resultlmclable">
                                    <span id="lmclive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="lmcdd"><?=$data->LMC->DD?></td>
                                <td class="resultdrawdate" id="lmcdn" style="text-align:right"><?=$data->LMC->DN?></td>
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
                                <td class="resultviewtop separator" id="lmcp1"><?=$data->LMC->P1?></td>
                                <td class="resultviewtop separator" id="lmcp2"><?=$data->LMC->P2?></td>
                                <td class="resultviewtop" id="lmcp3"><?=$data->LMC->P3?></td>
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
                                                <td class="resultviewbottom" id="lmcs1"><?=$data->LMC->S1?></td>
                                                <td class="resultviewbottom" id="lmcs2"><?=$data->LMC->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs3"><?=$data->LMC->S3?></td>
                                                <td class="resultviewbottom" id="lmcs4"><?=$data->LMC->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs5"><?=$data->LMC->S5?></td>
                                                <td class="resultviewbottom" id="lmcs6"><?=$data->LMC->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs7"><?=$data->LMC->S7?></td>
                                                <td class="resultviewbottom" id="lmcs8"><?=$data->LMC->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs9"><?=$data->LMC->S9?></td>
                                                <td class="resultviewbottom" id="lmcs10"><?=$data->LMC->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs11"><?=$data->LMC->S11?></td>
                                                <td class="resultviewbottom" id="lmcs12"><?=$data->LMC->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcs13" colspan="2"><?=$data->LMC->S13?></td>
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
                                                <td class="resultviewbottom" id="lmcc1"><?=$data->LMC->C1?></td>
                                                <td class="resultviewbottom" id="lmcc2"><?=$data->LMC->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcc3"><?=$data->LMC->C3?></td>
                                                <td class="resultviewbottom" id="lmcc4"><?=$data->LMC->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcc5"><?=$data->LMC->C5?></td>
                                                <td class="resultviewbottom" id="lmcc6"><?=$data->LMC->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcc7"><?=$data->LMC->C7?></td>
                                                <td class="resultviewbottom" id="lmcc8"><?=$data->LMC->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="lmcc9"><?=$data->LMC->C9?></td>
                                                <td class="resultviewbottom" id="lmcc10"><?=$data->LMC->C10?></td>
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
            <?php if(isset($data->MTH)):?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-xxs-12 gn_aac_25">
                <div class="result outerbox mth">
                    <table class="resultView2">
                        <tbody>
                            <tr>
                                <td class="resultmthlable"><img src="/assets/images/mataharilogo.png?matahari" height="50px" alt="Matahari">
                                </td>
                                <td class="resultmthlable">Matahari
                                    <br> 
                                </td>
                                <td class="resultmthlable">
                                    <span id="mthlive" class="live-icon" style="display:none;">
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
                                <td class="resultdrawdate" id="mthdd"><?=$data->MTH->DD?></td>
                                <td class="resultdrawdate" id="mthdn" style="text-align:right"><?=$data->MTH->DN?></td>
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
                                <td class="resultviewtop separator" id="mthp1"><?=$data->MTH->P1?></td>
                                <td class="resultviewtop separator" id="mthp2"><?=$data->MTH->P2?></td>
                                <td class="resultviewtop" id="mthp3"><?=$data->MTH->P3?></td>
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
                                                <td class="resultviewbottom" id="mths1"><?=$data->MTH->S1?></td>
                                                <td class="resultviewbottom" id="mths2"><?=$data->MTH->S2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mths3"><?=$data->MTH->S3?></td>
                                                <td class="resultviewbottom" id="mths4"><?=$data->MTH->S4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mths5"><?=$data->MTH->S5?></td>
                                                <td class="resultviewbottom" id="mths6"><?=$data->MTH->S6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mths7"><?=$data->MTH->S7?></td>
                                                <td class="resultviewbottom" id="mths8"><?=$data->MTH->S8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mths9"><?=$data->MTH->S9?></td>
                                                <td class="resultviewbottom" id="mths10"><?=$data->MTH->S10?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mths11"><?=$data->MTH->S11?></td>
                                                <td class="resultviewbottom" id="mths12"><?=$data->MTH->S12?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mths13" colspan="2"><?=$data->MTH->S13?></td>
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
                                                <td class="resultviewbottom" id="mthc1"><?=$data->MTH->C1?></td>
                                                <td class="resultviewbottom" id="mthc2"><?=$data->MTH->C2?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mthc3"><?=$data->MTH->C3?></td>
                                                <td class="resultviewbottom" id="mthc4"><?=$data->MTH->C4?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mthc5"><?=$data->MTH->C5?></td>
                                                <td class="resultviewbottom" id="mthc6"><?=$data->MTH->C6?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mthc7"><?=$data->MTH->C7?></td>
                                                <td class="resultviewbottom" id="mthc8"><?=$data->MTH->C8?></td>
                                            </tr>
                                            <tr>
                                                <td class="resultviewbottom" id="mthc9"><?=$data->MTH->C9?></td>
                                                <td class="resultviewbottom" id="mthc10"><?=$data->MTH->C10?></td>
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
            <div class="clearfix gn_aac_28"></div>
        </div>
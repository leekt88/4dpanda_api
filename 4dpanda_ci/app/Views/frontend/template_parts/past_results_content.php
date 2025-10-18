<?php 
if(!isset($results)) return;
$data = json_decode($results);?>
<div class="main" style="height: auto !important;">
        <div class="container gn_aa" style="height: auto !important;">
            <div class="col-xs-12 gn_aac_1"><input type="hidden" id="curpos" value="1">
                <?php /*<div class="btn-group-sm btn-group-justified btn-refresh">
                    <div class="btn-group"> <button class="btn btn-sm btn-danger"
                            onclick="javascript:location.href = '#section-wm';">WEST MY<br>西馬</button> </div>
                    <div class="btn-group"> <button class="btn btn-sm btn-danger"
                            onclick="javascript:location.href = '#section-ss';">EAST MY<br>東馬</button> </div>
                    <div class="btn-group"> <button class="btn btn-sm btn-danger"
                            onclick="javascript:location.href = '#section-sg';">SG<br>新加坡</button> </div>
                    <div class="btn-group"> <button class="btn btn-sm btn-danger"
                            onclick="javascript:location.href = '#section-cam';">Cambodia<br>柬埔寨</button> </div>
                </div> */?>
            </div>
            <?= $this->include('frontend/template_parts/malaysia_results_content'); ?>
            <?= $this->include('frontend/template_parts/singapore_results_content'); ?>
            <?= $this->include('frontend/template_parts/westmy_results_content'); ?>
            <?= $this->include('frontend/template_parts/cambodia_results_content'); ?>
            <?= $this->include('frontend/template_parts/others_results_content'); ?>
        </div>
    </div>

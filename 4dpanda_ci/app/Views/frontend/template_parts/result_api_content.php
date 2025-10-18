<?php 
if(!isset($results) || !isset($region)) return;
//$data = json_decode($results);
?>
    <div class="main" style="height: auto !important;">
        <div class="container gn_aa" style="height: auto !important;">
            <div class="col-xs-12 gn_aac_1">
                <input type="hidden" id="curpos" value="1">
            </div>
            <?php if($region == 0 || $region == 1):?>
                <?= $this->include('frontend/template_parts/malaysia_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0 || $region == 3) :?>
                <?= $this->include('frontend/template_parts/singapore_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0 || $region == 2):?>
                <?= $this->include('frontend/template_parts/westmy_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0 || $region == 4):?>
                <?= $this->include('frontend/template_parts/cambodia_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0 || $region == 5):?>
                <?= $this->include('frontend/template_parts/others_results_content'); ?>
            <?php endif;?>
        </div>
    </div>
    <div id="board-result-overlay" style="display: none;"></div>
    <div id="loadmsg" class="loader" style="display: none;"><img class="responsive" src="/assets/images/loader.gif" width="46"
            height="46"><br>Loading ....</div>
    <?php if($region == 0 || $region == 1 || $region == 2 ||$region == 3 ||$region == 4 || $region == 5):?> 
        <script async="" src="/assets/js/4dpanda.js"></script>
    <?php endif;?>
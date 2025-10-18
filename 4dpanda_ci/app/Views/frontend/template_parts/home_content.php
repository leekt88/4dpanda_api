<?php 
if(!isset($results) || !isset($region)) return;
//$data = json_decode($results);
?>
<div class="main" style="height: auto !important;">
        <div class="container gn_aa" style="height: auto !important;">
            <div class="col-xs-12 gn_aac_1">
                <input type="hidden" id="curpos" value="1">
                <?php if(isset($region) && $region == 0):?>
                    <?= $this->include('frontend/template_parts/board_selection'); ?>
                <?php endif;?>
            </div>
            <?php if($region == 0 || $region == 1):?>
                <?= $this->include('frontend/template_parts/malaysia_results_content'); ?>
                <?= $this->include('frontend/template_parts/past_results/malaysia_past_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0 || $region == 3) :?>
                <?= $this->include('frontend/template_parts/singapore_results_content'); ?>
                <?= $this->include('frontend/template_parts/past_results/singapore_past_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0 || $region == 2):?>
                <?= $this->include('frontend/template_parts/westmy_results_content'); ?>
                <?= $this->include('frontend/template_parts/past_results/westmy_past_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0 || $region == 4):?>
                <?= $this->include('frontend/template_parts/cambodia_results_content'); ?>
                <?= $this->include('frontend/template_parts/past_results/cambodia_past_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0 || $region == 5):?>
                <?= $this->include('frontend/template_parts/others_results_content'); ?>
                <?= $this->include('frontend/template_parts/past_results/others_past_results_content'); ?>
            <?php endif;?>
            <?php if($region == 0):?>
                <?= $this->include('frontend/template_parts/home_news_content'); ?>
            <?php endif;?>
            <?php if($region == 'estimated-jackpots'):?>
                <?= $this->include('frontend/template_parts/estimated-jackpots'); ?>
            <?php endif;?>
            <?php if($region == 'special-draw'):?>
                <?= $this->include('frontend/template_parts/special_draw_content'); ?>
            <?php endif;?>
            <?php if(isset($seo_content)):?>
                <div class="seo-container">
                    <?php echo($seo_content['option_value']);?>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div id="board-result-overlay" style="display: none;"></div>
    <div id="loadmsg" class="loader" style="display: none;"><img class="responsive" src="/assets/images/loader.gif" width="46"
            height="46"><br>Loading ....</div>
    <?php if($region == 0 || $region == 1 || $region == 2 ||$region == 3 ||$region == 4 || $region == 5):?> 
        <script async="" src="/assets/js/4dpanda.js"></script>
    <?php endif;?>
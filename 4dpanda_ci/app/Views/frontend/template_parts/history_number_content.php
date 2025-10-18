<?php if(!isset($results) || !isset($meanings) || !isset($type)) return;
?>
<?php if($type == 0):?>
    <?php if($number):?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="text-align:center; padding-bottom:5px;">
            <?php if($number>0):$preview = sprintf('%04d', $number-1);?><a href="<?= base_url('history/').($preview);?>"><?php endif;?>Previous Number<?php if($number>0):?></a><?php endif;?>  |   
            <?php if($number<9999):$next = sprintf('%04d', $number+1);?><a href="<?= base_url('history/').($next);?>"><?php endif;?>Next Number <?php if($number<9999):?></a><?php endif;?>
        </div>
    <?php endif;?>
<div class="resulth2" style="float:left;"><h2>History Results</h2></div>
<table class="table table-condensed table-striped">
    <thead>
        <tr>
            <th style="font-size:16px;">4D No.</th>
            <th style="font-size:16px">4D Prize</th>
            <th style="font-size:16px">Draw No</th>
            <th style="font-size:16px">Date</th>
            <th class="hidden-xs" style="font-size:16px">Day</th>
            <th style="font-size:16px">Type</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $_result):?>
            <?php $_results = (json_decode($_result['data'], true));?>
                <?php foreach ($_results as $result):?>
                    <?php //var_dump($result);exit();?>

                <tr>  
                    <td style="font-size:16px"><?= $result['number'];?></td>
                    <td style="font-size:16px; color:<?= ($result['prize']=='1ST' || $result['prize']=='2ND' || $result['prize']=='3RD')?'#c1272d':'initial'?>;"><?= $result['prize'];?></td>
                    <td style="font-size:16px;"><?= $result['draw_id'];?></td>
                    <td style="font-size:16px;"><?= $result['date'];?></td>
                    <td class=".hidden-xs" style="font-size:16px;"><?= $result['day'];?></td>
                    <td style="font-size:16px;"><img src="<?= $result['image_url'];?>" width="30" alt="<?= $result['name'];?>"/> <?= $result['name'];?></td>
                </tr>
                <?php endforeach;?>
        <?php endforeach?>
    </tbody>
</table>
<?php endif;?>
<?php if($type == 0):?>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="padding:5px;">
        <div class="resulth2"><h3>4D Draw Hit (Times)</h3></div>
        <table class="table table-condensed table-striped">
            <thead>
                <tr style="background:white; height:33px;">
                    <th style="font-size:16px;">Number</th>
                    <td ><img src="<?= base_url('assets/images/lotto/logo_magnum.gif');?>" width="25" alt="Magnum 4D 萬能" class="masterTooltip" title="Magnum 4D 萬能"></td>
                    <td ><img src="<?= base_url('assets/images/lotto/logo_damacai.gif')?>" width="25" alt="Damacai 大馬彩" class="masterTooltip" title="Damacai 大馬彩"></td>
                    <td ><img src="<?= base_url('assets/images/lotto/logo_stoto.gif');?>" width="25" alt="Sports Toto 多多" class="masterTooltip" title="Sports Toto 多多"></td>
                    <td ><img src="<?= base_url('assets/images/lotto/logo_sg4d.gif');?>" width="25" alt="Singapore 4D" class="masterTooltip" title="Singapore 4D"></td>
                    <td ><img src="<?= base_url('assets/images/lotto/logo_cashsweep.gif');?>" width="25" alt="Cash Sweep 大萬" class="masterTooltip" title="Cash Sweep 大萬"></td>
                    <td ><img src="<?= base_url('assets/images/lotto/logo_88.gif');?>" width="25" alt="Sabah 88 沙巴大萬" class="masterTooltip" title="Sabah 88 沙巴大萬"></td>
                    <td ><img src="<?= base_url('assets/images/lotto/logo_stc.gif');?>" width="25" alt="STC 4D 山打根賽馬會" class="masterTooltip" title="STC 4D 山打根賽馬會"></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result):?>
                    <tr>  
                        <td style="font-size:16px"><?= $result['number'];?></td>
                        <td style="font-size:16px"><?= $result['magnum4d'];?></td>
                        <td style="font-size:16px"><?= $result['damacai'];?></td>
                        <td style="font-size:16px"><?= $result['sportstoto'];?></td>
                        <td style="font-size:16px"><?= $result['singapore4d'];?></td>
                        <td style="font-size:16px"><?= $result['cashsweep'];?></td>
                        <td style="font-size:16px"><?= $result['sabah88'];?></td>
                        <td style="font-size:16px"><?= $result['stc4d'];?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="padding:5px;">
        <div class="resulth2"><h3>4D Prize Hits (Times)</h3></div>
        <table class="table table-condensed table-striped">
            <thead>        
                <tr style="background:white; height:33px;">
                    <th style="font-size:16px;">Number</th>
                    <th style="font-size:16px;">1ST</th>
                    <th style="font-size:16px;">2ND</th>
                    <th style="font-size:16px;">3RD</th>
                    <th style="font-size:16px;">SP</th>
                    <th style="font-size:16px;">CON</th>
                </tr>  
            </thead>   
            <tbody>       
                <?php foreach ($results as $result):?>
                    <tr>  
                        <td style="font-size:16px"><?= $result['number'];?></td>
                        <?php $hit = json_decode($result['top_hot'], true);?>
                        <td style="font-size:16px"><?= isset($hit['1ST'])?$hit['1ST']:0;?></td>
                        <td style="font-size:16px"><?= isset($hit['2ND'])?$hit['2ND']:0;?></td>
                        <td style="font-size:16px"><?= isset($hit['3RD'])?$hit['3RD']:0;?></td>
                        <td style="font-size:16px"><?= isset($hit['4-Special'])?$hit['4-Special']:0;?></td>
                        <td style="font-size:16px"><?= isset($hit['5-Consolation'])?$hit['5-Consolation']:0;?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
<?php endif;?>
<div class="resulth2" style="display:flex;"><h2>4D Meaning / Dream</h2></div>
<table class="table table-condensed table-striped">
    <thead>
        <tr>
            <th style="font-size:16px;">4D Number</th>
            <th style="font-size:16px">4D Meaning</th>
            <th style="font-size:16px">Source</th>
        </tr>
    </thead>
    <tbody>
        <?php //var_dump($meanings);?>
        <?php foreach ($meanings as $meaning):?>
            <?php $mns = json_decode($meaning['meaning'], true);?>
            <?php foreach($mns as $mn):?>
            <tr>  
                <td style="font-size:16px"><a href="<?= base_url('history/').$mn['number']?>"><?= $mn['number'];?></a></td>
                <td style="font-size:16px"><?= $mn['meaning'];?></td>
                <td style="font-size:16px;"><img src="<?= $mn['image_url'];?>" width="30"/> <?= $mn['lottery_name'];?></td>
            </tr>
            <?php endforeach;?>
        <?php endforeach;?>
    </tbody>
</table>
<?php if($type == 0 && $number):?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="text-align:center; padding-bottom:5px;">
            <?php if($number>0):$preview = sprintf('%04d', $number-1);?><a href="<?= base_url('history/').($preview);?>"><?php endif;?>Previous Number<?php if($number>0):?></a><?php endif;?>  |   
            <?php if($number<9999):$next = sprintf('%04d', $number+1);?><a href="<?= base_url('history/').($next);?>"><?php endif;?>Next Number <?php if($number<9999):?></a><?php endif;?>
        </div>
<?php endif;?>
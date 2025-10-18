<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header"> 
                <div class="cornered"></div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse-1" aria-expanded="false"> 
                    <span class="sr-only">Toggle navigation</span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                </button> 
                <a class="navbar-brand" href="/"><img
                        src="/uploads/logo.png" height="50" alt="<?=base_url();?>"></a> 
                <div class="navbar-toggle" style="padding:0.5px 5px; float:right;">
                    <ul class="nav navbar-nav" style="margin:-4.5px -15px;">
                        <li class="dropdown"><a href="<?php echo base_url("past-results"); ?>"class="dropdown-toggle" data-toggle="dropdown"
                        role="button" aria-expanded="false" data-target="#navbar-collapse-2"><i class="fas fa-calendar-alt" style="font-size:24px;color:#fbe750;"></i></a>
                        </li>
                    </ul> 
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <ul class="dropdown-menu">
                            <?php
                                $currentDate = date('d-m-Y');
                                for($i = 0; $i < 7; $i++) {
                                    $date = date('d-m-Y', strtotime("-$i days"));?>
                                    <li><a href="<?=base_url('past-results/'.$date);?>"><?=date('d M Y (l)', strtotime($date));?></a></li>
                             <?php }?>
                            </ul>
                        </li>
                    </ul>
                </div>   
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a href="<?php echo base_url(); ?>" class="dropdown-toggle" data-toggle=""
                            role="button">4D Results<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("/results/magnum"); ?>">Magnum</a></li>
                            <li><a href="<?php echo base_url("/results/damacai"); ?>">Da Ma Cai</a></li>
                            <li><a href="<?php echo base_url("/results/toto"); ?>">Toto</a></li>
                            <li><a href="<?php echo base_url("/results/singapore-pools"); ?>">Singapore Pools</a></li>
                            <li><a href="<?php echo base_url("/results/sabah-88"); ?>">Sabah 88</a></li>
                            <li><a href="<?php echo base_url("/results/sandakan"); ?>">Sandakan STC 4D</a></li>
                            <li><a href="<?php echo base_url("/results/sarawak"); ?>">Special Cash Sweep</a></li>
                            <li><a href="<?php echo base_url("/results/gd-lotto"); ?>">GD Lotto</a></li>
                            <li><a href="<?php echo base_url("/results/perdana"); ?>">Perdana</a></li>
                            <li><a href="<?php echo base_url("/results/lucky-hari"); ?>">Lucky Hari Hari</a></li>
                            <li><a href="<?php echo base_url("/results/9-lotto"); ?>">9 Lotto</a></li>
                            <li><a href="<?php echo base_url("/results/lotto-macao"); ?>">Lotto Macao</a></li>
                            <li><a href="<?php echo base_url("/results/matahari"); ?>">Matahari</a></li>
                        </ul>
                    </li> 
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                            role="button">Results by Games<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("malaysia-4d-results"); ?>">Malaysia 4D Results</a></li>
                            <li><a href="<?php echo base_url("sabah-sarawak-4d-results"); ?>">Sabah Sarawak 4D Results</a></li>
                            <li><a href="<?php echo base_url("singapore-4d-results"); ?>">Singapore Pools 4D Results</a></li>
                            <li><a href="<?php echo base_url("cambodia-4d-results"); ?>">Cambodia 4D Results</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                            role="button">4D Tools<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("past-results"); ?>">Past Results</a></li>
                            <li><a href="<?php echo base_url("4d-special-draw"); ?>">4D Specical Draw</a></li>
                            <li><a href="<?php echo base_url("dictionary"); ?>">4D Dictionary</a></li>
                            <li><a href="<?php echo base_url("history"); ?>">4D Number History</a></li>
                            <li><a href="<?php echo base_url("hot-number"); ?>">Hot Numbers</a></li>
                            <li><a href="<?php echo base_url("estimated-jackpot"); ?>">Estimated Jackpots</a></li>
                            <li><a href="<?php echo base_url("4d-result-api"); ?>">4D Result API</a></li>
                            <li><a href="<?php echo base_url("4d-prediction"); ?>">4D Prediction</a></li>
                            <li><a href="<?php echo base_url("malaysia-prize-structure"); ?>">4D Prize Structure</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                            role="button">About Us<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("contact-us"); ?>">Contact Us</a></li>
                            <li><a href="<?php echo base_url("about-us"); ?>">About Us</a></li>
                            <li><a href="<?php echo base_url("faq"); ?>">FAQ</a></li>
                        </ul>
                    </li>
                    <li class="dropdown on-desktop"><a href="<?php echo base_url("past-results"); ?>"class="dropdown-toggle" data-toggle="dropdown"
                    role="button"><i class="fas fa-calendar-alt calendar-icon" style="font-size:24px;"></i></a>
                        <ul class="dropdown-menu">
                        <?php
                                $currentDate = date('d-m-Y');
                                for($i = 0; $i < 7; $i++) {
                                    $date = date('d-m-Y', strtotime("-$i days"));?>
                                    <li><a href="<?=base_url('past-results/'.$date);?>"><?=date('d M Y (l)', strtotime($date));?></a></li>
                                <?php }?>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="https://play.google.com/store/apps/details?id=com.panda.live_4d_results" class="dropdown-toggle" data-toggle=""
                    role="button" target="_blank"><img src="<?php echo base_url(); ?>/images/playstore.png" style="width:25px;"/></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
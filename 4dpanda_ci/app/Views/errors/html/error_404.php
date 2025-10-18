<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Comming soon page</title>

    <style>
        div.logo {
            height: 200px;
            width: 155px;
            display: inline-block;
            opacity: 0.08;
            position: absolute;
            top: 2rem;
            left: 50%;
            margin-left: -73px;
        }
        body {
            height: 100%;
            background: #fafafa;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #777;
            font-weight: 300;
        }
        h1 {
            font-weight: lighter;
            letter-spacing: normal;
            font-size: 3rem;
            margin-top: 0;
            margin-bottom: 0;
            color: #222;
        }
        .wrap {
            max-width: 1024px;
            margin: 5rem auto;
            padding: 2rem;
            background: #fff;
            text-align: center;
            border: 1px solid #efefef;
            border-radius: 0.5rem;
            position: relative;
        }
        pre {
            white-space: normal;
            margin-top: 1.5rem;
        }
        code {
            background: #fafafa;
            border: 1px solid #efefef;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            display: block;
        }
        p {
            margin-top: 1.5rem;
        }
        .footer {
            margin-top: 2rem;
            border-top: 1px solid #efefef;
            padding: 1em 2em 0 2em;
            font-size: 85%;
            color: #999;
        }
        a:active,
        a:link,
        a:visited {
            color: #dd4814;
        }
    </style>
        <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">
</head>

<body id="main" class="with-board-selection">
    <?php //$this->include('frontend/template_parts/header'); ?>
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
                        src="/uploads/logo.png" height="50" alt="4dpanda.com"></a> 
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                            role="button">4D Results<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>">All 4D Results</a></li>
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
                    <li><a href="<?php echo base_url("past-results"); ?>">Past Results</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                            role="button">Results by Region<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("malaysia-4d-results"); ?>">Malaysia 4D Results</a></li>
                            <li><a href="<?php echo base_url("sabah-sarawak-4d-results"); ?>">Sabah Sarawak 4D Results</a></li>
                            <li><a href="<?php echo base_url("singapore-4d-results"); ?>">Singapore Pools 4D Results</a></li>
                            <li><a href="<?php echo base_url("cambodia-4d-results"); ?>">Cambodia 4D Results</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                            role="button">More<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("4d-special-draw"); ?>">4D Specical Draw</a></li>
                            <li><a href="<?php echo base_url("4d-dictionary"); ?>">4D Dictionary</a></li>
                            <li><a href="<?php echo base_url("estimated-jackports"); ?>">Estimated Jackpots</a></li>
                            <li><a href="<?php echo base_url("4d-number-history"); ?>">4D Number History</a></li>
                            <li><a href="<?php echo base_url("hot-number"); ?>">Hot Numbers</a></li>
                            <li><a href="<?php echo base_url("recent-news"); ?>">Recent News</a></li>
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
                </ul>
            </div>
        </div>
    </nav>
    <div class="main" style="height: auto !important;">
        <div class="container gn_aa" style="height: auto !important;">
            <div class="col-xs-12 gn_aac_1">
                <?php if (ENVIRONMENT !== 'production') : ?>
                    <?= nl2br(esc($message)) ?>
                <?php else : ?>
                    <h1 style="text-align:center;padding:35px;">COMMING SOON</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php // $this->include('frontend/template_parts/footer'); ?>
    <div class="footer">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p style="text-align: center;padding:15px;"><a href="/disclaimer" style="color:#fff">Disclaimer</a> | <a
                    href="/privacy-policy" style="color:#fff">Privacy Policy</a> | <a href="/sitemap.xml" style="color:#fff" target="_blank">Sitemap</a><br>Copyright © <?=date("Y"); ?> <a
                    href="https://www.4dpanda.com" style="color:#fff">4dpanda.com</a> All Rights Reserved.</p>
        </div>
    </div>
</div>
</body>
</html>

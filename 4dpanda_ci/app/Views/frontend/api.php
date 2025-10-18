<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex"> 
    <meta name="robots" content="noindex,nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <?php if(isset($meta['title'])):?>
        <title><?= $meta['title'];?></title>
    <?php endif;?>
    <link rel="icon" type="image/x-icon" href="/uploads/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css">
    <?php if(isset($meta['description'])):?>
        <meta name="description" content="<?= $meta['description'];?>">
    <?php endif;?>
    <?php /*if(isset($meta['keywords'])):?>
        <meta name="keywords" content="<?= $meta['keywords'];?>">
    <?php endif;*/?>
    <?php /*if(isset($meta['script'])):?>
        <?= $meta['script'];?>
    <?php endif;*/?>
    <?php /*if(isset($meta['style'])):?>
        <style>
            <?= $meta['style'];?>
        </style>
    <?php endif; */?>
    <link href="/assets/css/jqueryui/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!--<link rel="manifest" href="/manifest.json">-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jqueryui.min.js"></script>
    <?php //var_dump($meta);?>
</head>
<body id="main" class="with-board-selection">
    <?= $this->include('frontend/template_parts/result_api_content'); ?>
    <?php //$this->include('frontend/template_parts/footer'); ?>
    <script src="/assets/js/initialize.js"></script>
</body>
</html>
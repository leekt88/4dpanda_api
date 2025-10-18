<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <?php if(isset($meta['title'])):?>
        <title><?= $meta['title'];?></title>
    <?php endif;?>
    <link rel="icon" type="image/x-icon" href="/uploads/favicon.png">
    <?php if(isset($meta['description'])):?>
        <meta name="description" content="<?= $meta['description'];?>">
    <?php endif;?>
    <?php if(isset($meta['keywords'])):?>
        <meta name="keywords" content="<?= $meta['keywords'];?>">
    <?php endif;?>
    <?php if(isset($meta['script'])):?>
        <?= $meta['script'];?>
    <?php endif;?>
    <?php if(isset($meta['style'])):?>
        <style>
            <?= $meta['style'];?>
        </style>
    <?php endif;?>
    <link href="/assets/css/jqueryui/jquery-ui.css?4" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome -->
    <!--<link rel="manifest" href="/manifest.json">-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/js/jqueryui.min.js?2019551"></script>
    <?php //var_dump($meta);?>
</head>
<body id="main" class="with-board-selection">
    <?= $this->include('frontend/template_parts/header'); ?>
    <?= $this->include('frontend/post/category_content'); ?>
    <?= $this->include('frontend/template_parts/footer'); ?>
</body>
</html>
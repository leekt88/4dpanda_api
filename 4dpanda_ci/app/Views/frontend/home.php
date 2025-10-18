<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <meta name="robots" content="index,follow" />
    <?php if(isset($meta['title'])):?>
        <title><?= $meta['title'];?></title>
    <?php endif;?>
    <link rel="icon" type="image/x-icon" href="/uploads/favicon.png">
    <?php if(isset($meta['description'])):?>
        <meta name="description" content="<?= $meta['description'];?>">
    <?php endif;?>
    <?php if(isset($meta['keywords'])):?>
        <?= $meta['keywords'];?>
    <?php endif;?>
    <?php if(isset($meta['script'])):?>
        <?= $meta['script'];?>
    <?php endif;?>
    <?php if(isset($meta['style'])):?>
        <style>
            <?= $meta['style'];?>
        </style>
    <?php endif;?>
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">
    <link rel="canonical" href="<?= isset($canonical)?$canonical:current_url();?>">
</head>
<body id="main" class="with-board-selection">
    <?= $this->include('frontend/template_parts/header'); ?>
    <?= $this->include('frontend/template_parts/home_content'); ?>
    <?= $this->include('frontend/template_parts/footer'); ?>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/initialize.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome -->
</body>
</html>
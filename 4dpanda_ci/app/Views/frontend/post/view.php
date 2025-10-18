<!-- app/Views/posts/view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <title><?= $post['meta_title'] ?></title>
    <link rel="icon" type="image/x-icon" href="/assets/images/4dpanda-favicon.png">
    <meta name="description" content="<?= $post['meta_description'] ?>">
    <meta name="keywords" content="<?= $post['meta_keywords'] ?>">
    <?php if(isset($meta)):?>
        <?= $meta['script'];?>
    <?php endif;?>
    <link href="/assets/css/jqueryui/jquery-ui.css?4" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css">
    <!--<link rel="manifest" href="/manifest.json">-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/js/jqueryui.min.js?2019551"></script>
</head>
<body id="main">
    <?= $this->include('frontend/template_parts/header'); ?>
    <?= $this->include('frontend/post/post_content'); ?>
    <?= $this->include('frontend/template_parts/footer'); ?>
</body>
</html>
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
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css">
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
<link rel="canonical" href="<?= isset($canonical)?$canonical:current_url();?>">
<link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="/assets/css/custom.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome -->

</head>
<body>
    <?= $this->include('frontend/template_parts/header'); ?>
    <div class="main" style="height: auto !important;">
        <div class="container gn_aa" style="height: auto !important;">
            <div class="col-xs-12 gn_aac_1" style="height: auto !important; min-height: 0px !important;">
                <form method="POST" enctype="multipart/form-data" id="frmPS" style="height: auto !important;">
                    <div class="resultsh3"><h1><?php if(isset($h1)) echo $h1['option_value']; else echo "Past Draw Results";?></h1></div>
                    <div class="col-xs-12" style="padding:5px 10px;">
                        <div class="datepicker-container">
                            <p>Select Date: 
                                <input type="text" id="datepicker" class="form-control" placeholder="Select date" value="<?= isset($selectedDate) ? $selectedDate : ''; ?>">
                                <i class="fas fa-calendar-alt calendar-icon"></i>
                            </p>
                        </div>
                    </div>            
                </form>
            </div>
        </div>
        <span id="results-container">
            <?php if(isset($view)):?>
                <?php echo $view;?>
            <?php endif;?>
        </span>
        <div class="container gn_aa" style="height: auto !important;">
            <?php if(isset($seo_content)):?>
                <div class="seo-container" style="height: auto !important; min-height: 0px !important;">
                    <?php echo($seo_content['option_value']);?>
                </div>
            <?php endif;?>
        </div>
    <?= $this->include('frontend/template_parts/footer'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize datepicker with the selected date if available
            $('#datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
                endDate: "today"  // Chỉ cho phép chọn ngày quá khứ
            });

            // Set the datepicker's date to the selected date if provided
            <?php if(isset($selected_date)): ?>
                $('#datepicker').datepicker('setDate', '<?= $selected_date ?>');
            <?php endif; ?>

            // Open datepicker on calendar icon click
            $('.calendar-icon').on('click', function() {
                $('#datepicker').datepicker('show');
            });

            // Handle date selection
            $('#datepicker').on('changeDate', function() {
                var selectedDate = moment($(this).datepicker('getDate')).format('DD-MM-YYYY');
                window.location.href = '/past-results/' + selectedDate;
            });
        });
    </script>
</body>
</html>

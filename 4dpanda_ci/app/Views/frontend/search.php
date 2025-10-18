<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="<?= isset($canonical)?$canonical:current_url();?>">
    <?php if (isset($number)):?>
        <title><?= $number;?> 4D History & Winning Stats | 4D Panda</title>
        <meta name="description" content="Check 4D winning stats of <?= $number;?> - <?= isset($meta_desc)?$meta_desc:'';?>. <?= $number;?> 4D meaning and drawn history.">
    <?php elseif(isset($word)):?>
        <title><?= ucfirst(str_replace("-"," ",$word));?> | 4D Dictionary & Meaning | 4D Panda</title>
        <meta name="description" content="<?= ucfirst(str_replace("-"," ",$word));?> 4D meaning (大伯公 千字图 万字图): <?=isset($meta_desc)?$meta_desc:'';?>">
    <?php else:?>
        <?php if(isset($meta['title'])):?>
            <title><?= esc($meta['title']); ?></title>
        <?php endif;?>
        <?php if(isset($meta['description'])):?>
            <meta name="description" content="<?= esc($meta['description']); ?>">
        <?php endif;?>
        <?php if(isset($meta['keywords'])):?>
            <meta name="keywords" content="<?= esc($meta['keywords']); ?>">
        <?php endif;?>
    <?php endif;?>
    <?php if(isset($meta['script'])):?>
        <?= $meta['script']; ?>
    <?php endif;?>
    <?php if(isset($meta['style'])):?>
        <style>
            <?= $meta['style']; ?>
        </style>
    <?php endif;?>
    <link rel="icon" type="image/x-icon" href="/uploads/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome -->
</head>
<body>
    <?= $this->include('frontend/template_parts/header'); ?>
    <div class="main" style="height: auto !important;">
        <div class="container gn_aa" style="height: auto !important;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2">
                <div class="resultsh3">
                    <?php if(isset($number)):?>
                        <h1 id="h1title"><?= $number;?> - 4D Results History & Meaning (大伯公 千字图 万字图)</h1>
                    <?php elseif(isset($word)):?>
                        <h1 id="h1title"><?= $word;?> - 4D Meaning (大伯公 千字图 万字图)</h1>
                    <?php else:?>
                        <?= isset($h1) ? $h1['option_value']: "4D Number History" ?>
                    <?php endif;?>
                </div>
                <?php if(isset($type) && ($type == 0)):?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="border:1px solid #ddd; padding:15px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="font-size: 18px;padding:5px;">
                    <form id="searchForm" style="display:inline-block;">
                        <span style="font-weight:bold;">Search Number : &nbsp;</span>
                        <input type="text" name="4dnumber" id="4dnumber" value="" style="width:100px;text-align:center;font-size: 16px;padding:5px 6px 9px 6px;">&nbsp;
                        <button class="btn btn-danger" onclick="fetchHistoryResults();">
                            <i class="fas fa-search"></i> <!-- Use Font Awesome icon instead of glyphicon -->
                        </button>
                    </form>
                        <form style="display:inline-block;"> 
                            <fieldset data-role="controlgroup" data-type="horizontal"> 
                                <input name="permutation" id="permutation2" value="Off" checked="checked" type="hidden"> <label for="permutation2" style="font-size: 16px; display:none;">Off</label> 
                                <input name="permutation" id="permutation" value="On" type="checkbox"> <label for="permutation" style="font-size: 16px;">Permutation (Pao)</label> 
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="font-size: 18px;padding:5px;">
                        <form>
                            <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true"> 
                                <input type="checkbox" name="magnum4d" id="magnum4d" checked=""> 
                                <label for="magnum4d"><img src="/assets/images/lotto/logo_magnum.gif" style="height:30px"></label> 
                                
                                <input type="checkbox" name="damacai" id="damacai" checked=""> 
                                <label for="damacai"><img src="/assets/images/lotto/logo_damacai.gif" style="height:30px"></label> 
                                
                                <input type="checkbox" name="sportstoto" id="sportstoto" checked=""> 
                                <label for="sportstoto"><img src="/assets/images/lotto/logo_stoto.gif" style="height:30px"></label>

                                <input type="checkbox" name="singapore4d" id="singapore4d" checked=""> 
                                <label for="singapore4d"><img src="/assets/images/lotto/logo_sg4d.gif" style="height:30px"></label> 

                                <input type="checkbox" name="cashsweep" id="cashsweep" checked=""> 
                                <label for="cashsweep"><img src="/assets/images/lotto/logo_cashsweep.gif" style="height:30px"></label> 
                                
                                <input type="checkbox" name="sabah88" id="sabah88" checked=""> 
                                <label for="sabah88"><img src="/assets/images/lotto/logo_88.gif" style="height:30px"></label> 

                                <input type="checkbox" name="stc4d" id="stc4d" checked=""> 
                                <label for="stc4d"><img src="/assets/images/lotto/logo_stc.gif" style="height:30px"></label> 
                            </fieldset>
                        </form>
                    </div>
                </div>
                <?php endif;?>
                <?php if(isset($type) && ($type == 1)):?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="font-size: 18px;padding:5px;">
                    <form id="searchForm" style="display:inline-block; width:100%;">
                        <span style="font-weight:bold;">Search Keyword / Your Dream:</span>
                        <input type="text" name="4dnumber" id="4dnumber" value="" style="width:50%;text-align:center;font-size: 16px;padding:5px 6px 9px 6px;">&nbsp;
                        <button class="btn btn-danger" onclick="fetchHistoryResults();">
                            <i class="fas fa-search"></i> <!-- Use Font Awesome icon instead of glyphicon -->
                        </button>
                        <br><br>
                        <p>Visit this page to search number and meaning: <a href="<?=base_url('history');?>">4D History</a></p>
                    </form>
                </div>
                <?php endif;?>
                <?php if(isset($type) && ($type == 2)):?>
                    <style>
                        .col-lg-4{padding-bottom:5px;}
                        .col-lg-4:nth-child(3n){padding-right:5px;}
                        .col-lg-4:nth-child(3n+2){padding-left:5px;}
                    </style>
                    <?php
                    $dict = [
                            'magnum4d' => ['name'=> 'Magnum', 'class'=>'magnum', 'logo'=>'logo_magnum.gif'],
                            'damacai' => ['name'=> 'Damacai', 'class'=>'damacai', 'logo'=>'logo_damacai.gif'],
                            'sportstoto' => ['name'=> 'Sport Toto', 'class'=>'toto', 'logo'=>'logo_toto.gif'],
                            'singapore4d'=> ['name'=> 'Singapore', 'class'=>'sg4d', 'logo'=>'logo_sg4d.gif'], 
                            'cashsweep' => ['name'=> 'Special CashSweep', 'class'=>'sw', 'logo'=>'logo_cashsweep.gif'], 
                            'sabah88' => ['name'=> 'Sabah 88', 'class'=>'sb', 'logo'=>'logo_sabah88.gif'], 
                            'stc4d'=> ['name'=> 'Sandakan', 'class'=>'st', 'logo'=>'logo_stc4d.gif']
                        ];
                    ?>
                    <?php foreach($results as $operator=>$result):?>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2">
                        <div class="result outerbox <?= $dict[$operator]['class'];?>">
                            <table class="resultView2" style="background: transparent; margin:10px;">
                                <tbody>
                                    <tr>
                                        <td class=""><h2 style="color:<?= ($operator=='magnum4d')?'#333':'white';?>;"><?= $dict[$operator]['name'];?> Top 15 Drawn Numbers</h2></td>
                                    </tr>
                                    <tr>
                                        <td class="" style="width:20%"><img src="/assets/images/<?= $dict[$operator]['logo'];?>"
                                        width="50" height="38" alt="<?= $dict[$operator]['name'];?>"></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px;"><span style="color:<?= ($operator=='magnum4d')?'#333':'white';?>;">Results collected since 1990</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered resultView2">  
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">No.</th>
                                        <th style="text-align:center;">Number</th>
                                        <th style="text-align:center;">Draw Hits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach($result as $top):?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><a href="<?= base_url('history/').$top['number'];?>"><?= $top['number'] ?></a></td>
                                                <td><?= $top[$operator] ?></td>
                                            </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <br>
        <div class="container gn_aa" style="height: auto !important;">
            <div id="results-container">
                <?php if(isset($result_html)):?>
                    <?php echo $result_html;?>
                <?php endif;?>
            </div>
        </div>
        <div class="container gn_aa" style="height: auto !important;">
            <?php if(isset($seo_content)):?>
                <div class="seo-container" style="height: auto !important; min-height: 0px !important;">
                    <?= $seo_content['option_value']; ?>
                </div>
            <?php endif;?>
        </div>
    </div>
    <?= $this->include('frontend/template_parts/footer'); ?>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <?php if(isset($type) && (($type ==0) || ($type == 1))):?>
        <!-- Custom JavaScript -->
        <script>
            $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault(); 
                fetchHistoryResults(); 
            });

            $('#4dnumber').on('keypress', function(e) {
                if (e.which === 13) { 
                    $('#searchForm').submit(); 
                    return false; 
                }
            });
        });
    <?php endif;?>
        <?php if(isset($type) && ($type ==0)):?>
            
        // Function to fetch past results via AJAX
        function fetchHistoryResults() {
            var number = $('#4dnumber').val().trim();
            var permutation = $('input[name=permutation]:checked').val();
            var type = <?php echo $type;?>;
            var operators = {
                magnum4d: $('#magnum4d').prop('checked'),
                damacai: $('#damacai').prop('checked'),
                sportstoto: $('#sportstoto').prop('checked'),
                singapore4d: $('#singapore4d').prop('checked'),
                cashsweep: $('#cashsweep').prop('checked'),
                sabah88: $('#sabah88').prop('checked'),
                stc4d: $('#stc4d').prop('checked')
            };
            <?php //if(isset($number)):?> 
                var encodedNumber = encodeURIComponent(number);
                var newUrl = "<?= base_url();?>history/"+ encodedNumber ;
                window.history.pushState({ path: newUrl }, '', newUrl);
            <?php //endif;?>
            // Example of how to send AJAX request
            $.ajax({
                url: '<?php echo base_url("/fetchhistoryresults"); ?>', // URL to your CI controller method
                type: 'POST',
                data: {
                    number: number,
                    permutation: permutation,
                    operators: operators,
                    type: type
                },
                dataType: 'html',
                success: function(response) {
                    $('#results-container').html(response);
                    document.getElementById('h1title').innerText = number + " - 4D Results History & Meaning (大伯公 千字图 万字图)";
                    document.title = number + " 4D History & Winning Stats, Meaning | 4D Panda";
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    var resultsContainer = $('#results-container');
                    resultsContainer.html('<p>No Results.</p>');
                }
            });
        }
        <?php //if(isset($number)):?>
                $(document).ready(function() {
                    var pathname = window.location.pathname;
                    var segments = pathname.split('/');
                    var number = segments[2]; 
                    if (number) {
                        document.getElementById('4dnumber').value = number;
                        //fetchHistoryResults();
                    }
                });
            <?php //endif;?>
        <?php endif;?>
        <?php if(isset($type) && ($type ==1)):?>
        // Function to fetch past results via AJAX
        function fetchHistoryResults() {
            var number = $('#4dnumber').val().trim();
            var type = <?php echo $type;?>;
            // Example of how to send AJAX request
            // Cập nhật URL mà không tải lại trang
            <?php //if(isset($number)):?> 
                var formattedKeyword = number.replace(/\s+/g, '-').toLowerCase();
                var newUrl = "<?= base_url();?>dictionary/" + encodeURIComponent(formattedKeyword);
                //var encodedNumber = encodeURIComponent(number);
                //var newUrl = "<?= base_url();?>dictionary/"+ encodedNumber ;
                window.history.pushState({ path: newUrl }, '', newUrl);
            <?php //endif;?>
            $.ajax({
                url: '<?php echo base_url("/fetchhistoryresults"); ?>', // URL to your CI controller method
                type: 'POST',
                data: {
                    number: number,
                    type: type
                },
                dataType: 'html',
                success: function(response) {
                    $('#results-container').html(response);
                    var keyword = capitalizeWords(number);
                    document.getElementById('h1title').innerText = keyword + " - 4D Meaning (大伯公 千字图 万字图)";
                    // Cập nhật thẻ <title>
                    document.title = keyword + " | 4D Dictionary & Meaning | 4D Panda";
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    var resultsContainer = $('#results-container');
                    resultsContainer.html('<p>No Results.</p>');
                }
            });
        }
        <?php //if(isset($number)):?>
                $(document).ready(function() {
                    var pathname = window.location.pathname;
                    var segments = pathname.split('/');
                    var number = decodeURIComponent(segments[2]); 
                    if (number!='undefined') {
                        var formattedKeyword = capitalizeWords(number); 
                        document.getElementById('4dnumber').value = formattedKeyword;
                        //fetchHistoryResults();
                    }
                });
            <?php //endif;?>
            function capitalizeWords(str) {
                return str.split('-').map(word => {
                    return word.charAt(0).toUpperCase() + word.slice(1);
                }).join(' ');
            }
        <?php endif;?>
    </script>
</body>
</html>

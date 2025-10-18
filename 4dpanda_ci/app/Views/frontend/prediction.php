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
    <link rel="canonical" href="<?= isset($canonical)?$canonical:current_url();?>">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cousine:700&display=swap rel="stylesheet" type="text/css">
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
    <link href="/assets/css/jqueryui/jquery-ui.css?4" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome -->
    <!--<link rel="manifest" href="/manifest.json">-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/js/jqueryui.min.js?2019551"></script>
    <?php //var_dump($meta);?>
    <style>
    .slotter {
        height: 100px;
        display: block;
        overflow: hidden;
        position: relative;
        white-space: nowrap;
        margin-top:7px;
        font: 700 120px / 100px 'Cousine', sans-serif;
    }
    .slotter .digits {
        float: left;
        position: relative;
        line-height: 100px;
        width:67px;
    }   
    </style>
</head>
<body id="main" class="with-board-selection">
    <?= $this->include('frontend/template_parts/header'); ?>
    <div id="content" class="container gn_aa">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2">
            <div class="resultsh3"><?= isset($h1) ? $h1['option_value']: "<h1>What's my lucky number today!</h1>" ?></div>
            <div class="">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2">
                    <div class="prediction-banner">
                        <?php if(isset($ads['prediction_banner'])):?>
                            <?=$ads['prediction_banner'];?>
                        <?php else: ?>
                            <img src="https://4dpanda.com/uploads/banners/4d-prediction-4dpanda.png" alt="4Dpanda" style="width:95%;border: 5px solid #E7E9EB;">
                        <?php endif;?>
                    </div>
                    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12 gn_aac_2" style="padding-left:5px;">
                    <div class="">
                        <div id="lucky-number" class="jackpot slotter"></div>
                        <div id="anchor" style="padding-top:10px;"></div>
                    </div>
                    <div class="" style="padding-top:20px;"><button class="btn btn-danger btn-spin">Spin Again</button></div>                
                    <div class="seo-container">
                        <?= isset($seo_content)?$seo_content['option_value']:'';?>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <br>
        <div class="clearfix"></div>
        <div class="" style="padding-top:30px;">
            <div class="resultsh3" style="display:flex;">4D Dictionary - Number Meaning</div>
            <div class="" style="padding:5px;">
                <span style="font-weight:bold;">Search Keyword / Your Dream:</span>
                <input type="text" class="" id="dream-parse" placeholder="Enter your dream here..." require style="width:50%;text-align:center;font-size: 16px;padding:5px 6px 9px 6px;">
                <button class="btn btn-danger btn-search" type="button">Search</button>
            </div>
            <br><br>
            <p style="padding-left:5px;">Visit this page to search number and meaning: <a href="<?=base_url('history');?>">4D History</a></p>

            <div class="clearfix"></div>
            <br>
            <div class="col-xs-12">
                <a name="result"></a>
                <div id="number-result"></div>
            </div>
        </div>
    </div>
    </div>
    <?= $this->include('frontend/template_parts/footer'); ?>
    <script>
        $.fn.slotter = function(str, options) {
        options = $.extend({}, {
                duration: 3000,
                easing: "swing",
                complete: $.noop
            }, options);
            
            return this.each(function(){
                var initialText = $(this).text();
                
                str = (str || this.innerText) + "";
                var spinner = $(this);
                
                var numbers = "0123456789,;.:-_?!@#$%^&*()",
                    letters = "abcdefghijklmnopqrstuvwxyz'\"";
                
                var markup = "",
                    digits = [];
                
                for (var i = 0; i < str.length; i++) {
                    var char = str.charAt(i),
                        isNum = char.match(/[0-9]|[,;.:\-_?!@#$%^&*()]+/),
                        isLower = char.match(/[a-z]/),
                        placeholder = isNum ? numbers : letters[!isLower ? "toUpperCase" : "toLowerCase"]();
                    
                    if ( initialText != "" ) {
                        var initialChar = initialText.charAt(i);
                        var index = placeholder.indexOf(initialChar);
                        
                        if ( index != -1 ) {
                            placeholder = placeholder.substr(0, index) + placeholder.substr(index + 1);
                            
                            placeholder = initialChar + placeholder;
                            //console.log(initialChar, placeholder);
                        }
                    }
                    
                    digits[i] = placeholder.indexOf(char);
                
                    markup += "<span class='digits'>";
                    for (var c = 0; c < placeholder.length; c++) {
                        markup += placeholder.charAt(c) + "<br />";
                    }
                    markup += "</span>";
                }
                
                var speed = $.speed(options.duration, options.easing, options.complete);
                var done = false;
                speed.complete = function(){
                    if(done) return;
                    link = "<a href='/history/" +str +"' target='_blank'>"+ str + "</a>"
                    anchor = "<a href='/history/" +str +"' target='_blank'>Click here to check winning history and meaning</a>"
                    spinner.html(link);
                    $('#anchor').html(anchor);
                    options.complete();
                    done = true;
                };

                spinner.html(markup);
                spinner.find(".digits").each(function (i) {
                    var offsetTop = -100 * digits[i];
                    $(this).animate({
                        top: offsetTop
                    }, speed);
                });
            });
        };
    </script>
    <script>
        (function($) {
            var spin = function() {
                var number = Math.floor(Math.random() * 10000) + 1;
                
                if ( number > 9999 ) {
                    number = 9999;
                }
                
                if ( number < 10 ) {
                    number = "000" + number;
                } else if ( number < 100 ) {
                    number = "00" + number;
                } else if ( number < 1000 ) {
                    number = "0" + number;
                }
                
                $("#lucky-number").slotter(number);
            };
            
            var searchNumber = function() {
                var keyword = $("#dream-parse").val();
                
                if ( $.trim(keyword) != "" ) {
                    $.ajax({
                        url: '<?php echo base_url("/fetchhistoryresults"); ?>',
                        type: "POST",
                        dataType: "html",
                        data: {
                            number: keyword,
                            type: 1
                        },
                        success: function(html) {
                            $("#number-result").html(html);
                            window.location.hash = "#result";
                        },
                        error: function(xhr, error, message) {
                            
                        }
                    });
                }
            };
            
            $(".btn-spin").click(function(e) {
                e.preventDefault();
                
                spin.call(window);
            });
            
            $(".btn-search").click(function(e) {
                e.preventDefault();
                
                searchNumber.call(window);
            });
            
            $("#dream-parse").keyup(function(e) {
                
                if ( e.which == 13 ) {
                    searchNumber.call(window);
                }
            });
            
            $("#number-result").on("click", "a", function(e) {
                if ( !$(this).data("no-prevent") ) {
                    e.preventDefault();
                } else {
                    return ;
                }
                
                var href = $(this).attr("href");
                
                if ( $.trim(href) == "" ) {
                    return ;
                }
                
                $.ajax({
                    url: href,
                    type: "get",
                    dataType: "html",
                    success: function(html) {
                        $("#number-result").html(html);
                        
                        window.location.hash = "#result";
                    }
                });
            });
            
            spin.call(window);
        })(jQuery);
    </script>
    
</body>
</html>
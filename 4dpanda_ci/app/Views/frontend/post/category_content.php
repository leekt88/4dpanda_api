<?php if(!isset($news)) return;
                //var_dump($news['posts']);exit();
            ?>
<div class="main" style="height: auto !important;">
<div class="container gn_aa" style="height: auto !important;">
    <div class="col-xs-12 gn_aac_1 product-articles">
            <section class="news pt-0 gn_aac_30">
                <div class="mt-md-5" style="background-color: #fff">
                    <div class="resultsh3"><h1>Recent News</h1></div>
                    <ul class="d-lg-flex list-unstyled image-block justify-content-center px-lg-0 mx-lg-0">
                        <?php foreach ($news['posts'] as $new):?>
                        <li class="col-lg-4 col-md-4 image-block full-width p-3" style="padding:5px;">
                            <div class="image-block-inner"> <a class="mh-100"
                                    href="<?= base_url('/recent-news/'.$new['uri']);?>"> <img
                                        src="<?= $new['image'];?>" class="img-responsive w-100"></a> <span
                                    class="hp-posts-cat"></span>
                                <h4 class="mt-3"><a href="<?= base_url('/recent-news/'.$new['uri']);?>"><?= $new['title'];?></a></h4> <a
                                    href="<?= base_url('/recent-news/'.$new['uri']);?>" class="read-more">Read
                                    more &gt;</a>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <div class="col-xs-12 gn_aac_1">
        <?php if(isset($seo_content)):?>
                <div class="seo-container">
                    <?php echo($seo_content['option_value']);?>
                </div>
        <?php endif;?>
    </div>
</div>
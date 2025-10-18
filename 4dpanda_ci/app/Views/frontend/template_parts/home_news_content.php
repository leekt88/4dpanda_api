            <?php if(!isset($news)) return;
                //var_dump($news['posts']);exit();
            ?>
            <section class="news pt-0 gn_aac_30">
                <div class="mt-md-5" style="background-color: #fff">
                    <div class="resultsh3"><h2 class="mx-4 my-0 text-center">Recent News</h2></div>
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
                    <div style="text-align: center;width:100%;margin-bottom:10px"> <a class="btn btn-danger"
                            style="width:100%;font-weight:700;font-size:18px" href="/recent-news">More News</a> </div>
                </div>
            </section>
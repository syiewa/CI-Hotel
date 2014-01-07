<?php
            ?>
            <div id="carousel-example-generic" class="carousel slide" >
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php $i = 1; ?>
                    <?php foreach ($slides as $slide): ?>
                        <?php
                        if ($i == 1) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }
                        ?>
                        <div class="item <?php echo $active; ?> peopleCarouselImg">
                            <img src="<?php echo base_url($slide->slide_image); ?>" class="img-responsive peopleCarouselImg">
                            <div class="carousel-caption">
                                <h3 style="color:white"><?php echo $slide->slide_title ?></h3>
                                <p><?php echo $slide->slide_desc; ?></p>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="icon-next"></span>
                </a>
            </div>
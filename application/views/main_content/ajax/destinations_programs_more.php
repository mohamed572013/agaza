<?php if (!empty($programs)) { ?>
        <?php foreach ($programs as $program) { ?>
            <div class="col-md-4 program_item_container">
                <div class="list-item-entry fr">
                    <div class="hotel-item style-3 bg-white">
                        <div class="table-view">
                            <div class="radius-top cell-view">
                                <?php $program_title_url = str_replace(' ', '_', $program->program_title) ?>
                                <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $program->program_id) ?>">  <img src="<?= base_url('uploads/programs/' . $program->image); ?>" alt=""></a>
                            </div>
                            <div class="title hotel-middle clearfix cell-view">

                                <h4><b>  <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $program->program_id) ?>"><?= $program->program_title ?></a></b></h4>




                                <div class="rate-wrap">
                                    <div class="date list-hidden fr"><strong><strong><?= $program->nights + 1; ?></strong>ايام <?= $program->nights ?></strong>ليال </div>
                                    <div class="rate fl">
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                    </div>

                                </div>
                                <p class="f-14 grid-hidden">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص</p>
                            </div>
                            <div class="title hotel-right clearfix cell-view">
                                <div class="hotel-person color-dark-2">يبدا من <span class="color-blue"><?= $program->price_start_from ?></span>  جنيها</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
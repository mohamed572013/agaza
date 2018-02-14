<?php if ($all_programs) { ?>
        <?php foreach ($all_programs as $all_program) { ?>
            <div class="list-item-entry hvr-float-shadow fr">
                <div class="hotel-item style-3 bg-white">
                    <div class="table-view">
                        <div class="radius-top cell-view">
                            <?php $program_title_url = str_replace(' ', '_', $all_program->program_title) ?>
                            <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $all_program->program_id) ?>">  <img src="<?= base_url('uploads/programs/' . $all_program->image); ?>" alt=""></a>
                        </div>
                        <div class="title hotel-middle clearfix cell-view">

                            <h4><b>  <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $all_program->program_id) ?>"><?= $all_program->program_title ?></a></b></h4>




                            <div class="rate-wrap">
                                <div class="date list-hidden fr"><strong>5</strong>ليال <strong>4</strong>ايام</div>
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
                            <div class="hotel-person color-dark-2">يبدا من <span class="color-blue"><?= $all_program->price_start_from ?></span>  جنيها</div>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
<?php if ($all_programs_count > 6 && $all_programs_count != $new_limit) { ?>
        <div id="show-more-box">
            <a href="" class="btn btn-default col-md-12 show-more-programs" style="background-color:#fff;"  data-all-programs-count="<?= $all_programs_count ?>" data-current-length="<?= count($all_programs) ?>">المزيد</a>
        </div>
    <?php } ?>
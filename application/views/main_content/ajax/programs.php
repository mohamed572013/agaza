<?php if ($all_programs) { ?>
<input type="hidden" value="<?= $programs_count ?>" id="programs_count" name="">
                                <?php foreach ($all_programs as $all_program) { ?>

                                    <div class="col-sm-6 pull-left wow fadeIn program-item" data-wow-delay="0.1s">
                                        <div class="img_wrapper">


                                            <!-- End tools i-->
                                            <div class="img_container"  style="height: 250px;width:100%;">
                                                <?php $program_title_url = str_replace(' ', '_', $all_program->program_title) ?>
                                                <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $all_program->program_flight_id . '-' . $all_program->program_id) ?>">
                                                    <img style="height: 100%;width:100%;" src="<?= $all_program->agaza_programs_image_url . 'uploads/programs/' . $all_program->agaza_image ?>" width="800" height="533" class="img-responsive" alt="<?= $all_program->program_title ?>">
                                                    <div class="short_info_grid">
                                                        <small><strong><?= arabicDate($all_program->going_date) . ' الى ' . arabicDate($all_program->return_date); ?></strong></small>
                                                        <h1><?= $all_program->program_title ?></h1>
                                                        <em><?= $all_program->nights + 1 ?> ايام | <?= $all_program->nights ?> ليالى</em>
                                                        <em>  تبدأ من <?= $all_program->price_start_from ?> <?= $all_program->currency_sign ?></em>

                                                        <p>
                                                            المزيد
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- End img_wrapper -->
                                    </div>
                                    <!-- End col-md-6 -->
                                <?php } ?>
                            <?php } ?>
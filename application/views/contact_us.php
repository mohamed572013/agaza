<!-- Page Header
============================================================== -->
<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?= base_url("assets/front/images/page-title-bg.jpg"); ?>'); background-size: cover ">
	<div class="page-head-wrap">
        <h1 class="page-head-title"><span> اتصل بنا      </span></h1>
	</div>
</div>

<div class="container">
    <div class="row">
        <!-- News Wrap
        ============================================================== -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="news-wrap">



				<div id="sectiona" class="tab-pane fade in active">
					<div class="pro-dtl-text">
						<h3 class="main-widget-title">   اتصل بنا    :</h3> 

						<div class="clearfix"></div>
						<br/>
						<div class="row">
							<form method="post" action="#" id="contact_form">

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>الاسم:</label>
                                    <input type="text" name="name" id="name" required="required">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>البريد الالكنترونى:</label>
                                    <input type="email" name="email" id="email"  required="required">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>الموضوع:</label>
                                    <input type="text" name="subject" id="subject"  required="required">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>الرسالة:</label>
                                    <textarea cols="10" rows="5" name="message" id="message"  required="required"></textarea>
                                </div>
								<div class="col-lg-12" id="contact_form_error">

								</div>
								<div class="clearfix"></div>
 								<br/>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="submit" id="send" value="ابعت رسالتك">
                                </div>
							</form>
						</div>
					</div>
				</div>









			</div>
		</div>



		<!-- Sidebar
		============================================================== -->
		<?php $this->load->view("components/side_bar"); ?>


	</div></div>
 

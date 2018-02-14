<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHotelExtraServices" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHotelExtraServicesLabel"></h4>
            </div>

           
        </div>
    </div>
</div>
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">



            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">حجز برامج أجازة بوك</h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">

                                <table class="table table-bordered table-striped table-bottomless ">
                                    <thead>
                                        <tr>
                                            <th>الإسم</th>
                                            <th>التليفون</th>
                                            <th>البريد الإلكترونى</th>
                                            <th>إسم البرنامج</th>
                                            <th>تاريخ التسجيل</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($getAgaza)) { ?>
                                    <?php foreach ($getAgaza as $key => $value) {  ?>
                                        <tr>
                                            <td><?= $value->fname . " " . $value->lname ?></td>
                                            <td><?= $value->phone ?></td>
                                            <td><?= $value->email ?></td>
                                            <td><?= $value->agaza_title_ar ?></td>
                                            <td><?= $value->created ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php } ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                            <!--Table Wrapper Finish-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



</section>
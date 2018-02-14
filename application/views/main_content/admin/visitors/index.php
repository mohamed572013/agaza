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
                            <h3 class="panel-title">زوار أجازة بوك</h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">

                                <table class="table table-bordered table-striped table-bottomless ">
                                    <thead>
                                        <tr>
                                            <th>رقم التليفون</th>
                                           
                                            <th>البريد الإلكترونى</th>
                                          
                                            <th>تاريخ التسجيل</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($visitors)) { ?>
                                    <?php foreach ($visitors as $key => $value) {  ?>
                                        <tr>
                                            
                                            <td><?= $value->phone ?></td>
                                            <td><?= $value->email ?></td>
                                            
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
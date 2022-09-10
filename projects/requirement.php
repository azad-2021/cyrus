<?php 
include"connection.php";
include"query.php";
?>

<!doctype html>
    <html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Material Requirement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Anant Singh" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/cyrus logo.png">

        <!-- jquery.vectormap css -->
        <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
        <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    </head>

    <body data-sidebar="dark" data-topbar="dark">

        <!-- <body data-layout="horizontal" data-topbar="dark"> -->

            <!-- Begin page -->
            <?php 

            include"header.php";
            include"sidebar.php";
            include"modals.php";

            ?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Material Requirement</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cyrus</a></li>
                                            <li class="breadcrumb-item active">Material Requirement</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <form class="form-control rounded-corner">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="recipient-name" class="col-form-label">Select Organization</label>

                                    <select class="form-control rounded-corner" id="OrgCodeRequirement">
                                        <option value="">Select</option>
                                        <?php

                                        $result=mysqli_query($con,$QueryOrg);
                                        if (mysqli_num_rows($result)>0)
                                        {
                                          while ($arr=mysqli_fetch_assoc($result))
                                          {
                                            ?>
                                            <option value="<?php echo $arr['OrganizationCode']; ?>"><?php echo $arr['Organization']; ?></option>
                                            <?php
                                        }}?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="recipient-name" class="col-form-label">Select Division</label>
                                    <select class="form-select form-control rounded-corner" id="DivisionCodeRequirement">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="recipient-name" class="col-form-label">Select Order ID</label>
                                    <select class="form-select form-control rounded-corner" id="OrderIDRequirement">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="col-lg-12" style="margin-top:20px;">
                                    <textarea class="form-control rounded-corner" id="OrderDesc" disabled placeholder="Order Discription"></textarea>
                                </div>

                            </div>

                        </form>


                        <form class="form-control rounded-corner" style="margin-top: 20px;">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="recipient-name" class="col-form-label">Select Organization</label>
                                    <input type="text" class="form-control rounded-corner" name="ScheduleName">
                                </div>
                                <div class="col-lg-4">
                                    <label for="recipient-name" class="col-form-label">Select Division</label>
                                    <select class="form-select form-control rounded-corner" id="DivisionCodeRequirement">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="recipient-name" class="col-form-label">Select Order ID</label>
                                    <select class="form-select form-control rounded-corner" id="OrderIDRequirement">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="col-lg-12" style="margin-top:20px;">
                                    <textarea class="form-control rounded-corner" id="OrderDesc" disabled placeholder="Order Discription"></textarea>
                                </div>

                            </div>

                        </form>


                    </div><!-- end col -->

                </div><!-- end col -->

            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Cyrus Electronics.
                        </div>

                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>


    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

    <script src="assets/js/pages/form-advanced.init.js"></script>


    <!-- jquery.vectormap map -->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

    <script src="assets/js/pages/dashboard.init.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script type="text/javascript">

        function err(msg){
            Swal.fire({
                title: 'error!',
                text: msg,
                icon: 'error',

            })
        }




        $(document).on('change', '#OrgCodeRequirement', function(){

            var OrgCode=$(this).val();
            if(OrgCode){
                $.ajax({
                  type:'POST',
                  url:'select.php',
                  data:{'OrgCode':OrgCode},
                  success:function(result){
                    $('#DivisionCodeRequirement').html(result);

                }
            }); 
            }else{
                $('#DivisionCodeRequirement').html('<option value="">Division</option>');
            }
        });


        $(document).on('change', '#DivisionCodeRequirement', function(){

            var DivisionCode=$(this).val();
            if(DivisionCode){
                $.ajax({
                  type:'POST',
                  url:'select.php',
                  data:{'DivisionCodeRequirement':DivisionCode},
                  success:function(result){
                    //alert(result);
                    $('#OrderIDRequirement').html(result);

                }
            }); 
            }else{
                $('#OrderIDRequirement').html('<option value="">Order ID</option>');
            }
        });


        $(document).on('change', '#OrderIDRequirement', function(){

            var OrderID=$(this).val();
            if(OrderID){
                $.ajax({
                  type:'POST',
                  url:'select.php',
                  data:{'OrderIDRequirement':OrderID},
                  success:function(result){
                    //alert(result);
                    document.getElementById("OrderDesc").value=result;
                    //$('#OrderIDRequirement').html(result);

                }
            }); 
            }
        });


    </script>
</body>

</html>
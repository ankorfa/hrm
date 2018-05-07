<?php
$log_data = $this->session->userdata('hr_logged_in');
$username = $log_data['name'];
$userid = $log_data['id'];
$userimage = $log_data['user_image'];
$user_group = $log_data['user_group'];
//$user_group = $log_data['user_group'];
//echo "===========".$userid."".$username."".$userimage;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <title><?php echo $title; ?></title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Favicon -->
        <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>assets/img/icon.ico"/>

        <!-- Web Fonts -->
        <!--<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-OpenSans.css">

        <!-- CSS Global Compulsory -->
        <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

        <!-- CSS Header and Footer -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/headers/header-default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/footers/footer-v1.css">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/animate.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/line-icons/line-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
        <!--<link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
        <!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/hover-effects/css/custom-hover-effects.css">

        <!-- CSS Page Style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pages/page_search.css">

        <!-- CSS Page Style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pages/page_404_error.css">

        <!-- CSS Theme -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-colors/default.css" id="style_color">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-skins/dark.css">

        <!-- CSS Customization -->
        <link href="<?php echo base_url(); ?>assets/css/select2.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/image-hover/css/img-hover.css">

        <!-- CSS log-in -->
<!--        <link rel="stylesheet" href="<?php // echo base_url();        ?>assets/css/login.css" />
        <link rel="stylesheet" href="<?php // echo base_url();        ?>assets/plugins/magic/magic.css" />-->

        <!-- data table -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dataTables/dataTables.bootstrap.css" />

        <!-- JS -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/validation.js"></script>

        <!-- select 2 -->
        <script src="<?php echo base_url(); ?>assets/js/select2.js"></script>

        <!-- Print -->
        <script src="<?php echo base_url(); ?>assets/js/jQuery.print.js"></script>

        <!-- Time Picker-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/timepicker/bootstrap-timepicker.css" type="text/css" media="screen">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/timepicker/bootstrap-timepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.chained.min.js"></script>

        <script src="<?php echo base_url() ?>assets/js/ajaxfileupload.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slicknav.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
        <link href="<?php echo base_url(); ?>assets/slimimage/slim/slim.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/bootstrap-datepicker/css/bootstrap-datepicker.css">
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var user_group = '<?php echo $user_group; ?>';
            var userid = '<?php echo $userid; ?>';
        </script>
    </head>
    <body class="">
        <div class="wrapper">
            <!--=== Header ===-->
            <div class="header">
                <div class="top-bar">
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-2 col-xs-5" >
                                <div class="pull-right" id="company_logo_div">
                                    <!-- Company Logo -->
                                    <?php
                                    if ($this->user_group != 1 || $this->user_group != 2 || $this->user_group != 3) {
                                        $logo = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_logo');
                                        if ($logo != "") {
                                            $src = base_url() . "uploads/companylogo/" . $logo;
                                            ?>
                                            <a href="<?php echo base_url() . 'Con_dashbord' ?>">
                                                <img src="<?php echo $src; ?>" alt="Logo" height="50px;">
                                            </a>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <!-- Logo -->
    <!--                                <a  href="<?php // echo base_url() . 'Con_dashbord'    ?>">
                                        <img src="<?php // echo base_url();    ?>assets/img/hrc_logo.png" alt="Logo" height="50px;">
                                    </a>				-->
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-7">
                                <div class="app-title pull-left" id="company_name_div">
                                    <?php
                                    if ($this->user_group != 1 || $this->user_group != 2 || $this->user_group != 3) {
                                        $show_in_header = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'show_in_header');
                                        //echo $show_in_header;
                                        if ($show_in_header == 0) {
                                            $com_name = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_full_name');
                                        } else {
                                            $com_name = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_short_name');
                                        }
                                        ?>
                                        <h2 style="color: #444; font-size: 14px;  " class="text-primary"><b> <?php //echo $com_name;   ?> </b></h2>
                                        <?php
                                    }
                                    ?>
                                </div>		
                                <!--                                <div class="app-title">
                                                                    <h2 style="color: #444; font-size: 14px;  " class="text-primary"> Powered By HRC HRM </h2>
                                                                </div>			-->
                            </div>
                            <div class="col-md-1 col-xs-6 right-align" >

                            </div>
                            <div class="col-md-3 col-xs-6 no-padding-left" >

                            </div>
                            <!--<div class="col-md-2">
                                <div id="clock" class="pull-right" style="margin-top: 15px;"></div>
                            </div>-->
                            <!-- <div class="col-md-3">
                                <div class="container">
                                    <div class="row pull-right padding-top-5">
                                        <div class="search">
                                            <input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" />
                                            <button type="submit" class="btn btn-default btn-sm srbtn">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-md-3 col-xs-12">
                                <div class="row btn-group pull-right user-option">
                                    <?php
//echo $module_id;
//if ($module_id != 0) {
                                    ?>
                                    <!-- <div class="configurewizard pull-left">
                                             <a class="btn btn-u" href="<?php //echo base_url() . 'Con_configaration'           ?>">Configuration Wizard</a>
                                         </div>-->
                                    <a href="" class = "dropdown-toggle" data-toggle = "dropdown">
                                        <!--<i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;-->
                                        <?php
                                        if ($userimage == "") {
                                            $src = base_url() . "uploads/blank.png";
                                        } else {
                                            $src = base_url() . "uploads/user_image/" . $userimage;
                                        }
                                        ?>
                                        <img class="rounded-x" src="<?php echo $src; ?>" alt="" height="40" width="40">

                                        <?php echo $username; ?>&nbsp;&nbsp;
                                        <span class = "caret"></span>
                                    </a>
                                    <ul class = "dropdown-menu">
                                        <li><a href = "#"><i class="fa fa-cog"></i>Settings</a></li>
                                        <?php if ($this->user_group == 1 || $this->user_group == 12) { ?>
                                            <li><a href = "#" onclick="mail_settings();" ><i class="fa-li fa fa-spinner fa-spin"></i> Mail Settings </a></li>
                                        <?php } ?>
                                        <li><a href = "<?php echo base_url() . "Con_User/view_user_data/" . $userid ?>"><i class="fa fa-eye"></i>View Profile</a></li>
                                        <li><a href = "#" onclick="change_password();"><i class="fa fa-key"></i> Change Password </a></li>
                                        <li><a href = "<?php echo base_url() . 'index.php/Chome/logout' ?>"><i class="fa fa-sign-out"></i>Log Out</a></li>
                                    </ul>
                                    <?php
//} else {
                                    ?>
                                    <!--<div class="col-sm-12">
                                        <div class="configurewizard">
                                        <a class="btn btn-u" href="<?php //echo base_url() . 'Con_dashbord'           ?>">Configure Later</a>
                                        </div>
                                    </div>-->
                                    <?php
//}
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/end container-->

                <?php
                if ($module_id != 0) {
                    ?>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse ">
                        <div class="container">
                            <div class="row">	&nbsp;					
                                <!-- Top Menu -->
                                <ul class="nav navbar-nav">
                                    <?php
                                    $user_data = $this->session->userdata('hr_logged_in');
                                    $user_module = $user_data ['user_module'];
                                    $user_module = explode(",", $user_module);
                                    $user_module = array_map('intval', $user_module);
                                    //print_r($user_module);

                                    $this->db->order_by("sequence", "asc");
                                    $this->db->where(array('status' => 1));
                                    $this->db->where_in('id', $user_module);
                                    $module_query = $this->db->get('main_module');

                                    foreach ($module_query->result() as $key):
                                        $module_link = base_url() . $key->module_link . '/' . 'index' . '/' . $key->id;
                                        ?>
                                        <li><a id="<?php echo $key->module_link . "_mod" ?>" href="<?php echo $module_link; ?>" ><?php echo $key->module_name ?></a></li>
                                        <?php
                                    endforeach;
                                    ?>
                                </ul>
                                <!-- End Top Menu -->
                            </div>
                        </div><!--/end container-->
                    </div><!--/navbar-collapse-->
                    <?php
                }
                else {
                    ?>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse ">
                        <div class="container">
                            <div class="row">						
                                <!-- Top Menu -->
                                <ul class="nav navbar-nav">
                                    <li><a  href="" >Company List</a></li>
                                </ul>
                                <!-- End Top Menu -->
                            </div>
                        </div><!--/end container-->
                    </div><!--/navbar-collapse-->
                    <?php
                }
                ?>
            </div>
            <!--=== End Header ===-->
            <div class="col-md-10 col-md-offset-2 pull-right" id='messagebox' style=" font-size: 14px; text-align: center; position: absolute; z-index: 9999 !important;"> </div>

                <?php
                if ($module_id == 0) {
                    ?>
                <div class="container content"> <!--/container-->
                    <div class="row main-body"> <!--/row-->
                <?php
            }
            ?>


                    <!-- Modal -->
                    <div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                                </div>
                                <form id="change_password_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"> Password <span class="req"/></label>
                                            <div class="col-sm-6">
                                                <input type="password" name="password" id="password" class="form-control input-sm" placeholder="User Password" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"> Confirm Password <span class="req"/></label>
                                            <div class="col-sm-6">
                                                <input type="password" name="confirm_password" id="confirm_password" class="form-control input-sm" placeholder="Confirm Password" />
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" id="submit" class="btn btn-u"> Change Password </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="mail_settings_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel"> Mail Settings </h4>
                                </div>
                                <form id="mail_settings_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                        <input type="hidden" name="company_id" id="company_id" />
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"> User Name <span class="req"/></label>
                                            <div class="col-sm-6">
                                                <input type="email" name="useremail" id="useremail" class="form-control input-sm" placeholder="User Name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"> Password <span class="req"/></label>
                                            <div class="col-sm-6">
                                                <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"> SMTP Server <span class="req"/></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="smtp_server" id="smtp_server" class="form-control input-sm" placeholder="SMTP Server" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"> Secure Transport Layer </label>
                                            <div class="col-sm-6">
                                                <input type="text" name="secure_transport_layer" id="secure_transport_layer" class="form-control input-sm" placeholder="Secure Transport Layer" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"> Port <span class="req"/></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="port" id="port" class="form-control input-sm" placeholder="Port" />
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" id="submit" class="btn btn-u"> Settings </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <script>

                        var save_method; //for save method string
                        function change_password()
                        {
                            save_method = 'add';
                            $('#change_password_form')[0].reset(); // reset form on modals
                            $('#change_password_modal').modal('show'); // show bootstrap modal
                            $('.modal-title').text('Change Password'); // Set Title to Bootstrap modal title
                        }

                        function mail_settings()
                        {
                            check_mail_settings();
                            save_method = 'add';
                            $('#mail_settings_form')[0].reset(); // reset form on modals
                            $('#mail_settings_modal').modal('show'); // show bootstrap modal
                            $('.modal-title').text('Mail Settings'); // Set Title to Bootstrap modal title
                        }

                        $(function () {
                            $("#change_password_form").submit(function (event) {
                                var url;
                                if (save_method == 'add') {
                                    url = "<?php echo site_url('Chome/change_password') ?>";
                                } else {
                                    url = "<?php echo site_url('Chome/change_password') ?>";
                                }
                                $.ajax({
                                    url: url,
                                    data: $("#change_password_form").serialize(),
                                    type: $(this).attr('method')
                                }).done(function (data) {
                                    var url = '';
                                    view_message(data, url, 'change_password_modal', 'change_password_form');
                                });
                                event.preventDefault();
                            });
                        });
                        $(function () {
                            $("#mail_settings_form").submit(function (event) {
                                var url;
                                if (save_method == 'add') {
                                    url = "<?php echo site_url('Chome/mail_settings') ?>";
                                } else {
                                    url = "<?php echo site_url('Chome/mail_settings') ?>";
                                }
                                $.ajax({
                                    url: url,
                                    data: $("#mail_settings_form").serialize(),
                                    type: $(this).attr('method')
                                }).done(function (data) {
                                    var url = '';
                                    view_message(data, url, 'mail_settings_modal', 'mail_settings_form');
                                });
                                event.preventDefault();
                            });
                        });

                        function check_mail_settings() {

                            //save_method = 'add';
                            $('#mail_settings_form')[0].reset(); // reset form on modals

                            //Ajax Load data from ajax
                            $.ajax({
                                url: "<?php echo site_url('Chome/ajax_edit_mail_settings/') ?>",
                                type: "GET",
                                dataType: "JSON",
                                success: function (data)
                                {
                                    $('[name="company_id"]').val(data.company_id);
                                    $('[name="useremail"]').val(data.useremail);
                                    $('[name="password"]').val(data.password);
                                    $('[name="smtp_server"]').val(data.smtp_server);
                                    $('[name="secure_transport_layer"]').val(data.secure_transport_layer);
                                    $('[name="port"]').val(data.port);

                                    //                $('#mail_settings_modal').modal('show'); // show bootstrap modal
                                    //                $('.modal-title').text('Mail Settings'); // Set Title to Bootstrap modal title
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }
                    </script>
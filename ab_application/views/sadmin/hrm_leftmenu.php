<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/no_table.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/seat_cart.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/seat_manage.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/left_menu.css" />
<style>


</style>
<?php
$user_data = $this->session->userdata('hr_logged_in');
$user_menu = $user_data ['user_menu'];
$user_menu = explode(",", $user_menu);
$user_menu = array_map('intval', $user_menu);
//print_r($user_menu);
?>

<!--=== Head Files  ===-->
<div class="container content"> <!--/container-->
    <div class="row main-body"> <!--/row-->

        <!-- Begin Sidebar Menu -->
        <div class="col-md-2">
            <ul class="list-group sidebar-nav-v1" id="sidebar-nav">
                <!-- Typography -->
                <?php
                $this->db->order_by("sequence", "asc");
                $this->db->where(array('root_menu' => 0, 'module_id' => $module_id, 'isactive' => 1));//'isactive' => 1
                $this->db->where_in('id', $user_menu);
                $main_menu_query = $this->db->get('main_menu');
                foreach ($main_menu_query->result_array() as $main_menu) {
                    $data_target = preg_replace('/\s+/', '', $main_menu['menu_name']);
                    if ($main_menu['menu_link'] == "") {
                        $menu_link = "#";
                        //$aclass = "";
                        $aclass = "list-toggle";
                    } else {
                        $segments = array($main_menu['menu_link'], 'index', $main_menu['id']);
                        $menu_link = site_url($segments);
                        //$aclass = "active";
                        $aclass = "";
                    }
                    ?>
                    <li class="list-group-item <?php echo $aclass; ?>" data-toggle="collapse" data-target="#<?php echo $data_target; ?>">
                        <a href="<?php echo $menu_link; ?>" class="<?php echo $data_target; ?>"><i class="fa fa-tags"></i> <?php echo $main_menu['menu_name'] ?></a>
                        <ul id="<?php echo $data_target; ?>" class="collapse">
                            <?php
                            $this->db->order_by("sequence", "asc");
                            $this->db->where(array('root_menu' => $main_menu['id'], 'sub_root_menu =' => 0, 'module_id' => $module_id, 'isactive' => 1));//'isactive' => 1
                            $this->db->where_in('id', $user_menu);
                            $root_menu_query = $this->db->get('main_menu');
                            foreach ($root_menu_query->result_array() as $root) {
                                $root_data_target = preg_replace('/\s+/', '', $root['menu_name']);
                                if ($root['menu_link'] == "") {
                                    $root_menu_link = "#";
                                    $class = "list-toggle active";
                                } else {
                                    $rootsegments = array($root['menu_link'], 'index', $root['id']);
                                    $root_menu_link = site_url($rootsegments);

                                    $class = "";
                                }
                                ?>
                                <li class="list-group-item<?php echo $class; ?>" data-toggle="collapse" data-target="#<?php echo $root_data_target; ?>">
                                    <a id="<?php echo $root_data_target; ?>" href="<?php echo $root_menu_link; ?>"><i class="fa fa-bars"></i> <?php echo $root['menu_name']; ?></a>

                                    <?php
                                    $this->db->order_by("sequence", "asc");
                                    $this->db->where(array('sub_root_menu =' => $root['id'], 'module_id' => $module_id, 'isactive' => 1));//'isactive' => 1
                                    $this->db->where_in('id', $user_menu);
                                    $sub_root_menu_query = $this->db->get('main_menu');
                                    foreach ($sub_root_menu_query->result_array() as $sub_root) {
                                        $sub_root_data_target = preg_replace('/\s+/', '', $sub_root['menu_name']);
                                        $sub_rootsegments = array($sub_root['menu_link'], 'index', $sub_root['id']);
                                        $sub_root_menu_link = site_url($sub_rootsegments);
                                        ?>
                                    <li style="margin-left: 10px;" data-target="#<?php echo $sub_root_data_target; ?>">
                                            <!--<span class="badge badge-u">New</span>-->
                                        <a id="<?php echo $sub_root_data_target; ?>" href="<?php echo $sub_root_menu_link; ?>"><i class="fa fa-arrows-h"></i> <?php echo $sub_root['menu_name']; ?></a>
                                    </li>
                                    <?php
                                }
                                ?>

                        </li>
                        <?php
                    }
                    ?>
                </ul>
                </li>
                <?php
            }
            ?>



            </ul>
        </div>
        <!-- End Sidebar Menu -->

        <script>
            function left_menu_close()
            {
                $(".content .main-body .left_menu").addClass("hidden");
                $(".content .main-body .left_menu").removeClass("col-md-2");

                $(".content .main-body .main-content-div").addClass("col-md-12").removeClass("col-md-10");
                //$(".content .main-body .col-md-10").addClass("col-md-12");

                $("#open_span").removeClass("hidden");
            }

            function left_menu_open()
            {
                $(".content .main-body .left_menu").addClass("col-md-2");
                $(".content .main-body .left_menu").removeClass("hidden");

                $(".content .main-body .main-content-div").addClass("col-md-10").removeClass("col-md-12");

                $("#open_span").addClass("hidden");
                $("#close_span").addClass("col-md-12").removeClass("col-md-10");
            }

            $(".sidebar-nav-v1 a").click(function (event) {
                if ($(this).attr('href') != '#')
                {
                    var ttarget = $(this).attr("id");
                    var rootclass = $(this).attr('class');
                    //alert (rootclass);
                    localStorage.setItem("datatarget", ttarget);
                    localStorage.setItem("roottarget", rootclass);
                }
            });

            $(".navbar-nav li a").click(function (event) {
                localStorage.setItem("datatarget", "undefined");
            });

            $(document).ready(function () {

                if (typeof (Storage) !== "undefined") {
                    var datatarget = localStorage.getItem("datatarget");
                } else {
                    var datatarget = "";
                    alert("Sorry, your browser does not support Web Storage...");
                }
                
                //alert (datatarget);
                
                if (typeof (Storage) !== "undefined") {
                    var roottarget = localStorage.getItem("roottarget");
                } else {
                    var roottarget = "";
                    alert("Sorry, your browser does not support Web Storage...");
                }
                
                
                
                //alert (datatarget); 
                //$("#" + datatarget).css('background-color', '#f6f6f7');
                
                $("#" + datatarget).css("color", "#72c02c");
                $("." + roottarget).css("color", "#72c02c");
                
                jQuery('[data-target="#' + datatarget + '"]').parent().addClass('in').css('height', 'auto');
                //jQuery('[data-target="#' + datatarget + '"]').parent().parent().addClass('in').css('height', 'auto');
                //jQuery('[data-target="#ManageHolidayGroup"]').parent().parent().addClass('in').css('height', 'auto')
                //localStorage.setItem("datatarget", "undefined");
            });


        </script>



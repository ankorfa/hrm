
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <?php //echo $menu_id;?>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <?php if ($this->user_type != 1) { ?>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employees/add_employees" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Employee</a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employees/get_search_employee/"."1"; ?>"><i class="fa fa-search" aria-hidden="true"></i> Active </a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employees/get_search_employee/"."0"; ?>"><i class="fa fa-search" aria-hidden="true"></i> Inactive </a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employees/get_search_employee/"."2"; ?>"><i class="fa fa-search" aria-hidden="true"></i> All Employee</a></br></br>
                <?php } ?>
                <?php if ($show_result) { ?>
                <table id="dataTables-example" class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th> </th>
                            <th>Employee</th>
                            <th>Position Info</th>
                            <th>Contact Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                         <?php

//                        $nn=0;
//                        $tables = $this->db->query("SELECT t.TABLE_NAME AS myTables FROM INFORMATION_SCHEMA.TABLES AS t WHERE t.TABLE_SCHEMA = 'us_hrm' ")->result_array();
//                        foreach ($tables as $key => $val) {
//                            $nn++;
//                            echo $val['myTables'] . "<br>"; // myTables is the alias used in query.
//                        }
//                        echo $nn;
//                        
                        $Xtra = "";
                        if ($search_ids != "") {
                            if ($search_ids == 2) {
                                $Xtra = "";
                            } else {
                                $Xtra = " and main_employees.isactive=$search_ids";
                            }
                        } else {
                            $Xtra = " and main_employees.isactive=1";
                        }

                        //echo $Xtra;

                        if ($this->user_group == 10) {//self
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.emp_user_id='" . $this->user_id . "' {$Xtra} Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else if ($this->user_group == 11) {//Hr Manager 
                            $rpt_men_emp_id = $this->Common_model->get_selected_value($this, 'emp_user_id', $this->user_id, 'main_employees', 'employee_id');
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' and main_emp_workrelated.reporting_manager='" . $rpt_men_emp_id . "'  {$Xtra} Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' {$Xtra}  Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
                            //$sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.createdby IN (" . get_sub_users($this->user_id) . ") Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='0' and  main_employees.createdby IN (" . get_sub_users($this->user_id) . ") {$Xtra} Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else {
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id  WHERE main_employees.emp_user_id='" . $this->user_id . "' {$Xtra} Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        }

                        //pr($search_ids);

                        $query = $this->db->query($sql);

                        //echo $this->db->last_query();

                        if ($query) {
                            foreach ($query->result() as $row) {

                               
                                if ($row->image_name == "") {
                                    $img_location = base_url() . "uploads/blank.png";
                                } else {
                                    $img_location = base_url() . "uploads/emp_image/" . $row->image_name;
                                }
                                
                                ?>
                                <tr onclick="edit_row('<?php echo $row->employee_id; ?>');" style="cursor: pointer;">
                                    <td style="width: 19%;">
                                        <!--<img alt="No Image" src="<?php // echo $img_location;                  ?>" height="100" width="95">-->
                                        <div class="testimonial-info">
                                            <img class="rounded-x" src="<?php echo $img_location; ?>" alt="No Image" height="100" width="95">
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row"><b><?php echo $this->Common_model->employee_name($row->employee_id); ?></b></div>
                                            <div class="row"><b>Position : </b> <?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title'); ?></div>
                                            <div class="row"><?php echo ucwords($row->first_address) ." ".ucwords($row->second_address) ?></div>
                                            <!--<div class="row"><?php // echo $row->city . " , " . $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . "  " . $row->zipcode ?></div>-->
                                            <!--<div class="row"><?php // echo $this->Common_model->get_name($this, $row->county, 'main_county', 'county_name') ?></div>-->
                                            <div class="row">SSN : <?php echo $number = "XXX-XX-" . substr($row->ssn_code, -4); ?></div>
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Emp# : <?php echo sprintf("%07d", $row->employee_id) . " - <span class='activ' style='color:" . (($row->isactive == 1) ? '#72c02c' : 'red') . ";'>" . $status_array[$row->isactive] . "</span>" ?></div>
                                            <div class="row">Location : <?php echo $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') ?></div>
                                            <div class="row">Hire Date : <?php echo $this->Common_model->show_date_formate($row->hire_date); ?></div>
                                            <div class="row">Department : <?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></div>
                                            <!--<div class="row">Position : <?php // echo $this->Common_model->get_name($this, $row->position, 'main_positions', 'positionname') ?></div>-->
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Home : <?php echo $row->home_phone ?></div>
                                            <div class="row">Work : <?php echo $row->work_phone ?></div>
                                            <div class="row">Cell : <?php echo $row->mobile_phone ?></div>
                                            <div class="row">Email : <?php echo $row->email ?></div>
                                        </div>
                                    </td>

                                    <td>
                                        <a title="Download PDF Form" href="<?php echo base_url() . "Con_Employees/download_employee_form/" . $row->employee_id; ?>" ><i class='fa fa-lg fa-download'></i></a>
                                        <!--<a href="#" onclick="delete_data(<?php /* echo $row->id */ ?>)"><i class='fa fa-trash-o'></i></a>-->
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                    <?php } ?>
            </div>
            <!-- end data table -->
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    var url = "<?php echo base_url(); ?>";
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "Con_Employees/delete_entry/" + id;
        else
            return false;
    }

    function edit_row(emp_id)
    {
        window.location = url + "Con_Employees/edit_entry/" + emp_id;
    }

</script>
<!--=== End Content ===-->

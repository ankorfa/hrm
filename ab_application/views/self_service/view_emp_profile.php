
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
                <table id="dataTables-example" class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th> </th>
                            <th>Employee</th>
                            <th>Position Info</th>
                            <th>Contact Info</th>
                        <!--<th>Action</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        if ($this->user_group == 10) {//self
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.emp_user_id='" . $this->user_id . "'  ORDER BY main_employees.employee_id DESC ";//and main_employees.employee_id='" . $this->user_id . "'
                        } else if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {//com //hr manager
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' ORDER BY main_employees.employee_id DESC ";
                        } else {
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        }
                        $query = $this->db->query($sql);
                        
                        //echo $this->db->last_query();
                       
                        if ($query) {
                            foreach ($query->result() as $row) {

//                                if ($row->image_location == "") {
//                                    $img_location = base_url() . "uploads/blank.png";
//                                } else {
//                                    $img_location = $row->image_location;
//                                }
                                
                                if ($row->image_name == "") {
                                    $img_location = base_url() . "uploads/blank.png";
                                } else {
                                    $img_location = base_url() . "uploads/emp_image/". $row->image_name;
                                }
                                ?>
                                <tr onclick="view_row('<?php echo $row->employee_id; ?>');" style="cursor: pointer;">
                                    <td style="width: 19%;">
                                        <!--<img alt="No Image" src="<?php // echo $img_location; ?>" height="100" width="95">-->
                                        <div class="testimonial-info">
                                            <img class="rounded-x" src="<?php echo $img_location; ?>" alt="No Image" height="100" width="95">
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row"><b><?php echo ucwords($row->salutation) . " " . ucwords($row->first_name) . " " . ucwords($row->middle_name) ?></b></div>
                                            <div class="row"><?php echo ucwords($row->first_address) ?></div>
                                            <div class="row"><?php echo ucwords($row->second_address) ?></div>
                                            <div class="row"><?php echo $row->city . " , " . $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . "  " . $row->zipcode ?></div>
                                            <div class="row"><?php echo $this->Common_model->get_name($this, $row->county, 'main_county', 'county_name') ?></div>
                                            <div class="row">SSN : <?php echo $number = "XXX-XX-". substr($row->ssn_code, -4); ?></div>
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Emp# : <?php echo sprintf("%07d", $row->employee_id) . " - <span class='activ' style=' color: #72c02c;'>" . $status_array[$row->isactive] . "</span>" ?></div>
                                            <div class="row">Location : <?php echo $this->Common_model->get_name($this, $row->location, 'main_location','location_name') ?></div>
                                            <div class="row">Hire Date : <?php echo $this->Common_model->show_date_formate($row->hire_date); ?></div>
                                            <div class="row">Department : <?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></div>
                                            <div class="row">Position : <?php echo $this->Common_model->get_name($this, $row->position, 'main_positions', 'positionname') ?></div>
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

                                <!--<td>
                                    <a href="<?php //echo base_url() . "con_Employees/edit_entry/" . $row->employee_id . ""  ?>" ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>
                                    <a href="#" onclick="delete_data(<?php //echo $row->id  ?>)"><i class='fa fa-trash-o'></i></a>
                                </td>-->
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table -->
        </div>
        
<!--        <div id="xyz">
            <a href="fffff"></a>
        </div>-->
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    function delete_data(id){
        
        var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = base_url+"con_Employees/delete_entry/"+id;
        else
          return false;
    }

    function view_row(emp_id)
    {
        window.location = base_url+"Con_Employee_Profile/view_employee/"+emp_id;
    }
    
//    $(function () {
//        var aaa=$('#xyz').find("a").attr('href');
//        //alert (aaa);
//        var bbb=5;
//        var ccc=aaa+bbb;
//       
//        //window.location = aaa;
//        $('#xyz').find("a").attr('href', ccc);
//         alert (ccc);
//    });
   
</script>
<!--=== End Content ===-->

<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
            <form id="sing_req_form" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Requisitions_Approval/update_sing_req_Status" enctype="multipart/form-data" role="form" >

                <div id="employee_review_div">   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-u">
                                <div class="panel-heading">
                                    Requisition Information
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">

                                        <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                            <tbody>
                                                <?php
                                                foreach ($query->result() as $row) {
                                                    ?>
                                                    <tr>
                                                        <input type="hidden" id="requisition_id" name="requisition_id" value="<?php echo $row->id ?>">
                                                        <th>Requisition Id : </th>
                                                        <td><?php echo $row->requisition_code ?></td>
                                                        <th>Requisitions Date : </th>
                                                        <td><?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Due Date : </th>
                                                        <td><?php echo $this->Common_model->show_date_formate($row->due_date) ?></td>
                                                        <th>Location : </th>
                                                        <td><?php echo $this->Common_model->get_name($this, $row->location_id, 'main_location', 'location_name'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Department : </th>
                                                        <td><?php echo $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name'); ?></td>
                                                        <th>Position : </th>
                                                        <td><?php echo $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Reporting Manager : </th>
                                                        <td>
                                                            <?php
//                                                            $manager_id = $this->Common_model->get_name($this, $row->reporting_manager_id, 'main_employees', 'employee_id');
//                                                            echo $this->Common_model->employee_name($manager_id);
                                                            echo $this->Common_model->get_selected_value($this, 'employee_id', $row->reporting_manager_id, 'main_employees', 'first_name');
                                                            ?>
                                                        </td>
                                                        <th>No. of Positions : </th>
                                                        <td><?php echo $row->no_of_positions ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Employee Category : </th>
                                                        <td>
                                                            <?php
                                                                $employee_type_array= $this->Common_model->get_array('employee_type');
                                                                echo ($row->employee_category == 0? 'Not Define': $employee_type_array[$row->employee_category]);
                                                            ?>
                                                        </td>
                                                        <th>Wages : </th>
                                                        <td>
                                                            <?php
                                                            $wages_array = array(1 => 'Salary', 2 => 'Hourly');
                                                            echo ($row->employee_category == 0? 'Not Define': $wages_array[$row->wages]);
                                                            ?>
                                                        </td>                                                    </tr>
                                                    <tr>
                                                        <th>Salary Range : </th>
                                                        <td><?php echo $row->salary_range ?></td>
                                                        <th>Posting : </th>
                                                        <td>
                                                            <?php 
                                                            $posting_array = array(1 => 'Internal', 2 => 'Internal & External');
                                                                echo ($row->posting == 0? 'Not Define': $employee_type_array[$row->posting]); 
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hire Reason : </th>
                                                        <td>
                                                            <?php
                                                                $hire_reason_array = array(1 => 'New', 2 => 'Replacing');
                                                                echo ($row->hire_reason == 0? 'Not Define': $hire_reason_array[$row->hire_reason]);
                                                            ?>
                                                        </td>
                                                        <th>Employee Name : </th>
                                                        <td>
                                                            <?php
                                                                echo $this->Common_model->get_selected_value($this, 'employee_id', $row->replacing_emp, 'main_employees', 'first_name');                                                                
                                                            ?>
                                                        </td>                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Qualification : </th>
                                                        <td><?php echo $row->required_qualification ?></td>
                                                        <th>Experience Range : </th>
                                                        <td><?php echo $row->experience_range ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Employment Status : </th>
                                                        <td><?php echo $this->Common_model->get_name($this, $row->employment_status_id, 'main_employmentstatus', 'description') ?></td>
                                                        <th>Priority: </th>
                                                        <td>
                                                            <?php
                                                            if($row->priority!=0){
                                                                echo $priority_array[$row->priority];                                                                
                                                            }else{
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Job Description : </th>
                                                        <td><?php echo $row->job_description; ?></td>
                                                        <th>Required Skills</th>
                                                        <td><?php echo $row->required_skills; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Position Description : </th>
                                                        <td><?php echo $row->position_description; ?></td>                                        
                                                    </tr>
                                                    <?php
                                                }
                                                ?>     
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>        
                    </div>
                </div> 
                <?php
                    foreach ($query->result() as $roww) {
                ?>
                
                <div class="col-md-12" style="margin-top: 10px">
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">Status<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <select name="sing_req_status" id="sing_req_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            foreach ($approver_status as $key => $val):
                                ?>
                                <option value="<?php echo $key ?>"<?php if($roww->req_status==$key) echo "selected";?>><?php echo $val ?></option>
                                <?php
                            endforeach;
                            ?>                        
                        </select> 
                        </div>
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-4 center-align"> 
                            <?php
                                if($roww->req_status!=1)
                                {
                                    ?>
                                <button type="submit" id="submit" class="btn btn-u"> Process </button>
                                    <?php
                                }
                            ?>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Requisitions_Approval" ?>">Close</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
     
            </form>
                
                
            </div>

        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sing_req_form").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sing_req_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Job_Requisition';
                view_message(data, url, '', 'sing_req_form');

            });
            event.preventDefault();
        });
    });

     $("#sing_req_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
    

</script>
<!--=== End Script ===-->


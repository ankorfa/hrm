<!-- CSS Page Style -->    
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pages/page_job_inner2.css">
    
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <div class="col-md-12" style="margin-top: 10px">

               
                                                <?php
                                                /* foreach ($query->result() as $row) {
                                                    ?>
                                                    <tr>
                                                        <th>Requisition Id : </th>
                                                        <td><?php echo $row->requisition_code ?></td>
                                                        <th>Requisitions Date : </th>
                                                        <td><?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?> <?php // echo ucwords($prow->last_name);            ?></td>
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
//                                                                $manager_id = $this->Common_model->get_name($this, $row->reporting_manager_id, 'main_employees', 'employee_id');
//                                                                echo $this->Common_model->employee_name($manager_id);
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
                                                            $employee_type_array = $this->Common_model->get_array('employee_type');
                                                            echo ($row->employee_category == 0 ? 'Not Define' : $employee_type_array[$row->employee_category]);
                                                            ?>
                                                        </td>
                                                        <th>Wages : </th>
                                                        <td>
                                                            <?php
                                                            $wages_array = array(1 => 'Salary', 2 => 'Hourly');
                                                            echo ($row->employee_category == 0 ? 'Not Define' : $wages_array[$row->wages]);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Salary Range : </th>
                                                        <td><?php echo $row->salary_range ?></td>
                                                        <th>Posting : </th>
                                                        <td>
                                                            <?php
                                                            $posting_array = array(1 => 'Internal', 2 => 'Internal & External');
                                                            echo ($row->posting == 0 ? 'Not Define' : $employee_type_array[$row->posting]);
                                                            ?>
                                                        </td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <th>Hire Reason : </th>
                                                        <td>
                                                            <?php
                                                            $hire_reason_array = array(1 => 'New', 2 => 'Replacing');
                                                            echo ($row->hire_reason == 0 ? 'Not Define' : $hire_reason_array[$row->hire_reason]);
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
                                                            if ($row->priority != 0) {
                                                                echo $priority_array[$row->priority];
                                                            } else {
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
                                                        <th>Position Description: </th>
                                                        <td><?php echo $row->position_description; ?></td>                                        
                                                    </tr>
                                                    <?php
                                                }*/
                                                ?>     
                                          
                
            
            
            
<!--=== Job Description ===-->
<?php foreach ($query->result() as $row) { ?>
<div class="job-description">
    <div class="container content">
        <div class="title-box-v2">
            <h2>Job Description</h2>
            <p><?php echo $row->position_description ?></p>
        </div>    
        <!-- Left Inner -->
        <div class="left-inner">
            <!--<img src="assets/img/clients2/ea-canada.png" alt="">-->
            <img src="<?php echo base_url(); ?>assets/img/hrc_logo.png" alt="" >
            <h3>EA Canada, Inc</h3>
            <div class="position-top">
<!--                <ul class="social-icons social-icons-color">
                    <li><a class="social_facebook" data-original-title="Facebook" href="#"></a></li>
                    <li><a class="social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                    <li><a class="social_tumblr" data-original-title="Tumblr" href="#"></a></li>
                    <li><a class="social_twitter" data-original-title="Twitter" href="#"></a></li>
                </ul>-->

                <div class="sharethis-inline-share-buttons"></div>
                
                <a href="#"><i class="fa fa-print"></i></a>
            </div>    
            <div class="overflow-h">
                <p class="hex">Worldwide, 16,329 Employees, Bentonville, Arkansas</p>
                <div class="star-vote">
                    <ul class="list-inline">
                        <li><i class="color-green fa fa-star"></i></li>
                        <li><i class="color-green fa fa-star"></i></li>
                        <li><i class="color-green fa fa-star"></i></li>
                        <li><i class="color-green fa fa-star-half-o"></i></li>
                        <li><i class="color-green fa fa-star-o"></i></li>
                    </ul>
                    <span><a href="#">34 reviews</a></span>
                </div>
            </div>    
            <hr>
            
            <?php echo $row->job_posting_text ?>
            
        </div>
        <!-- End Left Inner -->
    </div>   
</div>    
<?php } ?>
<!--=== End Job Description ===-->

                <div class="modal-footer">                        
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_OpeningsPositions" ?>">Close</a>
                </div>
            </div>

        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

   
</script>
<!--=== End Script ===-->


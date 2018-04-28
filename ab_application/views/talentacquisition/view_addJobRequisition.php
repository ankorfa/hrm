<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Job_Requisition/save_job_Requisition" enctype="multipart/form-data" role="form" >
                        <input type="hidden" value="" name="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Requisition Id </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="requisition_code" id="requisition_code" class="form-control input-sm" placeholder="Requisition Id" readonly />
                            </div>
                            <label class="col-sm-2 control-label">Requisitions Date<span class="req"/> </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="requisitions_date" id="requisitions_date" class="form-control dt_pick input-sm" placeholder="Requisitions Date " autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Due Date<span class="req"/> </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="due_date" id="due_date" class="form-control dt_pick_m input-sm" placeholder="Due Date" autocomplete="off" />
                            </div>
                            <label class="col-sm-2 control-label">Location</label>
                            <div class="col-sm-4">                            
                                <select name="location_id" id="location_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($location_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->location_name ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Department<span class="req"/></label>
                            <div class="col-sm-4">                            
                                <select name="department_id" id="department_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($department_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->department_name ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                            <label class="col-sm-2 control-label">Position<span class="req"/></label>
                            <div class="col-sm-4">                            
                                <select name="position_id" id="position_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($positions_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->positionname ?>"><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Reporting Manager</label>
                            <div class="col-sm-4">                           
                                <select name="reporting_manager_id" id="reporting_manager_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($reporting_manager_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                            <label class="col-sm-2 control-label">Employee Category<span class="req"/></label>
                            <div class="col-sm-4">                           
                                <select name="employee_category" id="employee_category" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $employee_type_array = $this->Common_model->get_array('employee_type');
                                    foreach ($employee_type_array as $keyyy => $valll):
                                        ?>
                                        <option value="<?php echo $keyyy ?>"><?php echo $valll ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>                            
                        </div> 
                        <div class="form-group ">                         
                            <label class="col-sm-2 control-label">Wages </label>
                            <div class="col-sm-4">                           
                                <select name="wages" id="wages" onchange="show_hourly_rate(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <?php
                                    $wages_array = array(1 => 'Salary', 2 => 'Hourly');
                                    foreach ($wages_array as $wkeyyy => $wvalll):
                                        ?>
                                        <option value="<?php echo $wkeyyy ?>"><?php echo $wvalll ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>      
                            <label class="col-sm-2 control-label">Salary Range</label>
                            <div class="col-sm-4">                           
                                <input type="text" name="salary_range" id="salary_range" class="form-control input-sm" placeholder=" Salary Range ( $ ) " />
                            </div> 
                        </div>
                        <div class="form-group hidden" id="hourly_rate_div">                         
                            <label class="col-sm-2 control-label">Hourly Rate </label>
                            <div class="col-sm-4">                           
                                <input type="text" name="hourly_rate" id="hourly_rate" class="form-control input-sm" placeholder="Hourly Rate ( $ ) " />
                            </div> 
                        </div>
                        <div class="form-group "> 
                            <label class="col-sm-2 control-label">Posting</label>
                            <div class="col-sm-4">                           
                                <select name="posting" id="posting" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $posting_array = array(1 => 'Internal', 2 => 'Internal & External');
                                    foreach ($posting_array as $pkeyyy => $pvalll):
                                        ?>
                                        <option value="<?php echo $pkeyyy ?>"><?php echo $pvalll ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>       
                            <label class="col-sm-2 control-label">No. of Positions </label>
                            <div class="col-sm-4">                           
                                <input type="text" name="no_of_positions" id="no_of_positions" class="form-control input-sm" placeholder="Required no. of Positions" />
                            </div> 
                        </div>
                        <div class="form-group "> 
                            <label class="col-sm-2 control-label">Hire Reason</label>
                            <div class="col-sm-4">                           
                                <select name="hire_reason" id="hire_reason" onchange="select_rep_emp(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm"> 
                                    <option></option>
                                    <?php
                                    $hire_reason_array = array(1 => 'New', 2 => 'Replacing');
                                    foreach ($hire_reason_array as $hkeyyy => $hvalll):
                                        ?>
                                        <option value="<?php echo $hkeyyy ?>"><?php echo $hvalll ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>       
                            <label class="col-sm-2 control-label">Employee Name </label>
                            <div class="col-sm-4"> 
                                <select name="replacing_emp" id="replacing_emp" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled="disabled">
                                    <option></option>
                                    <?php
                                    foreach ($employees_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div> 
                        </div>
                        <div class="form-group no-margin">                        
                            <label class="col-sm-2 control-label">Employment Status</label>
                            <div class="col-sm-4">                           
                                <select name="employment_status_id" id="employment_status_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($employmentstatus_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $this->Common_model->get_name($this, $key->workcodename, 'tbl_employmentstatus', 'employemnt_status'); ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                            <label class="col-sm-2 control-label">Priority</label>
                            <div class="col-sm-4">                            
                                <select name="priority" id="priority" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($priority_array as $key => $val):
                                        ?>
                                        <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group ">                         
                            <label class="col-sm-2 control-label">Qualification</label>
                            <div class="col-sm-4">                            
                                <input type="text" name="required_qualification" id="required_qualification" class="form-control input-sm" placeholder="Required Qualification" />
                            </div> 
                            <label class="col-sm-2 control-label">Experience Range</label>
                            <div class="col-sm-4">                            
                                <input type="text" name="experience_range" id="experience_range" class="form-control input-sm" placeholder="Required Experience Range" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Job Description</label>
                            <div class="col-sm-4">                            
                                <textarea class="form-control" rows="1" id="job_description" name="job_description"></textarea>
                            </div> 
                            <label class="col-sm-2 control-label">Required Skills</label>
                            <div class="col-sm-4">                            
                                <textarea class="form-control" rows="1" id="required_skills" name="required_skills"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Position Description</label>
                            <div class="col-sm-4">                           
                                <textarea class="form-control" rows="1" id="position_description" name="position_description"></textarea>
                            </div>                        
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Posting Text</label>
                            <div class="col-sm-10">
                                <textarea name="posting_text" id="posting_text" class="ckeditor"></textarea>
                                <textarea name="job_posting_text" id="job_posting_text" style="display:none;"></textarea>
                            </div>
                        </div>
                        
                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Job_Requisition" ?>">Close</a>
                        </div>
                    </form>
                </div>
                <?php
            } else if ($type == 2) {//edit
                ?>
                <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Job_Requisition/update_job_Requisition" enctype="multipart/form-data" role="form" >
                        <?php foreach ($OpeningsPositions_query->result() as $row): ?> 
                            <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Requisition Id </label>
                                <div class="col-sm-4">                            
                                    <input type="text" name="requisition_code" id="requisition_code" value="<?php echo $row->requisition_code ?>" class="form-control input-sm" placeholder="Requisition Id" readonly />
                                </div>
                                <label class="col-sm-2 control-label">Requisitions Date<span class="req"/> </label>
                                <div class="col-sm-4">                            
                                    <input type="text" name="requisitions_date" id="requisitions_date" value="<?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?>" class="form-control dt_pick input-sm" placeholder="Requisitions Date " autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group no-margin">
                                <label class="col-sm-2 control-label">Due Date<span class="req"/> </label>
                                <div class="col-sm-4">                           
                                    <input type="text" name="due_date" id="due_date" value="<?php echo $this->Common_model->show_date_formate($row->due_date) ?>" class="form-control dt_pick_m input-sm" placeholder="Due Date" autocomplete="off" />
                                </div>
                                <label class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-4">                            
                                    <select name="location_id" id="location_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($location_query->result() as $key):
                                            ?>
                                            <option value="<?php echo $key->id ?>"<?php if ($row->location_id == $key->id) echo "selected"; ?>><?php echo $key->location_name ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group no-margin">
                                <label class="col-sm-2 control-label">Department<span class="req"/></label>
                                <div class="col-sm-4">                            
                                    <select name="department_id" id="department_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($department_query->result() as $key):
                                            ?>
                                            <option value="<?php echo $key->id ?>"<?php if ($row->department_id == $key->id) echo "selected"; ?>><?php echo $key->department_name ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                                <label class="col-sm-2 control-label">Position<span class="req"/></label>
                                <div class="col-sm-4">                           
                                    <select name="position_id" id="position_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($positions_query->result() as $key):
                                            ?>
                                            <option value="<?php echo $key->positionname ?>"<?php if ($row->position_id == $key->positionname) echo "selected"; ?>><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title') ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group no-margin">
                                <label class="col-sm-2 control-label">Reporting Manager</label>
                                <div class="col-sm-4">                           
                                    <select name="reporting_manager_id" id="reporting_manager_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($reporting_manager_query->result() as $key):
                                            ?>
                                            <option value="<?php echo $key->employee_id ?>"<?php if ($row->reporting_manager_id == $key->employee_id) echo "selected"; ?>><?php echo $key->first_name ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                                <label class="col-sm-2 control-label">Employee Category<span class="req"/></label>
                                <div class="col-sm-4">                           
                                    <select name="employee_category" id="employee_category" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $employee_type_array = $this->Common_model->get_array('employee_type');
                                        foreach ($employee_type_array as $keyyy => $valll):
                                            ?>
                                            <option value="<?php echo $keyyy ?>"<?php if ($row->employee_category == $keyyy) echo "selected"; ?>><?php echo $valll ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>          
                            </div> 
                            <div class="form-group ">                         
                                <label class="col-sm-2 control-label">Wages </label>
                                <div class="col-sm-4">                           
                                    <select name="wages" id="wages" onchange="show_hourly_rate(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <?php
                                        $wages_array = array(1 => 'Salary', 2 => 'Hourly');
                                        foreach ($wages_array as $wkeyyy => $wvalll):
                                            ?>
                                            <option value="<?php echo $wkeyyy ?>"<?php if ($row->wages == $wkeyyy) echo "selected"; ?>><?php echo $wvalll ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <script>
                                        $(function () {
                                            show_hourly_rate(<?php echo $row->wages; ?>);
                                        });
                                    </script>
                                </div>      
                                <label class="col-sm-2 control-label">Salary Range</label>
                                <div class="col-sm-4">                           
                                    <input type="text" name="salary_range" id="salary_range" value="<?php echo ucwords($row->salary_range) ?>" class="form-control input-sm" placeholder=" Salary Range ( $ ) " />
                                </div> 
                            </div>
                            <div class="form-group hidden" id="hourly_rate_div">                         
                                <label class="col-sm-2 control-label">Hourly Rate </label>
                                <div class="col-sm-4">                           
                                    <input type="text" name="hourly_rate" id="hourly_rate" value="<?php echo ucwords($row->hourly_rate) ?>" class="form-control input-sm" placeholder="Hourly Rate ( $ ) " />
                                </div> 
                            </div>
                            <div class="form-group "> 
                                <label class="col-sm-2 control-label">Posting</label>
                                <div class="col-sm-4">                           
                                    <select name="posting" id="posting" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $posting_array = array(1 => 'Internal', 2 => 'Internal & External');
                                        foreach ($posting_array as $pkeyyy => $pvalll):
                                            ?>
                                            <option value="<?php echo $pkeyyy ?>"<?php if ($row->posting == $pkeyyy) echo "selected"; ?>><?php echo $pvalll ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>       
                                <label class="col-sm-2 control-label">No. of Positions </label>
                                <div class="col-sm-4">                           
                                    <input type="text" name="no_of_positions" id="no_of_positions" value="<?php echo ucwords($row->no_of_positions) ?>" class="form-control input-sm" placeholder="Required no. of Positions" />
                                </div> 
                            </div>
                            <div class="form-group "> 
                                <label class="col-sm-2 control-label">Hire Reason</label>
                                <div class="col-sm-4">                           
                                    <select name="hire_reason" id="hire_reason" onchange="select_rep_emp(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm"> 
                                        <option></option>
                                        <?php
                                        $hire_reason_array = array(1 => 'New', 2 => 'Replacing');
                                        foreach ($hire_reason_array as $hkeyyy => $hvalll):
                                            ?>
                                            <option value="<?php echo $hkeyyy ?>"<?php if ($row->hire_reason == $hkeyyy) echo "selected"; ?>><?php echo $hvalll ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>       
                                <label class="col-sm-2 control-label">Employee Name </label>
                                <div class="col-sm-4"> 
                                    <select name="replacing_emp" id="replacing_emp" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($employees_query->result() as $key):
                                            ?>
                                            <option value="<?php echo $key->employee_id ?>"<?php if ($row->replacing_emp == $key->employee_id) echo "selected"; ?>><?php echo $key->first_name ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div> 
                            </div>
                            <div class="form-group no-margin">                        
                                <label class="col-sm-2 control-label">Employment Status</label>
                                <div class="col-sm-4">                            
                                    <select name="employment_status_id" id="employment_status_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($employmentstatus_query->result() as $key):
                                            ?>
                                            <option value="<?php echo $key->id ?>"<?php if ($row->employment_status_id == $key->id) echo "selected"; ?>><?php echo $key->description ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                                <label class="col-sm-2 control-label">Priority</label>
                                <div class="col-sm-4">                            
                                    <select name="priority" id="priority" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($priority_array as $key => $val):
                                            ?>
                                            <option value="<?php echo $key ?>"<?php if ($row->priority == $key) echo "selected"; ?>><?php echo $val ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group ">                         
                                <label class="col-sm-2 control-label">Qualification</label>
                                <div class="col-sm-4">                            
                                    <input type="text" name="required_qualification" id="required_qualification" value="<?php echo ucwords($row->required_qualification) ?>" class="form-control input-sm" placeholder="Required Qualification" />
                                </div> 
                                <label class="col-sm-2 control-label">Experience Range</label>
                                <div class="col-sm-4">                            
                                    <input type="text" name="experience_range" id="experience_range" value="<?php echo ucwords($row->experience_range) ?>" class="form-control input-sm" placeholder="Required Experience Range" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Job Description</label>
                                <div class="col-sm-4">                            
                                    <textarea class="form-control" rows="1" id="job_description" name="job_description"><?php echo ucwords($row->job_description) ?></textarea>
                                </div> 
                                <label class="col-sm-2 control-label">Required Skills</label>
                                <div class="col-sm-4">                            
                                    <textarea class="form-control" rows="1" id="required_skills" name="required_skills"><?php echo ucwords($row->required_skills) ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Position Description</label>
                                <div class="col-sm-4">                           
                                    <textarea class="form-control" rows="1" id="position_description" name="position_description"><?php echo ucwords($row->position_description) ?></textarea>
                                </div>                        
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Posting Text</label>
                                <div class="col-sm-10">
                                    <textarea name="posting_text" id="posting_text" class="ckeditor"> <?php echo $row->job_posting_text ?> </textarea>
                                    <textarea name="job_posting_text" id="job_posting_text" style="display:none;"><?php echo $row->job_posting_text ?></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">                        
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Job_Requisition" ?>">Close</a>
                            </div>

                        <?php endforeach; ?>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(document).ready(function () {

        $('.dt_pick_m').datepicker({
            format: 'mm-dd-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

        $('.dt_pick_m').change(function () {
            var selected_date = $(this).val();
            //Get today's date at midnight
            var today = new Date();
            today = Date.parse(today.getMonth() + 1 + '/' + today.getDate() + '/' + today.getFullYear());
            //Get the selected date (also at midnight)
            var selDate = Date.parse(selected_date);

            if (selDate < today) {
                //If the selected date was before today, continue to show the datepicker
                $(this).val('');
                alert('Sorry! Due Date cannot be earliar date from Today.');
            }
        });
    });

    $(function () {
//        $('.dt_pick_m').datepicker({
//            format: 'MM-yyyy-dd',
//            todayHighlight: true,
//            autoclose: true,
//            on
//        });


        $("#sky-form11").submit(function (event) {
            
            var ckdata = CKEDITOR.instances.posting_text.getData();
            $('#job_posting_text').val(ckdata);
            
            $("#replacing_emp").attr('disabled', false);
            loading_box(base_url);

            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Job_Requisition';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    $("#location_id").select2({
        placeholder: "Select Location",
        allowClear: true,
    });

    $("#department_id").select2({
        placeholder: "Select Department",
        allowClear: true,
    });

    $("#position_id").select2({
        placeholder: "Select Position",
        allowClear: true,
    });
    $("#reporting_manager_id").select2({
        placeholder: "Select Reporting Manager",
        allowClear: true,
    });
    $("#employment_status_id").select2({
        placeholder: "Select Employment Status",
        allowClear: true,
    });
    $("#priority").select2({
        placeholder: "Select Priority",
        allowClear: true,
    });
    $("#approver_id").select2({
        placeholder: "Select Approver",
        allowClear: true,
    });
    $("#employee_category").select2({
        placeholder: "Select Employee Category",
        allowClear: true,
    });
    $("#wages").select2({
        placeholder: "Select Wages",
        allowClear: true,
    });
    $("#posting").select2({
        placeholder: "Select Posting",
        allowClear: true,
    });

    $("#hire_reason").select2({
        placeholder: "Select Hire Reason",
        allowClear: true,
    });
    $("#replacing_emp").select2({
        placeholder: "Select Replacing Employee",
        allowClear: true,
    });

    function select_rep_emp(id)
    {
        if (id == 2)
        {
            $("#replacing_emp").attr('disabled', false);
        } else
        {
            $('[name="replacing_emp"]').select2().select2('val', '');
            $("#replacing_emp").attr('disabled', true);
        }

    }

    $(document).ready(function () {
        var idd = $("#hire_reason").val();
        select_rep_emp(idd);
    });

    function show_hourly_rate(id)
    {
        //alert (id);
        if (id == 2) {
            $('#hourly_rate_div').removeClass("hidden");
            $('#salary_range').val('');
            $('#salary_range').attr('readonly', true);
        } else {
            $('#hourly_rate_div').addClass("hidden");
            $('#hourly_rate').val('');
            $('#salary_range').attr('readonly', false);
        }
    }
    //function check_due_date(due_date)
    //{
    //var now = new Date();
    //var ddate = new Date($("#due_date").val())
    //alert (ddate);


//        if (id == 2) {
//            $('#hourly_rate_div').removeClass("hidden");
//            $('#salary_range').val('');
//            $('#salary_range').attr('readonly', true);
//        } else {
//            $('#hourly_rate_div').addClass("hidden");
//            $('#hourly_rate').val('');
//            $('#salary_range').attr('readonly', false);
//        }

    //}

//    function check_due_date(duedate) {
//        
//        var today = new Date();
//        if (Date.parse(duedate) > today) {
//            
//            alert ('a');
//            return true;
//            
//        }
//        else
//        {
//            alert ('b');
//            return false;
//        }
//        
//    }





</script>
<!--=== End Script ===-->


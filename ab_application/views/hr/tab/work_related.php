<?php
if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
    $location_query = $this->db->get_where('main_location', array('company_id' => $this->company_id, 'isactive' => 1));
    $department_query = $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
    $wages_query = $this->db->get_where('main_payfrequency', array('company_id' => $this->company_id, 'isactive' => 1));
    //$manager_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
} else {
    $location_query = $this->db->get_where('main_location', array('isactive' => 1));
    $department_query = $this->db->get_where('main_department', array('isactive' => 1));
    $wages_query = $this->db->get_where('main_payfrequency', array('isactive' => 1));
    //$manager_query = $this->db->get_where('main_employees', array('isactive' => 1));
}

$billing_cycle_array = $this->Common_model->get_array('billing_cycle');

$this->db->group_by('employee_id');
$query = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id, 'isactive' => 1));

if ($query->num_rows() > 0) {
    $type = 2;
} else {
    $type = 1;
}

if ($type == 1) {
    // echo $type;
    ?>
    <form id="work_related" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/save_work_related" enctype="multipart/form-data" role="form">
        <input type="hidden" value="" name="id"/>
        <div class="form-group no-margin">
            <label class="col-sm-2 control-label">Location<span class="req"/></label>
            <div class="col-sm-4">                
                <select name="location" id="location" onchange="set_reporting_manager(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                    <option></option>
                    <?php foreach ($location_query->result() as $key): ?>
                        <option value="<?php echo $key->id ?>"><?php echo $key->location_name ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <label class="col-sm-2 control-label">Department<span class="req"/></label>
            <div class="col-sm-4">
                <select name="department" id="department" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                    <option></option>
                    <?php foreach ($department_query->result() as $key): ?>
                        <option value="<?php echo $key->id ?>"><?php echo $key->department_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group no-margin">
            <label class="col-sm-2 control-label">Reporting Manager </label>
            <div class="col-sm-4">
                <select name="reporting_manager" id="reporting_manager" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                    <option></option>
                    <?php /* foreach ($manager_query->result() as $key): ?>
                        <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name . ' ' . $key->middle_name ?></option>
                    <?php endforeach; */ ?>
                </select>
            </div>
            <label class="col-sm-2 control-label">Wages</label>
            <div class="col-sm-4">
                <select name="wages" id="wages" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                    <?php
                    foreach ($wages_query->result() as $key):
                        $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                        ?>
                        <option value="<?php echo $key->freqtype ?>"><?php echo $freqtype ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group no-margin">
            <label class="col-sm-2 control-label">Employee Type </label>
            <div class="col-sm-4">                           
                <select name="employee_type" id="employee_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
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
            <label class="col-sm-2 control-label">Salary Type </label>
            <div class="col-sm-4">                           
                <select name="salary_type" id="salary_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                    <option></option>
                    <?php
                    $wage_type_array = $this->Common_model->get_array('wage_type');
                    foreach ($wage_type_array as $keyw => $valw):
                        ?>
                        <option value="<?php echo $keyw ?>"><?php echo $valw ?></option>
                        <?php
                    endforeach;
                    ?>
                </select> 
            </div>       
        </div>

        <div class="modal-footer">
            <button type="submit" id="submit" class="btn btn-u">Save</button>
            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees" ?>">Close</a>
        </div>
    </form>
    <?php
}
else if ($type == 2) { //Update
    //echo $type;
    ?>
    <form id="work_related" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/edit_work_related" enctype="multipart/form-data" role="form">
        <?php foreach ($query->result() as $row): ?> 
            <input type="hidden" value="<?php echo $row->id ?>" name="id_work_related"/>
            <div class="form-group no-margin">
                <label class="col-sm-2 control-label">Location<span class="req"/></label>
                <div class="col-sm-4">
                    <select name="location" id="location" onchange="set_reporting_manager(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <option></option>
                        <?php foreach ($location_query->result() as $key): ?>
                            <option value="<?php echo $key->id ?>" <?php if ($row->location == $key->id) echo "selected"; ?> ><?php echo $key->location_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label">Department<span class="req"/></label>
                <div class="col-sm-4">
                    <select name="department" id="department" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <option></option>
                        <?php foreach ($department_query->result() as $key): ?>
                            <option value="<?php echo $key->id ?>" <?php if ($row->department == $key->id) echo "selected"; ?> ><?php echo $key->department_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group no-margin">
                <label class="col-sm-2 control-label">Reporting Manager </label>
                <div class="col-sm-4">
                    <select name="reporting_manager" id="reporting_manager" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <?php 
                        
                            if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
                                $this->db->select('mm.employee_id,mm.first_name, mm.middle_name,mm.last_name');
                                $this->db->from('main_employees mm');
                                $this->db->join('main_emp_workrelated md', 'mm.employee_id = md.employee_id');
                                $this->db->where('md.location', $row->location);
                                $this->db->where('mm.isactive', 1);
                                $this->db->where('mm.company_id', $this->company_id);
                                $manager_query = $this->db->get();

                            } else {
                                $this->db->select('mm.employee_id,mm.first_name, mm.middle_name,mm.last_name');
                                $this->db->from('main_employees mm');
                                $this->db->join('main_emp_workrelated md', 'mm.employee_id = md.employee_id');
                                $this->db->where('md.location', $row->location);
                                $this->db->where('mm.isactive', 1);
                                $manager_query = $this->db->get();
                            }
        
                        foreach ($manager_query->result() as $key): ?>
                            <option value="<?php echo $key->employee_id ?>" <?php if ($row->reporting_manager == $key->employee_id) echo "selected"; ?>><?php echo $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name ?></option>
                        <?php endforeach; ?>
                            
                    </select>
                </div>
                <label class="col-sm-2 control-label">Wages</label>
                <div class="col-sm-4">
                    <select name="wages" id="wages" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <option></option>
                        <?php
                        foreach ($wages_query->result() as $key):
                            $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                            ?>
                            <option value="<?php echo $key->freqtype ?>"<?php if ($row->wages == $key->freqtype) echo "selected"; ?>><?php echo $freqtype ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group no-margin">
                <label class="col-sm-2 control-label">Employee Type </label>
                <div class="col-sm-4">                           
                    <select name="employee_type" id="employee_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                        <option></option>
                        <?php
                        $employee_type_array = $this->Common_model->get_array('employee_type');
                        foreach ($employee_type_array as $keyyy => $valll):
                            ?>
                            <option value="<?php echo $keyyy ?>" <?php if ($row->employee_type == $keyyy) echo "selected"; ?>><?php echo $valll ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select> 
                </div>        
                <label class="col-sm-2 control-label">Salary Type </label>
                <div class="col-sm-4">                           
                    <select name="salary_type" id="salary_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                        <option></option>
                        <?php
                        $wage_type_array = $this->Common_model->get_array('wage_type');
                        foreach ($wage_type_array as $keyw => $valw):
                            ?>
                            <option value="<?php echo $keyw ?>" <?php if ($row->salary_type == $keyw) echo "selected"; ?>><?php echo $valw ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select> 
                </div>        
            </div>

            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-u">Save</button>
                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees" ?>">Close</a>
            </div>
        <?php endforeach; ?>
    </form>

    <?php
}
?>

<script type="text/javascript">

    $("#location").select2({
        placeholder: "Select Location",
        allowClear: true,
    });

    $("#department").select2({
        placeholder: "Select Department",
        allowClear: true,
    });

    $("#reporting_manager").select2({
        placeholder: "Select Reporting Manager",
        allowClear: true,
    });

    $("#wages").select2({
        placeholder: "Select Wages",
        allowClear: true,
    });

    $("#employee_type").select2({
        placeholder: "Select Employee Type",
        allowClear: true,
    });
    $("#salary_type").select2({
        placeholder: "Select Salary Type",
        allowClear: true,
    });
    
    function set_reporting_manager(id){
         $.ajax({
            url: "<?php echo site_url('Con_Employees/load_reporting_manager/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#reporting_manager').html('');
                $('#reporting_manager').empty();
                
                $("#reporting_manager").select2({
                    placeholder: "Select Reporting Manager",
                    allowClear: true,
                });
        
                $('#reporting_manager').html(data);
            }
        })
    }

</script>  
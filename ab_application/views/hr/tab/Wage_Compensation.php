<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="emp_wage_compensation_div">
        <button class="btn btn-u btn-md" onClick="add_emp_wage_compensation()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-emp_wage_compensation" class="table table-striped table-bordered dt-responsive table-hover nowrap">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Date</th>
                    <th>Wage Type</th>
                    <th>Position</th>
                    <th>GL Codes</th>
                    <th>Pay Schedule</th>
                    <th>Hours per Pay Period</th>
                    <th>Per Hour Rate</th>
                    <th>Per Pay Period Salary</th>
                    <th>Yearly Salary</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $positions_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
                $employee_position=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','position');
                
                $wage_type_query=$this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id,'isactive' => 1));
                
                $wage_type_array = $this->Common_model->get_array('wage_type');
                $status_array = $this->Common_model->get_array('status');
                
                $query = $this->db->get_where('main_emp_wage_compensation', array('employee_id' => $employee_id,'isactive' => 1));
                 //echo $this->db->last_query();
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        
                        $per_hour_rate=" $". $row->per_hour_rate;
                        $per_pay_period_salary=" $". round($row->per_pay_period_salary,2);
                        ?>
                        <tr>
                            <td> <?php echo $i ?> </td>
                            <td><?php echo $this->Common_model->show_date_formate($row->wage_date) ?></td>
                            <td> <?php echo $wage_type_array[$row->wage_salary_type]; ?></td>
                            <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title'); ?></td>
                            <td><?php echo $this->Common_model->get_selected_value($this,'positionname',$row->position,'main_positions','gl_code'); ?></td>
                            <td><?php echo $this->Common_model->get_name($this, $row->pay_schedule,'main_payfrequency_type', 'freqcode'); ?></td>
                            <td><?php echo $row->hours_per_pay_period ?></td>
                            <td><?php echo $per_hour_rate; ?></td>
                            <td><?php echo $per_pay_period_salary; ?></td>
                            <td><?php echo $row->yearly_salary; ?></td>
                            <td><?php echo $status_array[$row->status]; ?></td>
                            <td>
                                <div class='action-buttons '>
                                    <?php //if($row->status==0) {?>
                                    <a href='javascript:void()' title="Edit" onclick='edit_wage_compensation("<?php echo $row->id ?>")'><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>
                                    <a href='javascript:void(0)' title="Delete" onclick='delete_data_wage_compensation("<?php echo $row->id ?>")'><i class='fa fa-trash-o'>&nbsp;&nbsp;</i></a>
                                    <?php //} ?>
                                </div>
                            </td>
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

<!-- Modal -->
<div class="modal fade" id="wage_compensation_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"> Wage Compensation </h4>
            </div>
            <form id="wage_compensation_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">    
                <input type="hidden" value="" name="id_emp_wage" id="id_emp_wage"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Position <span class="req"/> </label>
                        <div class="col-sm-4">
                            <select name="emp_wage_position" id="emp_wage_position" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($positions_query->result() as $key): ?>
                                    <option value="<?php echo $key->positionname ?>" <?php if($key->positionname==$employee_position) echo "selected"; ?>><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label"> Pay Schedule <span class="req"/> </label>
                        <div class="col-sm-4">
                            <select name="pay_schedule" id="pay_schedule" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <?php foreach ($wage_type_query->result() as $keyy): ?>
                                    <option value="<?php echo $keyy->wages ?>" ><?php echo $this->Common_model->get_name($this, $keyy->wages, 'main_payfrequency_type', 'freqcode'); ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label"> Salary Type </label>
                        <div class="col-sm-4">
                            <select name="wage_salary_type" id="wage_salary_type" onchange="change_salary_rate(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
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
                        <label class="col-sm-2 control-label"> Hours per Pay Period </label>
                        <div class="col-sm-4">
                            <input type="text" name="hours_per_pay_period" id="hours_per_pay_period" onblur="calculate_salary();" class="form-control input-sm" placeholder="Hours per Pay Period" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" id="salary_rate_lable"> Per Hour Rate ( $ )</label>
                        <div class="col-sm-4">
                            <input type="text" name="per_hour_rate" id="per_hour_rate" class="form-control input-sm" placeholder="Per Hour Rate ( $ )" onblur="calculate_salary();" >
                        </div>
                        <label class="col-sm-2 control-label">Yearly Salary</label>
                        <div class="col-sm-4">
                            <input type="text" name="yearly_salary" id="yearly_salary" onblur="set_yearly_salart();" class="form-control input-sm" placeholder="Yearly Salary ( $ )" title="Yearly Salary" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label"> Per Pay Period Salary ( $ )</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="per_pay_period_salary" id="per_pay_period_salary" class="form-control input-sm" placeholder="Per Pay Period Salary ( $ )" >
                        </div>
                        <label class="col-sm-2 control-label"> Date </label>
                        <div class="col-sm-4">
                            <input type="text"  name="wage_date" id="wage_date" class="form-control input-sm dt_pick" placeholder="Date" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label"> Status </label>
                        <div class="col-sm-4">
                            <select name="wage_status" id="wage_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $status_array = $this->Common_model->get_array('status');
                                foreach ($status_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>" <?php if ($key == 1) echo "selected" ?> ><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 ">
                            
                            <div class="col-md-12 pull-right">
                                <label class="col-sm-12 pull-right" id="per_pay_period_salary_table_label"><u><h4> </h4></u></label>
                            </div>
                            
                            <table id="per_pay_period_salary_table" class="table table-striped table-bordered dt-responsive table-hover">

                            </table>
                        </div>
                    </div>
                    
                    
                    
                </div>   
            </form>
            
                    
        </div>
    </div>
</div>



<script type="text/javascript">
    
    $(document).ready(function () {
        $('#dataTables-example-emp_wage_compensation').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 5,
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_emp_wage_compensation()
    {
        save_method = 'add';
        $('#wage_compensation_form')[0].reset(); // reset form on modals
        $('#wage_compensation_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Employee Wage Compensation'); // Set Title to Bootstrap modal title
        
        //set_per_hour_rate();
        
        $("#wage_salary_type").select2({
            placeholder: "Salary Type",
            allowClear: true,
        });
    }
    
    function set_per_hour_rate()
    {
        var id=$('#emp_wage_position').val();
        $.ajax({
            url: "<?php echo site_url('Con_Employees/set_per_hour_rate/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                $('#per_hour_rate').val(data);
            }
        });
    } 
    
    function calculate_salary()
    {
        var hours_per_pay_period=$('#hours_per_pay_period').val();
        var per_hour_rate=$('#per_hour_rate').val();
        var salary=(hours_per_pay_period*per_hour_rate);
        $('#per_pay_period_salary').val(salary);
        $('#yearly_salary').val(2080*per_hour_rate);
        
    } 
    
    function set_yearly_salart()
    {
        var yearly_salary=$('#yearly_salary').val();
        var per_hour_rate=(yearly_salary/2080);
        $('#per_hour_rate').val(per_hour_rate);
        $('#hours_per_pay_period').val('2080');
        
        show_PerPay_Period_Salary($('#per_hour_rate').val());
         
    }
    
    function show_PerPay_Period_Salary(per_hour_rate)
    {
        $("#per_pay_period_salary_table tr").remove();
        $('#per_pay_period_salary_table').append(
            '<tr>'
                + '<td>Weekly Salary : </td>'
                + '<td>40 Hours X Hourly Rate   : </td>'
                + '<td>' + (40*per_hour_rate) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Bi-Weekly Salary : </td>'
                + '<td>80 Hours X Hourly Rate : </td>'
                + '<td>' + (80*per_hour_rate) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Semi-Monthly Salary : </td>'
                + '<td>86.67 Hours X Hourly Rate : </td>'
                + '<td>' + (86.67*per_hour_rate) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Monthly Salary : </td>'
                + '<td>173.333 Hours X Hourly Rate  : </td>'
                + '<td>' + (173.333*per_hour_rate) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Yearly Salary : </td>'
                + '<td>2080 X Hourly Rate  : </td>'
                + '<td>' + (2080*per_hour_rate) + '</td>'
            + '</tr>'
        );
        
    }
    
    
    function change_salary_rate(id)
    {
        if(id==0){
            $('#per_hour_rate').prop('readonly', true);
            $('#yearly_salary').prop('readonly', false);
            
        }else{
            $('#per_hour_rate').prop('readonly', false);
            $('#yearly_salary').prop('readonly', true);
        }
    }
    
    $("#emp_wage_position").select2({
        placeholder: "Select Position ",
        allowClear: true,
    });
    
    $("#pay_schedule").select2({
        placeholder: "Pay Schedule",
        allowClear: true,
    });
    
    $("#wage_salary_type").select2({
        placeholder: "Salary Type",
        allowClear: true,
    });
    
    $("#wage_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
    
    
    
</script>
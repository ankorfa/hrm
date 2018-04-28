
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->
            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">            
                <form id="sky-form11" name="sky-form11" class="form-horizontal" action="<?php echo base_url(); ?>Con_AttendanceEntry/save_empAttendance" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Department:</label>
                        <div class="col-sm-4">
                            <select name="department_id" id="department_id" onchange="load_emp_attendance(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($department->result() as $row) {
                                    print"<option value=" . $row->id . ">" . $row->department_name . "</option>";
                                }
                                ?>
                            </select>    
                        </div>
                        <label class="col-sm-2 control-label">Employee:</label>
                        <div class="col-sm-4">
                            <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>

                            </select>    
                        </div>                    
                    </div>
                    <div class="form-group">                    
                        <label class="col-sm-2 control-label">Date:</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="attendance_date" id="attendance_date"  class="form-control dt_pick" placeholder="Date" />                    
                        </div>
                        <label class="col-sm-2 control-label">In Time:</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="in_time" id="in_time" onchange="time_calculation();" class="form-control timepicker" placeholder="In Time" />                    
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Out Time:</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="out_time" id="out_time" onchange="time_calculation();" class="form-control timepicker" placeholder="Out Time" />                    
                        </div>
                        <label class="col-sm-2 control-label">Duration:</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="duration" id="duration" readonly class="form-control" placeholder="Duration" />                    
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <!--                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
                    </div>
                </form>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
//    $(function() {
//      $( "#attendance_date" ).datepicker({  maxDate: new Date() });
//     }); 
     
    function time_calculation(){
        var start_time = $('#in_time').val();
        var end_time = $('#out_time').val();

        var diff = ( new Date("1970-1-1 " + end_time) - new Date("1970-1-1 " + start_time) ) / 1000 / 60 / 60; 
        $('#duration').val(diff);
    }
    
    $(function () {
        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //$('#sky-form11')[0].reset();
                //alert(data);

                var url = '<?php echo base_url() ?>Con_AttendanceEntry';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });


    function load_emp_attendance(id) {
//        alert(id);return;
        $.ajax({
            url: "<?php echo site_url('Con_AttendanceEntry/dep_emp/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#employee_id').html(data);
            }
        })
    }
    $("#department_id").select2({
        placeholder: "Department Name",
        allowClear: true,
    });
    $("#employee_id").select2({
        placeholder: "Employee Name",
        allowClear: true,
    });

    $('#in_time').timepicker({
        showMeridian: false
    });

    $(document).ready(function () {
        $('#in_time').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: true,
//            showMeridian:false
        });
    });

    $('#out_time').timepicker({
        showMeridian: false
    });
    $(document).ready(function () {
        $('#out_time').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: true
        });
    });




</script>
<!--=== End Content ===-->


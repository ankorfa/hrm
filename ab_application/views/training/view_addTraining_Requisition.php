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
            <div class="col-md-12 " style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Requisition/save_Training_Requisition" enctype="multipart/form-data" role="form" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Name <span class="req"/> </label>
                        <div class="col-sm-3"> 
                            <div id="training_id_div">
                                <select name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($training_query->result() as $row) {
                                        print"<option value='" . $row->id . "'>" . $row->training_name . "</option>";
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <label class="col-sm-1 control-label"> 
                            <a onClick="add_training()" href="#" title="Add Training"><span class="badge badge-u"> New </span> </a>
                        </label>
                        <label class="col-sm-2 control-label">Proposed Date<span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="proposed_date" id="proposed_date" class="form-control dt_pick input-sm" placeholder="Proposed Date" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Objective </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_objective" name="training_objective"></textarea>
                        </div>
<!--                        <label class="col-sm-2 control-label"> Training Output </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_output" name="training_output"></textarea>
                        </div>-->
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Outcome </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_outcome" name="training_outcome"></textarea>
                        </div>
                    </div>-->
                    
                    <div class="col-md-12 pull-right">
                        <label class="col-sm-12 pull-right"><u><h4>Select Employee For Training </h4></u></label>
                    </div>
                    
                    <div class="table-responsive col-md-12 col-centered">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th> &nbsp; </th>
                                    <th>Employee ID </th>
                                    <th>Employee Name </th>
                                    <th>Position </th>
                                    <th>Hire Date </th>
                                    <th>Location </th>
                                    <th>Department </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($employees_query) {
                                    $sl = 0;
                                    foreach ($employees_query->result() as $row) {
                                        $sl++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . "<input name='employee_id[]' id='employee_id' type='checkbox' value='$row->employee_idd'>" . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . sprintf("%07d", $row->employee_idd) . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->employee_name($row->employee_idd) . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->hire_date) . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') . "</td>";
                                        print"</tr>";
                                    }
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Requisition" ?>">Close</a>
                    </div>
                </form>
            </div>
                <?php
            } else if ($type == 2) {//edit
                ?>
            <div class="col-md-12 " style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Requisition/update_Training_Requisition" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                    <input type="hidden" value="<?php echo $row->id ?>" name="id" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Name <span class="req"/> </label>
                        <div class="col-sm-4"> 
                            <div id="training_id_div">
                                <select name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($training_query->result() as $trow) {
                                        ?>
                                        <option value="<?php echo $trow->id ?>" <?php if ($trow->id == $row->training_id) echo "selected" ?> ><?php echo $trow->training_name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Proposed Date<span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="proposed_date" id="proposed_date" value="<?php echo $this->Common_model->show_date_formate($row->proposed_date) ?>" class="form-control dt_pick input-sm" placeholder="Proposed Date" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                       <?php  /* <label class="col-sm-2 control-label"> Employee <span class="req"/> </label>
                        <div class="col-sm-4">
                            <select multiple name="employee[]" id="employee" class="col-sm-12 col-xs-12 myselect2 input-sm" title="Employee" >
                                <option></option>
                                <?php 
                                foreach ($employees_query->result() as $key): 
                                    $employee = explode(",", $row->employee);
                                    $isSel = '';
                                    foreach($employee as $is):
                                        if((int)$is == (int)$key->employee_id){
                                            $isSel = 'selected';
                                            break;
                                        }
                                    endforeach;
                                    ?>
                                    <option value="<?php echo $key->employee_id ?>" <?php  echo $isSel; ?> > <?php echo $key->first_name.' '.$key->middle_name ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        */
                       ?>
                        <label class="col-sm-2 control-label"> Training Objective </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_objective" name="training_objective"> <?php echo $row->training_objective ?> </textarea>
                        </div>
<!--                        <label class="col-sm-2 control-label"> Training Output </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_output" name="training_output"> <?php // echo $row->training_output ?> </textarea>
                        </div>-->
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Outcome </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_outcome" name="training_outcome"> <?php // echo $row->training_outcome ?> </textarea>
                        </div>
                    </div>-->
                    
                    <div class="col-md-12 pull-right">
                        <label class="col-sm-12 pull-right"><u><h4>Select Employee For Training  </h4></u></label>
                    </div>
                    
                    <div class="table-responsive col-md-12 col-centered">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th> &nbsp; </th>
                                    <th>Employee ID </th>
                                    <th>Employee Name </th>
                                    <th>Position </th>
                                    <th>Hire Date </th>
                                    <th>Location </th>
                                    <th>Department </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $employee = explode(",", $row->employee);
                                        
                                if ($employees_query) {
                                    $sl = 0;
                                    foreach ($employees_query->result() as $rrow) {
                                        
                                        $isSel = '';
                                        foreach($employee as $is):
                                            if((int)$is == (int)$rrow->employee_idd){
                                                $isSel = 'checked';
                                                break;
                                            }
                                        endforeach;
                                
                                        $sl++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . "<input name='employee_id[]' id='employee_id' type='checkbox' value='$rrow->employee_idd' $isSel >" . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . sprintf("%07d", $rrow->employee_idd) . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->employee_name($rrow->employee_idd) . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $rrow->position, 'main_jobtitles', 'job_title') . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($rrow->hire_date) . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $rrow->location, 'main_location', 'location_name') . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $rrow->department, 'main_department', 'department_name') . "</td>";
                                        print"</tr>";
                                    }
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Requisition" ?>">Close</a>
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


<!-- Modal -->
<div class="modal fade" id="add_training_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Training</h4>
            </div>
            <form id="add_training_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_education"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Training Name <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="training_name" id="training_name" class="form-control input-sm" placeholder="Training Name" />
                        </div>
                        <label class="col-sm-2 control-label">Training Level <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="training_level" id="training_level" class="form-control input-sm" placeholder="Training Level" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Training Type <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <select name="training_type" id="training_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $training_type_array= $this->Common_model->get_array('training_type');
                                foreach ($training_type_array as $key=>$val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Duration (Hours) </label> 
                        <div class="col-sm-4">                            
                            <input type="text" name="duration" id="duration" class="form-control input-sm" placeholder="Duration (Hours) " />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Company Cost </label> 
                        <div class="col-sm-4">                            
                            <input type="text" name="company_cost" id="company_cost" class="form-control input-sm" onblur="calculate_cost()" onkeypress="return numbersonly(this, event)" placeholder="Company Cost ( $ ) " />
                        </div>
                        <label class="col-sm-2 control-label">Employee Cost </label>
                        <div class="col-sm-4">
                           <input type="text" name="employee_cost" id="employee_cost" class="form-control input-sm" onblur="calculate_cost()" onkeypress="return numbersonly(this, event)" placeholder="Employee Cost ( $ ) " />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Estimation Costing </label> 
                        <div class="col-sm-4">                            
                            <input type="text" name="estimation_costing" id="estimation_costing" class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Estimation Costing ( $ ) " />
                        </div>
                        <label class="col-sm-2 control-label">Plan Date </label>
                        <div class="col-sm-4">
                            <input type="text" name="plan_date" id="plan_date" class="form-control dt_pick input-sm" placeholder="Plan Date " autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Eligible ? </label>
                        <div class="col-sm-4">
                            <select multiple name="eligible[]" id="eligible" class="col-sm-12 col-xs-12 myselect2 input-sm" title=" Select Eligible (multiple)">
                                <option></option>
                                <?php
                                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                                    $eligible_query = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id,'isactive' => 1));
                                } else {
                                    $eligible_query = $this->db->get_where('main_employmentstatus', array('isactive' => 1));
                                }
                                foreach ($eligible_query->result() as $erow) {
                                    $eligible_name=$this->Common_model->get_name($this, $erow->workcodename, 'tbl_employmentstatus', 'employemnt_status')
                                    ?>
                                    <option value="<?php echo $erow->workcodename ?>" ><?php echo $eligible_name ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Status </label>
                        <div class="col-sm-4">
                            <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Basic Information </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="basic_information" name="basic_information"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Course Information </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="course_information" name="course_information"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12 pull-right">
                        <label class="col-sm-12 pull-right"><u><h4>Upload Training Documents  </h4></u></label>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <a href="#" onclick="upload_training_documents();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                <button type="button" class="btn btn-u">Upload</button>
                            </a> 
                            <input type="hidden" name="training_documents" id="training_documents" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="training_documents_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <form id="training_documents_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Document </label>
                        <div class="col-sm-8">
                            <input type="file" name="training_documents_file" id="training_documents_file" size="20" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            
            loading_box(base_url);
            
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                var url='<?php echo base_url() ?>Con_Training_Requisition';
                view_message(data,url,'','sky-form11');
               
            });
            event.preventDefault();
        });
    });

   
    $("#training_id").select2({
        placeholder: "Select Training Name",
        allowClear: true,
    });
  
    var save_method; //for save method string
    function add_training()
    {
        save_method = 'add';
        $('#add_training_form')[0].reset(); // reset form on modals
        $('#add_training_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add New Training'); // Set Title to Bootstrap modal title
    }
    
    $("#training_type").select2({
        placeholder: "Select Training Type",
        allowClear: true,
    });
    $("#eligible").select2({
        placeholder: "Select Eligible",
        allowClear: true,
    });
    
    $("#status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
    
    function calculate_cost()
    {
        var company_cost = parseFloat($('#company_cost').val(), 10);
        var employee_cost = parseFloat($('#employee_cost').val(), 10);
         
        var estimation_costing = (company_cost + employee_cost);
         
        $('#estimation_costing').val(estimation_costing);
    }
    
    function upload_training_documents(){
        $('#training_documents_form')[0].reset(); // reset form on modals
        $('#training_documents_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Training Documents'); // Set Title to Bootstrap modal title
    }

    $(function() {
        $('#training_documents_form').submit(function(e) {
            e.preventDefault();
            
            loading_box(base_url);
            
            $.ajaxFileUpload({
                url             :base_url + './Con_New_Training/upload_training_documents/', 
                secureuri       :false,
                fileElementId   :'training_documents_file',
                dataType    : 'JSON',
                success : function (data)
                {
                    
                    var datas = data.split( '__' );
                    $('#training_documents').val(datas[1]);
                    
                    var url='';
                    view_message(datas[0],url,'training_documents_Modal','training_documents_form');
                    
                }
            });
            return false;
        });
        
        $('.modal').on('hidden.bs.modal', function (e) {
            if ($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });
        
    });
    
    
    $(function () {
        $("#add_training_form").submit(function (event) {
            
            loading_box(base_url);
            
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Training_Requisition/save_New_Training') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Training_Requisition/save_New_Training') ?>";
            }
            $.ajax({
                url: url,
                data: $("#add_training_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '';
                view_message(data, url, 'add_training_Modal', 'add_training_form');

                $("#training_id_div").load(location.href + " #training_id_div");
               
                 setTimeout(function () {

                    $("#training_id").select2({
                        placeholder: "Select Training Name",
                        allowClear: true,
                    });

                }, 1000);

                
            });
            event.preventDefault();
        });
        

    
    });
    
    
   
</script>
<!--=== End Script ===-->


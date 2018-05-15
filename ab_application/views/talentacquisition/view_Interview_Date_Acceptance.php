<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Interview_Date_Acceptance/save_allInterview_Date_Acceptance" enctype="multipart/form-data" role="form" >
            <div class="col-md-12" style="margin-top: 10px">
                <div class="form-group">
                    <label class="col-sm-4 control-label">   </label>
                    <div class="col-sm-3">
                        <select name="acceptance_status" id="acceptance_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            foreach ($approver_status as $key => $val):
                                ?>
                                <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php
                            endforeach;
                            ?>                        
                        </select> 
                    </div>
                    <div class="col-sm-2 no-padding-left">
                        <button type="submit" id="submit" class="btn btn-u"> Process </button>                            
                    </div>
                </div>
            </div>
            
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_ScheduledInterviews/add_ScheduledInterviews"  ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Interviews Scheduled </a></br></br>-->
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th> &nbsp; </th>
                            <th>Requisition Id</th>
                            <th>Interviewer</th>
                            <th>Position</th>
                            <th>Candidate Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Acceptance Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $interview_status = $this->Common_model->get_array('interview_status');
                        if ($query) {
                            $sl = 0;


                            foreach ($query->result() as $row) {
                                $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
                                $sl++;
                                $pdt = $row->id;
                                $exp_interviewer = explode(",", $row->interviewer);
                                $interviewer = "";
                                foreach ($exp_interviewer as $key => $val) {
                                    if ($interviewer == "") {
                                        $interviewer = $this->Common_model->get_selected_value($this, 'employee_id', $val, 'main_employees', 'first_name');
                                    } else {
                                        $interviewer = $interviewer . " , " . $this->Common_model->get_selected_value($this, 'employee_id', $val, 'main_employees', 'first_name');
                                    }
                                }
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . "<input name='approver_id[]' id='approver_id' type='checkbox' value='$row->id'>" . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $interviewer . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_first_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_email') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'contact_number') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_status[$row->interview_status] . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $approver_status[$row->acceptance_status] . "</td>";
                                print"<td><div class='action-buttons '>"
                                        . "<a title='Preview' href='" . base_url() . "Con_Interview_Date_Acceptance/view_Interview_Date_Acceptance/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;"
                                        . "</div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
            </form>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

   
    $("#acceptance_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
    
    
    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Interview_Date_Acceptance';
                view_message(data, url,'','sky-form11');
            });
            event.preventDefault();
        });
    });


</script>
<!--=== End Content ===-->


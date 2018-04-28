
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Requisition_Approval/update_Training_Requisition_Approval_Status" enctype="multipart/form-data" role="form" >

                <?php
                //if ($query) {
                    //foreach ($query->result() as $row) {
                        ?>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right">Status <span class="req"/> </label>
                                <div class="col-sm-3">
                                    <select name="req_status" id="req_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $approver_status = $this->Common_model->get_array('approver_status');
                                        foreach ($approver_status as $key => $val):
                                            ?>
                                            <option value="<?php echo $key ?>" <?php //if($row->req_status==$key) echo "selected"; ?>><?php echo $val ?></option>
                                            <?php
                                        endforeach;
                                        ?>                        
                                    </select> 
                                </div>
                                <?php //if ($row->req_status!=1) { ?>
                                <div class="col-sm-2 no-padding-left">
                                    <button type="submit" id="submit" class="btn btn-u"> Process </button>                            
                                </div>
                                <?php //} ?>
                            </div>
                        </div>
                        <?php
                    //}
                //}
                ?>

                <div class="table-responsive col-md-12 col-centered">
                    <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th> &nbsp; </th>
                                <th>Training Name</th>
                                <th>Proposed Date</th>
                                <th>Employees</th>
                                <th>Training Objective</th>
<!--                                <th>Training Output</th>
                                <th>Training Outcome</th>-->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $requisition_by_array = $this->Common_model->get_array('requisition_by');
                            $status_array = $this->Common_model->get_array('status');
                            if ($query) {
                                $sl = 0;
                                foreach ($query->result() as $row) {

                                    $employee = explode(",", $row->employee);
                                    $employees = '';
                                    foreach ($employee as $emp) {
                                        if ($employees == '') {
                                            $employees = $this->Common_model->employee_name($emp);
                                        } else {
                                            $employees = $employees . "," . $this->Common_model->employee_name($emp);
                                        }
                                    }

                                    $sl++;
                                    $pdt = $row->id;
                                    print"<tr>";
                                    print"<td id='catA" . $pdt . "'>" . "<input name='approver_id[]' id='approver_id' type='checkbox' value='$row->id'>" . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->proposed_date) . "</td>";
                                    print"<td class='td-cw' id='catA" . $pdt . "'>" . $employees . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $row->training_objective . "</td>";
                                    //print"<td id='catA" . $pdt . "'>" . $row->training_output . "</td>";
                                    //print"<td id='catA" . $pdt . "'>" . $row->training_outcome . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $approver_status[$row->req_status] . "</td>";
                                    print"<td id='catB" . $pdt . "'><a title='Preview' href='" . base_url() . "Con_Training_Requisition_Approval/view_Training_Requisition/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a></td>";
                                    print"</tr>";
                                }
                            }
                            ?> 
                        </tbody>
                    </table>
                </div>
            </form>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">


    $("#req_status").select2({
        placeholder: " Select Status",
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

                var url = '<?php echo base_url() ?>Con_Training_Requisition_Approval';
                view_message(data, url, '', 'sky-form11');
            });
            event.preventDefault();
        });
    });


</script>
<!--=== End Content ===-->


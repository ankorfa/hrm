
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
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Requisitions_Approval/update_req_Status" enctype="multipart/form-data" role="form" >
                <div class="col-md-12" style="margin-top: 10px">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right">Status <span class="req"/> </label>
                        <div class="col-sm-3">
                            <select name="req_status" id="req_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
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
                
                <div class="table-responsive col-md-12 col-centered">

                    
                    <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th></th>
                                <th>Requisition Id</th>
                                <th>Location</th>
                                <th>Department</th>
                                <th>Requisitions Date</th> 
                                <th>Due Date</th>
                                <th>Position</th> 
                                <th>Required no. of Positions</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query) {
                                foreach ($query->result() as $row) {
                                    
                                    if($row->req_status==0){
                                        $status = $approver_status[$row->req_status];
                                    }  else {
                                        $status=$approver_status[$row->req_status];
                                    }
                                    
                                    $pdt = $row->id;
                                    print"<tr>";
                                    print"<td id='catA" . $pdt . "'>" . "<input name='approver_id[]' id='approver_id' type='checkbox' value='$row->id'>" . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $row->requisition_code . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->location_id,'main_location','location_name')."</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name') . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->requisitions_date). "</td>";
                                    print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->due_date) . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') . "</td>";
                                    print"<td id='catD" . $pdt . "'>" . $row->no_of_positions . "</td>";
                                    print"<td id='catB" . $pdt . "'>" . $status . "</td>";
                                    print"<td id='catB" . $pdt . "'><a title='Preview' href='" . base_url() . "Con_Requisitions_Approval/view_requisition/" . $row->id . "/' target='_blank' ><i class='fa fa-lg fa-eye'></i></a></td>";
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

                var url = '<?php echo base_url() ?>Con_Requisitions_Approval';
                view_message(data, url,'','sky-form11');
            });
            event.preventDefault();
        });
    });


</script>
<!--=== End Content ===-->

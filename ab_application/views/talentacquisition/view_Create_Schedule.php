<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Create_Schedule/add_Create_Schedule" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Scheduled </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requisition Id</th>
                            <th>Interview Type</th>
                            <th>Interview Date</th>
                            <th>Interview Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $interview_status = $this->Common_model->get_array('interview_status');
                        $interview_type = $this->Common_model->get_array('interview_type');
                        if ($query) {
                            $sl=0;
                            foreach ($query->result() as $row) {
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_type[$row->interview_type] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->interview_date) ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->interview_time ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_status[$row->status]."</td>";
                                print"<td><div class='action-buttons '>&nbsp;<a title='Edit' href='" . base_url() . "Con_Create_Schedule/edit_Create_Schedule/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;&nbsp;<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_Create_Schedule/delete_Create_Schedule/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->


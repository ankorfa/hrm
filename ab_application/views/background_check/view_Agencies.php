
<div class="col-md-10 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Agencies/add_agencies" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Agency </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Agency Name</th>
                            <th>Website URL</th>
                            <th>Primary Phone</th>
                            <th>Secondary Phone</th>                            
                            <th>Screening Type</th>
                            <th>Address </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                print"<td id='catA" . $pdt . "'>" . ucwords($row->agency_name) . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->website_url . "</td>";   
                                print"<td id='catD" . $pdt . "'>" . $row->primary_phone . "</td>";   
                                print"<td id='catD" . $pdt . "'>" . $row->secondary_phone . "</td>";   
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->screening_id,'main_screening_types','screening_type')."</td>";
                                print"<td id='catA" . $pdt . "'>" . ucwords($row->address) . "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_Agencies/edit_agencies/" . $row->id ."' title='Edit'><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(". $row->id .")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    function delete_data(id){
        
        var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = base_url+"Con_Agencies/delete_agencies/"+id;
        else
          return false;
    } 


</script>
<!--=== End Content ===-->


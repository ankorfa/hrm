<style>
.datepicker-inline {
    width: 100% !important;
    height: 100% !important;
}


div.datepicker-days > table{
    width: 100% !important;
    height: 100% !important;
    font-size:1.5em;
}

div.datepicker-days > table thead tr{
     font-size: 24px !important;
}

div.datepicker-days > table tbody tr{
    height:60px;
}

.activeClass{
    /*background: #ffcc00;*/ 
    /*background: #72c02c;*/ 
    
    background: #b4e391; /* Old browsers */
    background: -moz-linear-gradient(top, #b4e391 0%, #61c419 50%, #b4e391 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top, #b4e391 0%,#61c419 50%,#b4e391 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom, #b4e391 0%,#61c419 50%,#b4e391 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4e391', endColorstr='#b4e391',GradientType=0 ); /* IE6-9 */
   
  }
  

</style>

<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <!--<li><a href="<?php // echo base_url() . 'Con_SelfService' ?>">HRM</a></li>-->
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            
            <div class="tab-pane fade in active" id="home-1">
                <form action="#" id="sky-form" class="sky-form">
                    <fieldset>
                        <section>
                            <div id="inline"></div>
                        </section>

                    </fieldset>
                </form>
            </div>
            
        </div>
        <?php if ($user_group == 10){ ?>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
            <div class="container col-md-12">
                <div class="col-md-12">
                    <div align="center" id="container_chart"></div>
                </div>
            </div>
        </div>
        
        <?php } ?>
    </div>
</div>

<style type="text/css">
    #container_chart{min-width:410px !important; width:100% !important; height:400px !important; margin:0 auto !important}
    .highcharts-credits{display:none !important}
</style>

<?php
if ($user_group == 10) {
    
    //$user_id
    $emp_id= $this->Common_model->get_selected_value($this,'emp_user_id',$user_id,'main_employees','employee_id');
    
    $this->db->select("main_leave_transaction.leave_type, SUM(`number_of_days`) AS consumed_days, main_leave_policy.max_limit, leave_code, leave_short_code");
    $this->db->join("main_leave_policy", "main_leave_policy.leave_type = main_leave_transaction.leave_type");
    $this->db->join("main_employeeleavetypes", "main_employeeleavetypes.id = main_leave_policy.leave_type");
    $this->db->where("main_leave_transaction.employee_id=$emp_id");
    $this->db->group_by("main_leave_transaction.leave_type");
    $chart_data = $this->db->get("main_leave_transaction")->result_array();
//    echo $this->db->last_query();

    //pr($chart_data);
}
?>
<script src="<?php echo base_url(); ?>assets/chart/hschart/highcharts.js"></script>

<script type="text/javascript">
<?php if ($user_group == 10) { ?>

        Highcharts.chart('container_chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Leave Type wise Allocated and Consumed Leave Days'
            },
            xAxis: {
                categories: [
    <?php
    if (!empty($chart_data)) {
        $pieces = array();
        foreach ($chart_data as $value) {
            $pieces[] = "'" . $value['leave_code'] . "'";
        }
        echo implode(',', $pieces);
    }
    ?>
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Day(s)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">Leave Type: {point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0"> {series.name}(s) : </td>' +
                        '<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
    <?php
    if (!empty($chart_data)) {
        $total_leave = $total_consumed = $balance = array();

        foreach ($chart_data as $row) {
            $total_leave[] = $row['max_limit'];
            $consumed_leave[] = $row['consumed_days'];
            $balance_leave[] = ($row['max_limit'] - $row['consumed_days']);
        }

        echo "{
                color: '#95CEFF',
                name: 'Allocated Leave',
                data: [" . implode(',', $total_leave) . "]";
        echo "},{
                color: '#FFBC75',
                name: 'Consumed Leave',
                data: [" . implode(',', $consumed_leave) . "]";
        echo "},{
                color: '#72C02C',
                name: 'Remaining Leave',
                data: [" . implode(',', $balance_leave) . "]";
        echo "}";
    }
    ?>
            ]
        });

<?php } ?>
</script>

<?php
if ($user_group == 10) {
    
    $emp_id=$this->Common_model->get_selected_value($this,'emp_user_id',$this->user_id,'main_employees','employee_id');
    
    $this->db->order_by("number_of_days","desc");
    $query = $this->db->get_where('main_leave_request', array('isactive' => 1,'leave_status' => 1,'employee_id' => $emp_id ));
    //echo $this->db->last_query();
    
    $fn_date="";
    $leave_date="";
    $lleave="";
    if ($query) {
        foreach ($query->result() as $row) {
            
            if($row->number_of_days>1)
            {
                for ($x = 0; $x < $row->number_of_days; $x++) {
                   //echo $x."=="."<br>";
                   if($lleave=="")
                   {
                       $ddate=$this->Common_model->add_date($row->from_date,$x);
                       $lleave='"' .date("n-j-Y",strtotime($ddate)). '"';
                   }
                   else
                   {
                       $ddate=$this->Common_model->add_date($row->from_date,$x);
                       $lleave=$lleave.",".'"' .date("n-j-Y",strtotime($ddate)). '"';
                   }
                } 
            }
            else {
                    $lleave='"' .date("n-j-Y",strtotime($row->from_date)). '"';
//                if($leave_date=="") $leave_date='"' .date("n-j-Y",strtotime($row->from_date)). '"';
//                else $leave_date=$leave_date.",". '"' .date("n-j-Y",strtotime($row->from_date)). '"';
            }
            
            if($fn_date==""){ $fn_date=$lleave; } else {$fn_date=$fn_date.",".$lleave; }
        }
  
    }
    
    //echo $fn_date;
    //echo $lleave;
    //echo $leave_date;
}
?>
<style type="text/css">
    #elsignature {
            border: 2px dotted black;
            background-color:lightgrey;
    }
</style>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="electronic_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"> CONSENT FOR USE OF ELECTRONIC SIGNATURES AND DOCUMENTS </h4>
            </div>
            <form id="electronic_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="row">
                         <div class="col-md-2 col-md-offset-5" >
                                <?php
                                if ($this->user_group != 1 || $this->user_group != 2 || $this->user_group != 3) {
                                    $logo = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_logo');
                                    if ($logo != "") {
                                        $src = base_url() . "uploads/companylogo/" . $logo;
                                        ?>
                                        <a href="<?php echo base_url() . 'Con_dashbord' ?>">
                                            <img src="<?php echo $src; ?>" alt="Logo" height="50px;">
                                        </a>
                                        <?php
                                    }
                                }
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" container">
                            <p><strong>Please read the following information:</strong> By signing this document, you are agreeing that you have reviewed the following consumer disclosure information and consent to transact business using electronic communications, to receive notices and disclosures electronically, and to utilize electronic signatures in lieu of using paper documents. You are not required to receive notices and disclosures or sign documents electronically. If you prefer not to do so, you may request to receive paper copies and withdraw your consent at any time.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" container">
                             <p style=" text-align: center; "><h3>CONSENT FOR USE OF ELECTRONIC SIGNATURES AND DOCUMENTS</h3></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" container">
                             <p> For the purposes of this Consent, “Client”, “You” and “Your” refers to You, the person accessing the www.hrcsoft.com  and/or your employer - Websites (the “Websites”).  “Company”, “Ourselves”, “We” and “Us” refers to HRC Soft a product of HRC Service LLC, Inc. dba Hospitality Resource Center LLC. “Party”, “Parties”, or “Us”, refers to both the Client and Company, or either the Client or Company. </p>
                             <p> The purpose of this consent is to ensure that you are fully aware of the consequences of agreeing to receive and sign documents electronically. . </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" container">
                            <h2> Terms </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" container">
                             <p> “Electronic documents” include documents you may complete via web page and save on your computer or attach to e-mail. They can typically be printed out, but exist independently in an electronic form on a server or on your computer. . </p>
                             <p> An “electronic signature” includes any mark, symbol, sound or process that is written, stamped, engraved, attached to or logically associated with an electronic document and executed by a person with the intent to sign. Just like you can legally “sign” a printed document by making your mark, whether that be your signature in ink or an “X,” so too you can "sign" an electronic document by making your mark, whether that be a high-tech encrypted or digital signature, or just typing your name in the signature line or space on an e-mail or document on the computer. These are all “electronic signatures.” If you sign a paper document in ink and then scan the document and save it on your computer, the image of the signature on the stored electronic document on your computer is also an electronic signature.  </p>
                             <p> 1. <strong>Right to Receive Paper Documents :</strong> You have the right to have any document provided in paper or non-electronic form. If you want a paper copy of any document, you may click the “Export to PDF” link on any electronic form, save to your computer and print to sign.   </p>
                             <p> 2. <strong>Right to Withdraw Consent :</strong> . You have the right to withdraw your consent to sign electronic documents with electronic signature by contacting HRC Service LLC or your employer through the Contact Us link on our websites. The legal validity and enforceability of the electronic documents, signatures and deliveries used prior to withdrawal of consent will not be affected. In other words, all prior electronic signatures shall be fully valid and enforceable.    </p>
                             <p> 3. <strong>Changes to Your E-Mail Address :</strong> You should keep Us informed of any change in your electronic or e-mail address. Please contact Us as promptly as possible at HRC Service LLC or your employer through the Contact Us link on our websites regarding any such changes. </p>
                             <p> 4. <strong>Minimum Hardware and Software Requirements :</strong> The following hardware and software are required to access (open and read) and retain (save) the electronic documents:</p>
                             <p>     • Operating Systems: Windows 98, Windows 2000, Windows XP or Windows Vista; or Macintosh OS 8.1 or higher.</p>
                             <p>     • Browsers: Internet Explorer 5.01 or above or equivalent. </p>
                             <p>     • Needed Software/Electronic Document Formats: Adobe Acrobat Reader or equivalent for PDF files; Word program for Word files.</p>
                             <p> 5. <strong>Your Ability to Access Disclosures :</strong> By completing this consent, you acknowledge that you can access and retain the electronic documents. </p>
                             <p> 6. <strong>Consent to Electronic Signatures and Documents :</strong> By completing this consent form, you are providing electronic consent to the use of electronic documents and signatures. </p>

                        </div>
                    </div>
                    <div class="row">
                        <div class=" container">
                            <h2> CONSENT: </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" container">
                             <p> I understand that the Company employs a proprietary digital signature technology developed by Company. This technology combines your authenticated user session with your device’s IP address and current date/time stamp to ensure you are the owner of the signature.  By registering for an applicant account and submitting an application for employment or volunteer opportunity through the HRC Service LLC services, I consent and agree to use this digital signature method. I understand that if I do not wish to “sign” this way, I may print out the document(s), sign by hand, and mail to the Company at HRC Service,18333 Dolan Way, Suite 211, Santa Clarita, CA 91387. </p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Signature </label>
                                <div class="col-sm-8">
                                    <div id="elsignature" ></div>
                                    <input type="hidden" name="scanvasData" id="scanvasData">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u"> Agree </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Decline </button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    
    var active_dates = [<?php  echo $fn_date; ?>];
    //var active_dates = ["5-11-2017"];
    
    jQuery(document).ready(function() {
        
        $('#inline').datepicker({
            format: 'mm-dd-yyyy',
            todayHighlight: true,
            autoclose: true,
            beforeShowDay: function(date){
                    var d = date;
                    var curr_date = d.getDate();
                    var curr_month = d.getMonth() + 1; //Months are zero based
                    var curr_year = d.getFullYear();
                    var formattedDate = curr_month + "-" + curr_date + "-" + curr_year
                    //alert (formattedDate);
                    if ($.inArray(formattedDate, active_dates) != -1){
                      return {
                         classes: 'activeClass'
                      };
                    }
                 return;
             }
        }).on('changeDate', showTestDate);
        
        function showTestDate(){
            var tdate = $('#inline').datepicker('getFormattedDate');
            //alert (tdate);
//            $.ajax({
//                url: "<?php //  echo site_url('Con_Training/ajax_training_Modal/') ?>/" + tdate,
//                type: "POST"
//            }).done(function (data) {
//                //alert(data);
//                $('#training_req').html(data);
//                
//                $('#Coy_Modal').modal('show'); // show bootstrap modal when complete loaded
//                $('.modal-title').text('Training Status'); // Set title to Bootstrap modal title
//            });
        }

    });
    
    
    var save_method;
    $(document).ready(function () {
        if(user_group==10)
        {
            var elflag = localStorage.getItem("elflag");
            if(elflag==0)
            {
            
                save_method = 'add';
                $('#electronic_form')[0].reset(); // reset form on modals
                $('#electronic_Modal').modal('show'); // show bootstrap modal
                $('.modal-title').text('ELECTRONIC SIGNATURES AND DOCUMENTS'); // Set Title to Bootstrap modal title
                localStorage.setItem("elflag", '1');
            }

        }
    });

    $(document).ready(function() {
        $("#elsignature").jSignature({'UndoButton':true});
        $('#elsignature .jSignature').attr('id', 'eljSignature');
        $("#elsignature").resize();
    })
    
    $(function () {
        $("#electronic_form").submit(function (event) {
            
            loading_box(base_url);
            var canvas = document.getElementById('eljSignature');
            var canvasData = canvas.toDataURL("image/png");
            
            //alert (canvasData);
            
            if(canvasData=="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQkAAABCCAYAAABEgCN/AAAAdklEQVR4nO3UQQ0AIAwEQfzVx6X+DYCAPnjCYyZZC7sWAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABcJKnu3pLel6ReP2EwCemfvpwEAAAAAAAAAAAAAAAAwwESLfOs9acD1wAAAABJRU5ErkJggg==")
            {
                $('#scanvasData').val('');
            }
            else {
                $('#scanvasData').val(canvasData);
            }
            
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_SelfService/save_electronic_form') ?>";
                //var url = $(this).attr('action');
            } else
            {
                url = "<?php echo site_url('Con_SelfService/save_electronic_form') ?>";
            }
            $.ajax({
                url: url,
                data: $("#electronic_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                
                var url = '';
                view_message(data, url, 'electronic_Modal', 'electronic_form');

            });
            event.preventDefault();
        });
    });
    
</script>

</div><!--/end row-->
</div><!--/end container-->

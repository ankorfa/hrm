<div class="col-md-12 main-content-div">
    <div class="main-content">

        <!--=== Breadcrumbs ===-->
        <div class="breadcrumbs">
            <div class="container">
                <h1 class="pull-left"> Company List Test1 </h1>
                <ul class="pull-right breadcrumb">
                    <!--                <li><a href="index.html">Home</a></li>
                                    <li><a href="">Pages</a></li>
                                    <li class="active">Clients</li>-->
                </ul>
            </div>
        </div><!--/breadcrumbs-->

        <!--=== Content Part ===-->
        <div class="container content">
            <div class="row">
                <div class="col-md-10 col-md-offset-1" >
                    <div class="headline"><h2>Company</h2></div>

                    <?php foreach ($query->result() as $row) { 
                        
                        if ($row->company_logo == "") {
                            $logo = base_url() . "uploads/blank.png";
                        } else {
                            $logo = base_url() . "uploads/companylogo/" . $row->company_logo;
                        }
                                
                        ?>
                        <!-- Clients Block-->
                        <div class="row clients-page">
                            <div class="col-md-2 ">
                                <img src="<?php echo $logo; ?>" class="img-responsive hover-effect  center-align" alt="" height="100" width="90"/>
                            </div>
                            <div class="col-md-10">
                                
                                <h3><a title="Change Company" href="<?php echo base_url() . 'Con_ChangeCompany/change_Companybyadmin/' . $row->id; ?>"><?php echo $row->company_full_name; ?></a></h3>
                                <ul class="list-inline">
                                    <li><i class="fa fa-map-marker color-green"></i> <?php echo $this->Common_model->get_name($this,$row->county_id,'main_county','county_name'); ?></li>
                                    <li><i class="fa fa-map-marker color-green"></i> <?php echo $row->address_1; ?></li>
                                    <li><i class="fa fa-globe color-green"></i> <a class="linked" href="#"><?php echo $row->email; ?></a></li>
                                    <li><i class="fa fa-mobile color-green" aria-hidden="true"> </i> <a class="linked" href="#"><?php echo $row->mobile_phone; ?></a></li>
                                    <li><i class="fa fa-briefcase color-green"></i> <?php echo $corporation_type[$row->corporation_type]; ?> </li>
                                </ul>
                                <!--<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati</p>-->
                            </div>
                        </div>
                        <hr>
                        <!-- End Clients Block-->
                    <?php } ?>

                </div><!--/col-md-9-->

            </div><!--/row-->
        </div><!--/container-->
        <!--=== End Content Part ===-->

    </div>
</div>

</div><!--/end row-->
</div><!--/end container-->

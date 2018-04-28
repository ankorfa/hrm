
<body id='loginscreen'>
    <div class="site-content">
        <div class="pull-right" style=" margin-right: 15px; margin-top: 5px; color: #360909;  ">
            <a style=" color: #360909;" class="" href="<?php echo base_url() . "Chome" ?>" > Sign in </a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="main-site">
                        <div class="login-form-area">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                                    <div class=""  style="font-size: 20px; text-align: center; font-style: normal; padding: 0 5px; text-transform: uppercase; line-height: 25px; ">

                                        <!-- <h6 style="color: #360909; font-weight: 500; font-size: 16px; text-align: center; font-family: 'Lato',sans-serif; ">
                                            Let’s find your account 
                                        </h6>-->
                                            Let’s find your account 
                                    </div>
                                    <div class="main-form">
                                        <div class="col-md-11" id='messagebox' style=" font-size: 14px; text-align: center; position: absolute; z-index: 9999 !important;"> </div>

                                        <div class="form-title" style=" padding-top: 50px;">
                                            <h6>Please enter your email </h6>
                                        </div>
                                        <div class="form-middle-content clearfix">
                                            <form action="<?php echo site_url('Chome/generate_forgot_password') ?>" class="loginform" method="post" id="forgot_password_frm">
                                                <div class="form-group single-group">
                                                    <label for="login-name" class="form-label">
                                                        <i class="icofont icofont-ui-user"></i>
                                                    </label>
                                                    <input type="email" class="erp-form" value="" placeholder="User Email" id="useremail" name="useremail">
                                                </div>
                                               
                                                <button type="submit" class="btn erp-btn" value='&nbsp;&nbsp;Login&nbsp;&nbsp;' name='SubmitUser'> Submit </button>
                                            </form>	
                                        </div>
                                        <div class="form-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
    
    <script>
     $(function(){
        $( "#forgot_password_frm" ).submit(function( event ) {
            //alert (base_url);
            //loading_box(base_url);
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#forgot_password_frm").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  alert (data);
                  var url='';
                  view_message(data,url);
              });
            event.preventDefault();
        });
    }); 
    
    
    function view_message(data, url) {

    if (data)
    {
        var datas = data.split('##');
        if (datas[1] == 1)//Successful==1
        {
            $("#messagebox").fadeTo(200, 0.1, function () {
                $(this).html(datas[0]).fadeTo(900, 1);
                $('html, body').animate({scrollTop: 0}, 800);
                $(this).fadeOut(5000);
            });

            if (url != '')
            {
                setTimeout(function () {
                    window.location.href = url;
                }, 5000);
            }
        } else//Not Successful ==2
        {
            $("#messagebox").fadeTo(200, 0.1, function () {
                $(this).html(datas[0]).fadeTo(900, 1);
                $('html, body').animate({scrollTop: 0}, 800);
                //$(this).fadeOut(5000);
            });
        }
    }
    else
    {
       $("#messagebox").fadeTo(200, 0.1, function () {
            $(this).html('No Message Found').fadeTo(900, 1);
            $('html, body').animate({scrollTop: 0}, 800);
            //$(this).fadeOut(5000);
        }); 
    }
}

    

</script>
    
    


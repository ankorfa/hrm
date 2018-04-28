
<body id='loginscreen' onload='defaultCompany()'>
    <div class="site-content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="main-site">
                        <div class="login-form-area">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                                    <div class="main-form">
                                        <div class="col-md-11" id='messagebox' style=" font-size: 14px; text-align: center; position: absolute; z-index: 9999 !important;"> </div>

                                        <div class="form-title">
                                            <h6>Welcome to HRC HR System</h6>
                                        </div>
                                        <div class="form-middle-content clearfix">
                                            <!--<div id="messagebox"> </div>-->

                                            <!--<form method='post' action='/posystem/' name='loginform' class='loginform'>-->
                                            <form action="<?php echo site_url('Chome/check_login') ?>" class="loginform" method="post" id="log_frm">
                                                <div class="form-group single-group">
                                                    <label for="login-name" class="form-label">
                                                        <i class="icofont icofont-ui-user"></i>
                                                    </label>
                                                    <!--<input type="text" class="erp-form" id="exampleInputEmail1" placeholder="User Name" name="user_name_entry_field"  value="" required>-->
                                                    <input type="text" class="erp-form" value="" placeholder="User Name" id="login-name" name="username">
                                                </div>
                                                <div class="form-group single-group">
                                                    <label for="login-pass" class="form-label">
                                                        <i class="icofont icofont-key"></i>
                                                    </label>
                                                    <!--<input type="password" class="erp-form" id="exampleInputPassword1" placeholder="Password" name="password"  value="" required>-->
                                                    <input type="password" class="erp-form" value="" placeholder="Password" id="login-pass" name="password">
                                                </div>
                                                <a style="color: #72c02c;" href="<?php echo base_url() . "Chome/forgot_password" ?>" > Forgot Password </a>
                                                <button type="submit" class="btn erp-btn" value='&nbsp;&nbsp;Login&nbsp;&nbsp;' name='SubmitUser' onclick='set_fullmode();'>Login</button>
                                            </form>	
                                        </div>
                                        <div class="form-footer">
                                            <p>Don't have a login? <span><a href="./index.php?signup=true">Try for free</a></span></p>
                                        </div>
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
       $( "#log_frm" ).submit(function( event ) {
           document.cookie = "login = false";
           var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#log_frm").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  
                  //alert (data);
                  var res = data.split("__"); 
                    if(res[0]==1)
                    {
                      localStorage.setItem("modtarget", 'Con_dashbord_mod');
                      document.cookie = "login = true";
                      window.location.href='<?php echo base_url() ?>'+ res[1]; 
                      //window.location.href='<?php //echo base_url() ?>con_configaration'; 
                      
                      localStorage.setItem("elflag", '0');
                      
                    }
                    else if(res[0]==2)
                    {
                      $('#log_frm')[0].reset();
                      var url='';
                      view_message(res[1],url);
                    }
                    else
                    {
                        $('#log_frm')[0].reset();
                        var url='';
                        view_message(data,url);
                    }

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



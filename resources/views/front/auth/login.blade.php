@extends('front.layouts.appAuth')
@section('title', 'Login Page')
@section('authContent')
<div class="page-content ">					
	<!-- Sign Up SECTION -->
	<div class="main-content loging_wrap">
		<div class="">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
						<div id="exTab1" class="login_screen">	
							<ul  class="nav nav-pills">
								<li class="active"><a  href="#1a" data-toggle="tab">Login</a></li>
								<li><a href="#2a" data-toggle="tab">Sign Up</a></li>
							</ul>
							<div class="tab-content clearfix">
								<!-- Login Page -->
								<div class="tab-pane active" id="1a">
									<form>
									@csrf
										<div class="form-group">
											<div class="email">
												<i class="fa fa-envelope" aria-hidden="true"></i>
												<input type="email" class="form-control" id="login_email" aria-describedby="emailHelp" placeholder="Enter email">
											</div>
										</div>
										<div class="form-group">	
											<div class="password">
												<i class="fa fa-lock" aria-hidden="true"></i>
												<input type="password" class="form-control" id="login_password" aria-describedby="emailHelp" placeholder="Password">
											</div>
										</div>
										<a class="forgot_ps" href="{{route('front.resetPassword')}}">Forgot Password?</a>
										<div class="login_btn"><button type="button" title="Log in" class="button ajaxLogin">
											<em class="fa-icon"><i class="fa fa-unlock"></i></em>
		                                    <span>Log in</span>
		                                </button>
										</div>
										<!-- <div class="on-account"> 
											Don't have on account? 
											<a href=""> sign up</a>
										</div> -->
									</form>
								</div>
								<!--/ Login Page -->
								<!-- Register Page -->
								<div class="tab-pane" id="2a">
									<form method="post" id="loginForm" name="loginForm">
									@csrf
										<div class="form-group">
											<div class="email">
												<i class="fa fa-user" aria-hidden="true"></i>
												<input type="name" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Name">
											</div>
												<strong><span class='name_error' style="color: red"></span></strong>
										</div>
										<div class="form-group">
											<div class="email">
												<i class="fa fa-user" aria-hidden="true"></i>
												<input type="Username" name="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Username">
											</div>
												<strong><span class='username_error' style="color: red"></span></strong>
										</div>
										<div class="form-group">
											<div class="email">
												<i class="fa fa-envelope" aria-hidden="true"></i>
												<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email Address">
											</div>
											<strong><span class='email_error' style="color: red"></span></strong>
										</div>
										<div class="form-group">	
											<div class="password">
												<i class="fa fa-lock" aria-hidden="true"></i>
												<input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Password">
											</div>
											<strong><span class='password_error' style="color: red"></span></strong>
										</div>
										<div class="form-group">	
											<div class="password">
												<i class="fa fa-lock" aria-hidden="true"></i>
												<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" aria-describedby="repeatpasswordHelp" placeholder="Confirm Password">
											</div>
											<strong><span class='passwordConfirm_error'  style="color: red"></span></strong>
										</div>
										<div class="form-group form-check">
										    <input type="checkbox" name="is_term_condition" class="form-check-input" id="is_term_condition">
										    <label class="form-check-label" for="exampleCheck1">By signing in, I accept the terms and conditions</label>
										</div>
										<strong><span class='terms_error' style="color: red"></span></strong>
										<div class="login_btn">
											<button type="button" title="Sign Up" class="ajaxRegister button" id="ajaxRegister">
		                                    	<span style="width:161px; text-align:center; vertical-align:middle;padding: 0;">Sign Up</span>
		                                	</button>
										</div>
										<!-- <div class="on-account"> 
											Already a member?
											<a href="">Login</a>
										</div> -->
									</form>
								</div>
								<!--/ Register Page -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Sign Up SECTION -->
</div>
@endsection

@section('authStyles')
<style type="text/css">
	.error{
		color: red;
	}
</style>
@endsection

@section('authScripts')
<!-- <script>
	function validatePassword() {
    var validator = $("#loginForm").validate({
        rules: {
            password: "required",
            confirmpassword: {
                equalTo: "#password"
            }
        },
        messages: {
            password: " Enter Password",
            confirmpassword: " Enter Confirm Password Same as Password"
        }
    });
    if (validator.form()) {
        alert('Sucess');
    }
}
</script> -->
<script> 
    $(document).on('click','.ajaxRegister',function(){
        var name=$('#name').val();
        var username=$('#username').val();
        var email=$('#email').val();
        var password=$('#password').val();
        var password_confirmation=$('#password_confirmation').val();
        var term=$('#is_term_condition:checked').val();    
        $.ajax({   
          url: "{{ route('front.register') }}",
          type: 'post',
          data: {"_token": "{{ csrf_token() }}",
            'name':name,'username':username,'email':email,'password':password,'password_confirmation':password_confirmation,'is_term_condition':term
          },
          success: function (response)
          {             
            if(response.status_code=='200'){
                console.log(response); 
                $.toast({
                    heading: 'success',
                    text: response.success_message,
                    position: 'top-right',
                    loaderBg:'#e69a2a',
                    icon: 'success',
                   
                    stack: false
                }); 
                 setTimeout(function(){
                    window.location.href='{{route("front.showLoginForm")}}';
                },2000)  
            }else{
                console.log(response);
             	$.toast({
                    heading: 'warning',
                    text: response.success_message,
                    position: 'top-right',
                    loaderBg:'#e69a2a',
                    icon: 'error',
                   
                    stack: false
                });               
            }
             
          },
          error: function(error) {
             console.log(error);
           }

       	});
        return false;
    });
</script>

<script> 
    $(document).on('click','.ajaxLogin',function(){
        var login_email=$('#login_email').val();
        var login_password=$('#login_password').val();   
        $.ajax({   
          url: "{{ route('front.login') }}",
          type: 'post',
          data: {"_token": "{{ csrf_token() }}",'email':login_email,'password':login_password
          },
          success: function (response)
          {             
            if(response.status_code=='200'){
                console.log(response); 
                $.toast({
                    heading: 'success',
                    text: response.success_message,
                    position: 'top-right',
                    loaderBg:'#e69a2a',
                    icon: 'success',
                   
                    stack: false
                }); 
                 setTimeout(function(){
                    window.location.href='{{route("front.index")}}';
                },2000)  
            }else{
                console.log(response);
             	$.toast({
                    heading: 'warning',
                    text: response.success_message,
                    position: 'top-right',
                    loaderBg:'#e69a2a',
                    icon: 'error',
                   
                    stack: false
                });               
            }
             
          },
          error: function(error) {
             console.log(error);
           }

       	});
        return false;
    });
</script>

@endsection

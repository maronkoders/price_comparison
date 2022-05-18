<template>
 <div>
        <div id="login-page">
	  	<div class="container">
		  <form class="form-login"  method="GET">
		 
				<h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="phonenumber" placeholder="Phonenumber" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" placeholder="Password">
		           <br>

                   	<router-link  to="/dashboard">
                        <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i>
                        SIGN IN
                        </button>
                    </router-link>
		            <hr>
		            <div class="registration">
		                Don't have an account yet?<br/>
					<a class="" href="#">
		                    Create an account
		                </a>
		            </div>
		
		        </div>
		      </form>	  	
	  	
	  	</div>
	  </div>
 </div>
</template>
<script>
export default {
    name:"login"
}
</script>
@extends('layouts.app')

@section('content')
@foreach($userData as $user)
<section class="row">
	<div class="col-8 offset-2">
		<form action="#" method='post' onsubmit='return false;'>
			<div class='row'>
				<div class="col">
					User Name
				</div>
				<div class="col">
					<input type="text" name='name' value='{{$user->name}}' placeholder='User Name' class='form-control'>
				</div>
			</div>
			<div class='row'>
				<div class="col">
					User E-Mail
				</div>
				<div class="col">
					<input type="email" name='email' value='{{$user->email}}' placeholder='User E-Mail' class='form-control'>
				</div>
			</div>
			<div class='row'>
				<div class="col">
					User Password (Leave blank if not changing)
				</div>
				<div class="col">
					<input type="password" name='password' placeholder='User Password' class='form-control'>
				</div>
			</div>
			<div class='row'>
				<div class="col">
					User Password Confirmation (Leave blank if not changing)
				</div>
				<div class="col">
					<input type="password" name='password_confirm' placeholder='User Password Confirmation' class='form-control'>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button type="button" id="submit">Update</button>
				</div>
			</div>
		</form>
	</div>
</section>

<script>
	$("#submit").click(function(){
	var baseData = {
			"name":$("[name='name']").val(),
			"email":$("[name='email']").val()
	};
	
	if($("[name='password']").val().length > 0){
		var pwData = {
			"password":$("[name='password']").val(),
			"password_confirm":$("[name='password_confirm']").val()
		}
		var userData = {...baseData,...pwData};
	}else{
		var userData = {..baseData};
	}
		$.post("<?php echo url('/user/update'); ?>",userData).always(function(data){
			console.log(data);
		});
	});
</script>
@endforeach
@endsection

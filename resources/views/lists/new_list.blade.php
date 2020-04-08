@extends('layouts.app')

@section('content')
<section class="row">
	<div class="col-8 offset-2">
		<form action="<?php echo url('/list/store'); ?>" method='post'>
			<div class="row">
				<div class="col-6">
					<div class="row">
						<div class="col-12">
							<label>List Name</label>
							<input type="text" name="name" placeholder="List Name" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-6" id="list-sections">
					<div class="row" id="list-root">
						<div class="col-12">
							<label>List Row Content</label>
							<input type="text" name="list[]" class="form-control" placeholder="List Row Content">
						</div>
					</div>
					<div class="row" id="add-button-wrapper" style="margin-top:1%;">
						<div class="col">
							<button type="button" id="add-row" class="btn btn-primary w-100">Add Row</button>
						</div>
						<div class="col">
							<button type="button" id="remove-row" class="btn btn-warning w-100">Remove Row</button>
						</div>
					</div>
				</div>
				<div class="col-6 offset-6">
				
					<div class="row">
						<div class="col form-check">
							<input type="checkbox" name="is_public" class="form-check-input" id="is_public">
							<label class="form-check-label" for="is_public">Make Post Public</label>
						</div>
						<div class="col form-check">
							<input type="checkbox" name="active" class="form-check-input" id="is_public">
							<label class="form-check-label" for="is_public">Make Post Active</label>
						</div>
					</div>	
					<div class="row">
						<div class="col-12">
							<label>Tags</label>
							<input type="text" name="tags" class="form-control" placeholder="Tags">
						</div>
					</div>	
				</div>
				<div class="col-12" style="margin-top:1%;">
					<button type="submit" id="submit" class="btn btn-primary w-100">Create List</button>
				</div>
			</div>
			
	<input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
		</form>
	</div>
</section>

<script>
	
	$("#add-row").click(function(){
		var lastList = $("#list-sections").find("[name='list[]']:last");
		if($(lastList).val().length){
			$("<div class='row'><div class='col-12'><label>List Row Content</label><input type='text' name='list[]' class='form-control' placeholder='List Row Content'></div></div>").insertBefore("#add-button-wrapper");
		}
	});
	
	$("#remove-row").click(function(){
		
		var lastList = $("#list-sections").find("[name='list[]']:last");
		if(!!$(lastList).parent().parent().attr("id")){
			return;
		}else{
			$(lastList).parent().parent().remove();
		}
	});
</script>
@endsection
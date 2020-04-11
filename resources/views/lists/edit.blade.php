@extends('layouts.app')

@section('content')
@foreach($listData as $list)
<section class="row">
	<div class="col-8 offset-2">
		<form action="#" method='post' id="edit-list-form">
			<div class="row">
				<div class="col-8 offset-2">
						<div class="row">
							<div class="col-12">
								<label>List Name</label>
								<input type="text" name="name" placeholder="List Name" class="form-control" value="{{$list->name}}">
							</div>
						</div>
					<div id="list-sections">
						<?php $listItems = unserialize($list->list); ?>
						<div class="row" id="list-root">
							<div class="col-12">
								<label>List Row Content</label>
								<input type="text" name="list[]" class="form-control" placeholder="List Row Content" value="<?php echo $listItems[0]; ?>">
							</div>
						</div>
						<?php for($i=1;$i<count($listItems);$i++): ?>					
						<div class="row">
							<div class="col-12">
								<label>List Row Content</label>
								<input type="text" name="list[]" class="form-control" placeholder="List Row Content" value="<?php echo $listItems[$i]; ?>">
							</div>
						</div>
						<?php endfor; ?>
						<div class="row" id="add-button-wrapper" style="margin-top:1%;">
							<div class="col">
								<button type="button" id="add-row" class="btn btn-primary w-100">Add Row</button>
							</div>
							<div class="col">
								<button type="button" id="remove-row" class="btn btn-warning w-100">Remove Row</button>
							</div>
							<div class="col">
								<button type="button" id="delete-list" class="btn btn-danger w-100">Delete List</button>
							</div>
							<div class="col">
								<button type="button" id="update-list" class="btn btn-success w-100">Update List</button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col form-check">
							<input type="checkbox" name="is_public" class="form-check-input" id="is_public" <?php if($list->is_public): ?> checked <?php endif; ?>>
							<label class="form-check-label" for="is_public">Make Post Public</label>
						</div>
						<div class="col form-check">
							<input type="checkbox" name="active" class="form-check-input" id="is_public" <?php if($list->active): ?> checked <?php endif; ?>>
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
			</div>
			
			<input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
			<input type="hidden" name="slug" value="{{$list->slug}}">
			<input type="hidden" name="id" value="{{$list->id}}">
		</form>
	</div>
</section>
@endforeach
<script>
	$("#delete-list").click(function(){
		$("#edit-list-form").attr("action","<?php echo url('/list/delete'); ?>");
		$("#edit-list-form").submit();
	});
	$("#update-list").click(function(){
		$("#edit-list-form").attr("action","<?php echo url('/list/update'); ?>");
		$("#edit-list-form").submit();
	});
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
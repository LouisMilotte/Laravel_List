@extends('layouts.app')

@section('content')
@foreach($listData as $list)
<?php $slug = $list->slug; ?>
<section class="row">
	<div class="col-8 offset-2">
		<h1><?php echo $list->name; ?></h1>
		<p>Created <?php echo date("d/m/Y",strtotime($list->created_at)); ?> - Post Is: <?php echo ($list->is_public == true ? "Public":"Not Public"); ?> and <?php echo ($list->active == true ? "Active":"Not Active"); ?></p>
		<ul class='list-group'>
			<?php $lists = unserialize($list->list); foreach($lists as $listItem):?>
			<li class="list-group-item"><?php echo $listItem; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
<section class="row" style="margin-top:1%;">
	<div class="col offset-2">
		<a href="<?php echo url("/list/edit/$slug"); ?>"><button type="button" class="btn btn-primary">Edit List</button></a>
	</div>
</section>
@endforeach
@endsection
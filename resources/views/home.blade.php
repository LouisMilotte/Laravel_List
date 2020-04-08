@extends('layouts.app')

@section('content')
<section class="row">
	<div class="col-12">
		<h1 class="text-center">Home</h1>
	</div>
</section>
<section class="row">
	<div class="col-8 offset-4">
		<div class="row">
			<div class="col-2" style="font-weight:bold;">
				Search for lists:
			</div>
			<div class="col">
				<form action="<?php echo url("/list/search");  ?>" method="post" class="form-inline">
					<div class="form-group">
						<label class="sr-only">Search Parameters</label>
						<input type="text" name="s_params" class="form-control" placeholder="Search Parameters">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Search</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<section class="row">
	<div class="col-8 offset-2">
	<p class="text-center">Please select from the list(s) below or create a new one above.</p>
	<?php if(isset($listData)): ?>
		<nav class="nav flex-column">
		<?php foreach($listData as $list): ?>
			<a href="<?php echo url("/list/show/".$list->slug); ?>" class="nav-link"><?php echo $list->name; ?></a>
		<?php endforeach; ?>
		</nav>
	<?php else: ?>
		Welcome to My Lists. Please register and login to create lists.
		<?php endif; ?>
	</div>
</section>
@endsection

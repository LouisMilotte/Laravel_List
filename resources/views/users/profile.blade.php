@extends('layouts.app')

@section('content')
@foreach($userData as $user)
<section class="row">
	<div class="col-6">
		<div class="row">
			<div class="col-12">
				<h1>Profile: {{$user->name}}</h1>
			</div>
		</div>
		
	</div>
	</div class="col-6">
		<div class="row">
			<div class="col-12">
				<h2>Lists</h2>
				<nav class="nav flex-column">
					@foreach($listsData as $list)
					<a href="<?php echo url("/list/show/".$list->slug); ?>" class="nav-item">{{$list->name}}</a>
					@endforeach
					</nav>
				</ul>
			</div>
		</div>
	</div>
</section>
@endforeach
@endsection
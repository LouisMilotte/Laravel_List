<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>My Lists</title>
  </head>
  <body>
	<article class="container-fluid">
		<header class="row">
			<div class="col-12">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="navbar-brand" href="#">Navbar</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item <?php if(url()->current() === url("/") || url()->current() === url("/home")): ?> active <?php endif; ?>">
								<a class="nav-link" href="<?php echo url("/home"); ?>">Home <?php if(url()->current() === url("/") || url()->current() === url("/home")): ?><span class="sr-only">(current)</span> <?php endif; ?></a>
							</li>
							@guest
							
							<li class="nav-item <?php if(url()->current() === url("/login")): ?> active <?php endif; ?>">
								<a class="nav-link" href="<?php echo url("/login"); ?>">Login <?php if(url()->current() === url("/")): ?><span class="sr-only">(current)</span> <?php endif; ?></a>
							</li>
							
							<li class="nav-item <?php if(url()->current() === url("/register")): ?> active <?php endif; ?>">
								<a class="nav-link" href="<?php echo url("/register"); ?>">Register <?php if(url()->current() === url("/")): ?><span class="sr-only">(current)</span> <?php endif; ?></a>
							</li>
							@endguest
							@auth
							<li class="nav-item <?php if(url()->current() === url("/user/account")): ?> active <?php endif; ?>">
								<a class="nav-link" href="<?php echo url("/user/account"); ?>">Account <?php if(url()->current() === url("/user/account")): ?><span class="sr-only">(current)</span> <?php endif; ?></a>
							</li>
							<li class="nav-item <?php if(url()->current() === url("/logout")): ?> active <?php endif; ?>">
								<a class="nav-link" href="<?php echo url("/logout"); ?>">Logout <?php if(url()->current() === url("/")): ?><span class="sr-only">(current)</span> <?php endif; ?></a>
							</li>
							<li class="nav-item <?php if(url()->current() === url("/list/create")): ?> active <?php endif; ?>">
								<a class="nav-link" href="<?php echo url("/list/create"); ?>">Create List <?php if(url()->current() === url("/")): ?><span class="sr-only">(current)</span> <?php endif; ?></a>
							</li>
							@endauth
						</ul>
						<form class="form-inline my-2 my-lg-0">
							<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						</form>
					</div>
				</nav>
			</div>
		</header>
		@yield('content')
		<footer class="row">
			<div class="col">
				<div class="col-12" style="font-weight:bold">Legal</div>
				<div class="col-12">&copy; 2020 Louis Milotte All Rights Reserved</div>
			</div>
		</footer>
	</article>
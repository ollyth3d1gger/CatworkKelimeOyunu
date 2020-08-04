@if(count($errors)>0)
<div class = "rounded err alert alert alert-danger alert-dismissable">
	<a href="#" class="close" data-dismiss="alert" alert-label="close"><font color="white">x</font></a>
	<b>Error</b>
	<ul>
		@foreach($errors->all() as $error)
		<li class="m-1">{{ $error }}</li>
		@endforeach
	</ul>

</div>
@endif
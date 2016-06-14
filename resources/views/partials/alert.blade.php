@if(Session::has('info'))
	<div class="container">
		<div class="alert alert-info" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			{{ Session::get('info') }}
		</div>
	</div>
@endif
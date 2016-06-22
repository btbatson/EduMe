<div class="chat-list">
	<ul>
		@foreach($chat_members as $member)
		<li>
			<a href="#" data-user-id="{{ $member->id }}">
				<div class="media">
					<div class="media-left">
						<img class="media-object avatar" src="{{$member->profile_pic}}" alt="">
					</div>
					<div class="media-body">
						<h4 class="media-heading">{{$member->getName()}} <span class="status offline"></span></h4>
					</div>
				</div>
			</a>
		</li>
		@endforeach
	</ul>
</div>
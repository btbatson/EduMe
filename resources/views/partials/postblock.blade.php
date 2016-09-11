@foreach($posts as $post)
<div class="row post">
	<div class="col-md-12">
		<div class="media">
			<div class="media-left">
				<a href="{{ route('profile.index', ['username' => $post->user->username ? $post->user->username : $post->user->id])}}">
					<img class="media-object avatar" src="{{ $post->user->getAvatarUrl() }}" alt="">
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading">
					<a href="{{ route('profile.index', ['username' => $post->user->username ? $post->user->username : $post->user->id])}}">{{ $post->user->getName() }}</a>
				</h4>
				<a href="#">{{ $post->created_at->diffForHumans() }}</a>
			</div>
		</div>
		<p class="content">{{ $post->content }}</p>
	</div>
	<div class="col-md-12">
		<div class="row optionBar">
			<div class="col-xs-4">
			@if(!Auth::user()->hasLikedPost($post))
				<div class="like">
					<a href="{{ route('post.like', ['postId' => $post->id] )}}">
						<i class="fa fa-heart-o" aria-hidden="true"></i> Like ({{ $post->likes->count() }})
					</a>
				</div>
			@else
				<div class="liked">
					<a href="{{ route('post.like', ['postId' => $post->id] )}}">
						<i class="fa fa-heart" aria-hidden="true"></i> Liked ({{ $post->likes->count() }})
					</a>
				</div>
			@endif
			</div>
			<div class="col-xs-4 comm">
				<a href="#">
					<i class="fa fa-comment-o" aria-hidden="true"></i> Comment
				</a>
			</div>
			<div class="col-xs-4 share">
				<a href="#">
					<i class="fa fa-share-alt" aria-hidden="true"></i> Share
				</a>
			</div>
		</div>
	</div>


	<div class="col-md-12 comment">
		@foreach($post->comments as $comment)
		<div class="media">
			<div class="media-left">
				<a href="{{ route('profile.index', ['username' => $comment->user->username ? $comment->user->username : $comment->user->id])}}">
					<img class="media-object avatar" src="{{ $comment->user->getAvatarUrl() }}" alt="">
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading">
					<a href="{{ route('profile.index', ['username' => $comment->user->username ? $comment->user->username : $comment->user->id])}}">{{ $comment->user->getName() }}</a>
				</h4>
				<a href="#">{{ $comment->created_at->diffForHumans() }}</a>
				<p>{{ $comment->content }}</p>
				<!-- <ul class="list-inline">
                    <li>{{ $comment->created_at->diffForHumans() }}</li>
                    @if($comment->user->id !== Auth::user()->id)
	                    <li><a href="{{ route('post.likeComment', ['CommentId' => $comment->id] )}}">Like</a></li>
	                @endif
                    <li>{{ $comment->likes->count() }} {{ str_plural('like', $comment->likes->count())}}</li>
                </ul> -->
			</div>

			<div class="row optionBar">
				<div class="col-xs-4">
				@if(!Auth::user()->hasLikedComment($comment))
					<div class="like">
						<a href="{{ route('post.likeComment', ['commentId' => $comment->id] )}}">
							<i class="fa fa-heart-o" aria-hidden="true"></i> Like ({{ $comment->likes->count() }})
						</a>
					</div>
				@else
					<div class="liked">
						<a href="{{ route('post.likeComment', ['commentId' => $comment->id] )}}">
							<i class="fa fa-heart" aria-hidden="true"></i> Liked
						</a>
					</div>
				@endif
				</div>
				<div class="col-xs-4 comm">
					<!-- <a href="#">
						<i class="fa fa-comment-o" aria-hidden="true"></i> Comment
					</a> -->
				</div>
				<div class="col-xs-4 share">
					<!-- <a href="#">
						<i class="fa fa-share-alt" aria-hidden="true"></i> Share
					</a> -->
				</div>
			</div>

		</div>
		@endforeach
	</div>


	<div class="col-md-12">
		<div class="row addComment">
			<form action="{{ route('post.addComment', ['postId' => $post->id ]) }}" method="post">
			{!! csrf_field() !!}
				<div class="col-md-10">
					<div class='form-group {{ $errors->has("comment-{$post->id}") ? ' has-error' : ' l' }}'>
						<textarea name="comment-{{ $post->id }}" class="form-control" id="" placeholder="Reply to this status" rows="1"></textarea>
						@if($errors->has("comment-{$post->id}"))
	                        <span class="help-block">{{ $errors->first("comment-{$post->id}") }}</span>
	                    @endif
					</div>
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-green">Reply</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endforeach
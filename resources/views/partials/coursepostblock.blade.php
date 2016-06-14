@foreach($posts as $post)
	<div class="media">
	    <a class="pull-left" href="{{ route('profile.index', ['username' => $post->user->username ? $post->user->username : $post->user->id])}}">
	        <img class="media-object" alt="{{ $post->user->getName() }}" src="{{ $post->user->getAvatarUrl() }}">
	    </a>
	    <div class="media-body">
	        <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $post->user->username ? $post->user->username : $post->user->id])}}">{{ $post->user->getName() }}</a></h4>
	        <p>{{ $post->content }}</p>
	        <ul class="list-inline">
	            <li>{{ $post->created_at->diffForHumans() }}</li>
	            @if($post->user->id !== Auth::user()->id)
		            <li><a href="{{ route('course.post.like', ['postId' => $post->id, 'id' => $course->id] )}}">Like</a></li>
	            @endif
	            <li>{{ $post->likes->count() }} {{ str_plural('like', $post->likes->count())}}</li>
	        </ul>
	 
	 		@foreach($post->comments as $comment)
		        <div class="media">
		            <a class="pull-left" href="{{ route('profile.index', ['username' => $comment->user->username ? $comment->user->username : $comment->user->id])}}">
		                <img class="media-object" alt="{{ $comment->user->getName() }}" src="{{ $comment->user->getAvatarUrl() }}">
		            </a>
		            <div class="media-body">
		                <h5 class="media-heading"><a href="{{ route('profile.index', ['username' => $comment->user->username ? $comment->user->username : $comment->user->id])}}">{{ $comment->user->getName() }}</a></h5>
		                <p>{{ $comment->content }}</p>
		                <ul class="list-inline">
		                    <li>{{ $comment->created_at->diffForHumans() }}</li>
		                    @if($comment->user->id !== Auth::user()->id)
			                    <li><a href="{{ route('course.post.likeComment', ['CommentId' => $comment->id, 'id' => $course->id] )}}">Like</a></li>
			                @endif
		                    <li>{{ $comment->likes->count() }} {{ str_plural('like', $comment->likes->count())}}</li>
		                </ul>
		            </div>
		        </div>
	        @endforeach
	 		
	        <form role="form" action="{{ route('course.post.addComment', ['postId' => $post->id, 'id' => $course->id ]) }}" method="post">
	        	{!! csrf_field() !!}
	            <div class='form-group{{ $errors->has("comment-{$post->id}") ? ' has-error' : ' l' }}'>
	                <textarea name="comment-{{ $post->id }}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
	                @if($errors->has("comment-{$post->id}"))
                        <span class="help-block">{{ $errors->first("comment-{$post->id}") }}</span>
                    @endif
	            </div>
	            <input type="submit" value="Reply" class="btn btn-default btn-sm">
	        </form>
	    </div>
	</div>
@endforeach
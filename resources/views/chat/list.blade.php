<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>Edume | Chat</title>

	<link rel="stylesheet" href="{{ asset('/') }}assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="{{ asset('/') }}assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{ asset('/') }}assets/css/bootstrap.css">
	<link rel="stylesheet" href="{{ asset('/') }}assets/css/neon-core.css">
	<link rel="stylesheet" href="{{ asset('/') }}assets/css/neon-theme.css">
	<link rel="stylesheet" href="{{ asset('/') }}assets/css/neon-forms.css">
	<link rel="stylesheet" href="{{ asset('/') }}assets/css/custom.css">

	<script src="{{ asset('/') }}assets/js/jquery-1.11.0.min.js"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="{{ asset('/') }}assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body">
<div class="col-md-8">
	<a href="#" class="btn btn-default chat-open">Force Open</a>

</div>
<div class="col-md-4" style="height: 100%">
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		
	<div id="chat" class="fixed" data-current-user="{{ Auth::user()->getName() }}" data-order-by-status="1" data-max-chat-history="25">
	
		<div class="chat-inner">
	
	
			<h2 class="chat-header">
				<a href="#" class="chat-close"><i class="entypo-cancel"></i></a>
	
				<i class="entypo-users"></i>
				Chat
				<span class="badge badge-success is-hidden">0</span>
			</h2>
	
	
			<div class="chat-group" id="group-1">
				<strong>Favorites</strong>
	
				<a href="#" id="user-123"><span class="user-status is-offline"></span> <em>Catherine J. Watkins</em></a>
				@foreach($chat_members as $member)
					<a href="#" data-conversation-history="#user-{{ $member->id }}-history" id="user-{{ $member->id }}"><span class="user-status is-offline"></span> <em>{{$member->getName()}}</em></a>
				@endforeach
			</div>
	
		</div>
	
		<!-- conversation template -->
		<div class="chat-conversation">
	
			<div class="conversation-header">
				<a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>
	
				<span class="user-status"></span>
				<span class="display-name"></span>
				<small></small>
			</div>
	
			<ul class="conversation-body">
			</ul>
	
			<div class="chat-textarea">
				<textarea class="form-control autogrow" placeholder="Type your message"></textarea>
			</div>
	
		</div>

		<!-- Chat History for this user -->
		@foreach($chat_members as $member)
					
		<div class="chat-history" id="user-{{ $member->id }}-history">
		@foreach(Auth::user()->getChatWith($member)->messages as $message)
			<li>
				<span class="user">{{ $message->sender->getName() }}</span>
				<p>{{$message->message}}</p>
				<span class="time">{{$message->created_at->toTimeString()}}</span>
			</li>
		@endforeach
			
		</div>

		@endforeach
		<div class="chat-history" id="sample_history">
			<li>
				<span class="user">Art Ramadani</span>
				<p>Are you here?</p>
				<span class="time">09:00</span>
			</li>
			
			<li class="opponent">
				<span class="user">Catherine J. Watkins</span>
				<p>This message is pre-queued.</p>
				<span class="time">09:25</span>
			</li>
			
			<li class="opponent">
				<span class="user">Catherine J. Watkins</span>
				<p>Whohoo!</p>
				<span class="time">09:26</span>
			</li>
			
			<li class="opponent unread">
				<span class="user">Faruk zjermi</span>
				<p>Do you like it?</p>
				<span class="time">09:27</span>
			</li>
		</div>
	
	</div>

	
</div>
</div>
<style type="text/css">
	#chat{
		position: absolute;
	}
	#chat .chat-group{
		margin-top: 10px;
	}
</style>










	<!-- Bottom scripts (common) -->
	<script src="{{ asset('/') }}assets/js/gsap/main-gsap.js"></script>
	<script src="{{ asset('/') }}assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="{{ asset('/') }}assets/js/bootstrap.js"></script>
	<script src="{{ asset('/') }}assets/js/joinable.js"></script>
	<script src="{{ asset('/') }}assets/js/resizeable.js"></script>
	<script src="{{ asset('/') }}assets/js/neon-api.js"></script>


	<!-- Imported scripts on this page -->
	<script src="{{ asset('/') }}assets/js/neon-chat.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="{{ asset('/') }}assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
	<script src="{{ asset('/') }}assets/js/neon-demo.js"></script>

<script type="text/javascript">
</script>
</body>
</html>
<div class="media post">
  <div class="media-left">
    <a href="{{ route('profile.index', ['username' => $user->username ? $user->username : $user->id ]) }}">
      <img class="media-object avatar" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getName() }}">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username ? $user->username : $user->id ]) }}">{{ $user->getName() }}</a></h4>
  </div>
</div>
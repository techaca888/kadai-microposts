<ul class="media-list">
@foreach ($microposts as $micropost)
    <?php $user = $micropost->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <spann class="text-muted">posted at {{ $micropost->created_at }}</span>
            </div>
            <div>
               <p> {!! nl2br(e($micropost->content)) !!}</p>
            </div>
            <div>
              <div class="btn-fav-unfav">
                <?php $login_user = Auth::user() ?>
                @if ($login_user->is_favoriting($micropost->id))
                    {!! Form::open(['route' => ['user.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('unfavorite', ['class' => 'btn btn-success btn-xs btn-unfavorite']) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['user.favorite', $micropost->id], 'method' => 'store']) !!}
                        {!! Form::submit(' favorite ', ['class' => 'btn btn-default btn-xs btn-favorite']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
            <div style="float: left;">
                @if ($login_user->id == $micropost->user_id)
                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs ']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
          </div>
        </div>
    </li>
@endforeach
</ul>
{!! $microposts->render() !!}
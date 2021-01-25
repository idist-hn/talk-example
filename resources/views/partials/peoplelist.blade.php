<div class="people-list" id="people-list">
    <div class="search" style="text-align: center">
        <a href="{{url('/home')}}" style="font-size:16px; text-decoration:none; color: white;"><i class="fa fa-user"></i> {{auth()->user()->name}}</a>
    </div>
    <ul class="list active-users">
        @foreach($threads as $inbox)
            @if(!is_null($inbox->thread))
        <li class="clearfix active-user" data-user="{{$inbox->withUser->id}}">
            <a href="{{route('message.read', ['id'=>$inbox->withUser->id])}}">
            <img src="{{$inbox->withUser->avatar}}" alt="avatar" />
            <div class="about">
                <div class="name">{{$inbox->withUser->name}}</div>
                <div class="status">
                    @if(auth()->user()->id == $inbox->thread->sender->id)
                        <span class="fa fa-reply"></span>
                    @endif
                    <span class="newsest-message">{{substr($inbox->thread->message, 0, 17) }}{{ strlen($inbox->thread->message) > 17 ? "...": "" }}</span>
                </div>
            </div>
            </a>
        </li>
            @endif
        @endforeach

    </ul>
</div>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="profile-user">
                @if ($user->image)
                    <div class="container-avatar">
                        <img 
                            src="{{ route('user.avatar', ['filename' => $user->image]) }}"
                            alt="avatar"
                            class="avatar" 
                        />
                    </div>
                @endif
                <div class="use-info">
                    <h1>{{ '@'.$user->nick }}</h1>
                    <h2>{{ $user->name.' '.$user->surname }}</h2>
                    <p>Se unió hace: {{ \FormatTime::LongTimeFilter($user->created_at) }}</p>
                </div>
            </div>

            <hr />

            @foreach ($user->images as $image)
                @include('includes.image', ['image' => $image])
            @endforeach

        </div>
    </div>
</div>
@endsection
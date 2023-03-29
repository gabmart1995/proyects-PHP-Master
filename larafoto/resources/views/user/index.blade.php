@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Personas</h1>
                <form method="GET" action="{{ route('user.index') }}" id="search-form">
                    <div class="row">
                        <div class="form-group col">
                            <input class="form-control" id="search" />
                        </div>
                        <div class="form-group col">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
                <hr />

                @foreach ($users as $user)
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
                            <h2>{{ '@'.$user->nick }}</h2>
                            <h3>{{ $user->name.' '.$user->surname }}</h3>
                            <p>Se unió hace: {{ \FormatTime::LongTimeFilter($user->created_at) }}</p>
                            <a class="btn btn-success" href="{{ route('user.profile', ['id' => $user->id]) }}">
                                Ver perfil
                            </a>
                        </div>
                    </div>
                @endforeach
                <!-- paginacion -->
                <div class="clearfix"></div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
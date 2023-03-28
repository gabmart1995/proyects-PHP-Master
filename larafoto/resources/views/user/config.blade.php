@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @include('includes.message')

                <div class="panel panel-default">
                    <div class="panel-heading">Configuración de la cuenta</div>

                    <div class="panel-body">
                        <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('user.update') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname" class="col-md-4 control-label">Apellido</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="surname" value="{{ Auth::user()->surname }}" required autofocus>

                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nick') ? ' has-error' : '' }}">
                                <label for="nick" class="col-md-4 control-label">NickName</label>

                                <div class="col-md-6">
                                    <input id="nick" type="text" class="form-control" name="nick" value="{{ Auth::user()->nick }}" required autofocus>

                                    @if ($errors->has('nick'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nick') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            
                            
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">

                                <label for="image_path" class="col-md-4 control-label">Avatar</label>

                                <div class="col-md-6">
                                    @include('includes.avatar')

                                    <input 
                                        id="image_path" 
                                        type="file" 
                                        class="form-control" 
                                        name="image" 
                                        accept="image/*" 
                                    />

                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
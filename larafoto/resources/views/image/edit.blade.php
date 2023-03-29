@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar imagen</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="image_id" value="{{ $image->id }}" />

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} row">
                                <label for="image_path" class="col-md-3 control-label">Imagen</label>
                                <div class="col-md-7">
                                    @if ($image->image_path)
                                        <div class="container-avatar">
                                            <img 
                                                src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                                alt="avatar"
                                                class="avatar" 
                                            />
                                        </div>
                                    @endif
                                    <input id="image_path" type="file" accept="image/*" name="image" class="form-control" />
                                    
                                    @if ($errors->has('image'))
                                        <span class="help-block">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} row">
                                <label for="description" class="col-md-3 control-label">Descripción</label>
                                <div class="col-md-7">
                                    <textarea id="description" name="description" class="form-control">{{ $image->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar Imagen
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
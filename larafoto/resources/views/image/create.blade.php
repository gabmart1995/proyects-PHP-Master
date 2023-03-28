@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Subir nueva imagen</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} row">
                                <label for="image_path" class="col-md-3 control-label">Image</label>
                                <div class="col-md-7">
                                    <input id="image_path" type="file" required accept="image/*" name="image" class="form-control" />
                                    @if ($errors->has('image'))
                                        <span class="help-block">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} row">
                                <label for="description" class="col-md-3 control-label">Descripción</label>
                                <div class="col-md-7">
                                    <textarea id="description" name="description" class="form-control"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        Subir Imagen
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
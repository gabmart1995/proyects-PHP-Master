@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('includes.message')
        
            <div class="panel panel-default pub_image pub_image_detail">
                <div class="panel-heading">
                    @if ($image->user->image)
                        <div class="container-avatar">
                            <img 
                                src="{{ route('user.avatar', ['filename' => $image->user->image]) }}"
                                alt="avatar"
                                class="avatar" 
                            />
                        </div>
                    @endif
                    <div 
                        class="data-user" 
                        style="{{ $image->user->image ? 'margin-left: 15px' : '' }}"
                    >
                        {{ $image->user->name.' '.$image->user->surname }}
                        <span class="nickname">{{ ' | @'.$image->user->nick }}</span>    
                    </div>
                </div>

                <div class="panel-body">
                    <div class="image-container image-detail">
                        <img 
                            src="{{ route('image.file', ['filename' => $image->image_path]) }}" 
                        />
                    </div>
                    <div class="description">
                        <span class="nickname">{{ '@'.$image->user->nick }}</span> 
                        <span class="date">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}</span> <br />
                        <p>{{ $image->description }}</p>
                    </div>
                    <div class="likes">
                        {{-- comprobar si el usuario dio like --}}
                        @php 
                            $userLike = false; 
                        @endphp
                        @foreach ($image->likes as $like)
                            @if ($like->user->id == (\Auth::user())->id)
                                @php 
                                    $userLike = true; 
                                @endphp 
                            @endif
                        @endforeach
                        
                        @if ($userLike)
                            <img src="{{ asset('img/heart-red.gif') }}" data-id="{{ $image->id }}" class="btn-dislike" />
                        @else
                            <img src="{{ asset('img/heart-black.gif') }}" class="btn-like" data-id="{{ $image->id }}" />
                        @endif
                        <span class="number_likes">{{ count($image->likes) }}</span>
                    </div>
                    
                    @if (\Auth::user() && (\Auth::user())->id == $image->user->id)
                        <div class="actions">
                            <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger btn-sm">Borrar</a>
                            <a href="" class="btn btn-primary btn-sm">Editar</a>
                        </div>
                    @endif

                    <div class="clearfix"></div>

                    <div class="comments">
                        <h2>Comentarios {{ count($image->comments) }}</h2>
                        <hr /> 
                        
                        <form action="{{ route('comment.store') }}" method="POST">
                            {{ csrf_field() }}
                            
                            <input type="hidden" name="image_id" value="{{ $image->id }}" />

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <textarea class="form-control" name="content" ></textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block text-red">{{ $errors->first('content') }}</span>
                                @endif
                            </div>
                            <button class="btn btn-success" type="submit">Enviar</button>
                        </form>
                        <hr />
                        <!-- comments -->
                        @foreach ($image->comments as $comment)
                            <div class="comment">
                                <span class="nickname">{{ '@'.$comment->user->nick }}</span> 
                                <span class="date">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }}</span> <br />
                                <p>
                                    {{ $comment->content }}<br />
                                    
                                    <!-- chequea si es el usuario que creo el comentario -->
                                    @if (\Auth::check() && ($comment->user_id == \Auth::user()->id || $comment->image->user_id == \Auth::user()->id))
                                        <a class="btn btn-danger btn-sm"  href="{{ route('comment.delete', ['id' => $comment->id]) }}">
                                            Eliminar
                                        </a>
                                    @endif
                                </p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
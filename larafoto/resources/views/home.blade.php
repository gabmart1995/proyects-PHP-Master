@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('includes.message')

            @foreach ($images as $image)
                <div class="panel panel-default pub_image">
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
                            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                {{ $image->user->name.' '.$image->user->surname }}
                                <span class="nickname">{{ ' | @'.$image->user->nick }}</span>    
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="image-container">
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
                        <div class="comments">
                            <a href="" class="btn btn-warning btn-comments btn-sm">
                                Comentarios ({{ count($image->comments) }})
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- paginacion -->
            <div class="clearfix"></div>
            {{ $images->links() }}
        </div>
    </div>
</div>
@endsection

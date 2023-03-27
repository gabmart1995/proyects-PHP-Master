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
                            {{ $image->user->name.' '.$image->user->surname }}
                            <span class="nickname">{{ ' | @'.$image->user->nick }}</span>    
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="image-container">
                            <img 
                                src="{{ route('image.file', ['filename' => $image->image_path]) }}" 
                            />
                        </div>
                        <div class="likes">

                        </div>
                        <div class="description">
                            <span class="nickname">{{ '@'.$image->user->nick }}</span> <br />
                            <p>{{ $image->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection

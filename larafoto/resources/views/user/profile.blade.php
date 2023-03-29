@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @foreach ($user->images as $image)
                @include('includes.image', ['image' => $image])
            @endforeach
            
        </div>
    </div>
</div>
@endsection
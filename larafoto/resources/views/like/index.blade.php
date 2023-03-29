@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Mis imagenes favoritas</h1>
            <hr />

            @foreach ($likes as $like)
                @include('includes.image', ['image' => $like->image])
            @endforeach

            <!-- paginacion -->
            <div class="clearfix"></div>
            {{ $likes->links() }}
        </div>
    </div>
</div>
@endsection
 
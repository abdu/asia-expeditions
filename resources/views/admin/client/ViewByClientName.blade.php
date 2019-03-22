@extends("layouts.backend")
@section('title')
    {{config('app.name')}}
@endsection
@section('content')
<div id="wrapper">
    @include('admin.include.menu')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header border"><strong style="text-transform: capitalize;">{{$client->name}}</strong> Travel Documents </h1>
            </div>
        </div>
        <div class="row">
            @include('admin.include.clientdocument')            
        </div>       
    </div>
</div>
@endsection


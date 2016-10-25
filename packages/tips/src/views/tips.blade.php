@extends('layouts.default')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Tips
            <a class="btn btn-success pull-right" href="{{ route('topics.recommend') }}"><i class="glyphicon glyphicon-plus"></i> Tips</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(count($tips))
                @foreach($tips as $k => $tip)
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{{ $k }}</strong> {{$tip}}
                    </div>
                @endforeach
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif
        </div>
    </div>
@endsection

@extends('layouts.app') 
@section('title', 'Editing existing Cruize')
@section('content')


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif {!! Form::model($cruize, ['method' => 'PATCH','route' => ['cruize.update', $cruize->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong> {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control'))
            !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Ship Name:</strong> {!! Form::text('ship_name', null, array('placeholder' => 'Ship Name','class' => 'form-control'))
            !!}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>From:</strong> {!! Form::text('from', null, array('class' => 'datepicker form-control', 'placeholder' =>
            'From')) !!}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>To:</strong> {!! Form::text('to', null, array('class' => 'datepicker form-control','placeholder' => 'To'))
            !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!} @endsection @section('script') @parent
<script>
    $(function () {
        $(".datepicker").datepicker();
    });
</script>
@stop
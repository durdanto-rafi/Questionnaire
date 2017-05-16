@extends('layouts.app')
@section('title', 'Cruizes')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="400px">Action</th>
        </tr>
        @foreach ($cruizes as $key => $cruize)
            <tr>
                <td>{{ $cruize->id }}</td>
                <td>{{ $cruize->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="#">AC</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('cruize.edit',$cruize->id) }}">Edit</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('excersion.add',$cruize->id) }}">Add Exc</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('guest.add', $cruize->id) }}">Add Guest</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['cruize.destroy', $cruize->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                {!! $cruizes->render() !!}

            </div>
            <div class="pull-right span7 text-center">
                <a class="btn btn-success" href="#"> Search</a>
                <a class="btn btn-primary" href="{{ route('cruize.create') }}"> Create</a>
            </div>
        </div>
    </div>
    <!-- pagination -->


@endsection

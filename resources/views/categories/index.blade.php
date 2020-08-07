@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
            <a href="{{route('categories.create')}}" class="btn btn-danger card-header-pills float-right">Create</a>
            <h3>All Categories</h3>
        </div>
        <div class="card-body">
            @if(session()->has('succecc'))
                <div class="alert alert-success">{{session()->get('succecc')}}</div>
            @endif
            <table class="table">
                        <tr class="table-success">
                            <td>Name</td>
                            <td>Delete</td>
                            <td>Update</td>
                        </tr>

                @foreach($res as $result)
                    <tr>
                        <td>{{$result->name}}</td>
                        <td>
                            <form method="post" action="{{route('categories.destroy',$result->id)}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Delete</button>
                            </form>

                        </td>
                        <td><a class="btn btn-success" href="{{route('categories.edit',$result->id)}}">Update</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

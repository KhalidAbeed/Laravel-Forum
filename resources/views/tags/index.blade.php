@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
            @endif
            <a href="{{route('tags.create')}}" class="btn btn-danger card-header-pills float-right">Create</a>
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

                @foreach($tag as $result)
                    <tr>
                        <td>{{$result->name}}
                        <span class="badge badge-danger">{{$result->posts()->count()}}</span>
                        </td>
                        <td>
                            <form method="post" action="{{route('tags.destroy',$result->id)}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Delete</button>
                            </form>

                        </td>
                        <td><a class="btn btn-success" href="{{route('tags.edit',$result->id)}}">Update</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

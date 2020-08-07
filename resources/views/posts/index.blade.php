@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">

            <a href="{{route('posts.create')}}" class="btn btn-danger card-header-pills float-right">Create</a>
            <h3>All Posts</h3>
        </div>
        <div class="card-body">
            @if(session()->has('succecc'))
                <div class="alert alert-success">{{session()->get('succecc')}}</div>
            @endif

            @if($post->count()>0)
                    <table class="table">
                        <tr class="table-success">
                            <td>Image</td>
                            <td>Title</td>
                            <td>Descriptione</td>
                            <td>Content</td>
                            <td>Update</td>
                            <td>Delete</td>

                        </tr>

                        @foreach($post as $result)
                            <tr>
                                <td><img style="height: 50px;width: 100px" src="{{asset('storage/'.$result->image)}}"></td>
                                <td>{{$result->title}}</td>
                                <td>{{$result->description}}</td>
                                <td>{{$result->content}}</td>

                                <td>
                                    <form method="post" action="{{route('posts.destroy',$result->id)}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">
                                            {{$result->trashed()? 'Delete' :'Trashed'}}
                                        </button>
                                    </form>

                                </td>
                                @if(!$result->trashed())
                                    <td><a class="btn btn-success" href="{{route('posts.edit',$result->id)}}">
                                            Update</a></td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                @else
                <div class="card">
                    <h1>not yet</h1>
                </div>

            @endif
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3>Add post</h3>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


        <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" value="{{old('title')}}" name="title" class="form-control" placeholder="add title">
            </div>
            <div class="form-group">
                <input type="text" value="{{old('description')}}" name="description" class="form-control" placeholder="add description">
            </div>
            <div class="form-group">
                <textarea type="text" value="{{old('content')}}" rows="3" name="content" class="form-control" placeholder="add content"></textarea>
            </div>
            <div class="form-group">
                <input type="file" value="{{old('image')}}" name="image" class="form-control" placeholder="add image">
            </div>

            <select name="category_id" class="custom-select custom-select-sm form-group">
                <option selected> select item</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
            </select>
           @if($tags->count()>0)
            <select name="tags[]" class="custom-select  form-group" multiple>
                <option selected> select item</option>
                @foreach($tags as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @endif


            <input type="submit" class="btn btn-danger">
        </form>
        </div>
    </div>
@endsection

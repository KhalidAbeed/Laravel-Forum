@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3>Add tags</h3>
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
            <form method="post" action="{{route('tags.store')}}">
                @csrf

                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="add product">
                </div>
                <input type="submit" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection

@extends('base_layout._layout')
@section('body')


    <form method="post" action="{{route('category.update',['id' => $category->id])}}" enctype="multipart/form-data">

        {{method_field('PUT')}}
        {{csrf_field()}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        <div class="form-group " style="text-align: center">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                     style="width: 200px; height: 150px;">

                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> Select image </span>
                        <span class="fileinput-exists"> Change </span>
                        <input type="file" name="image" value="{{$category->image}}">
                        <span class="error">{{$errors->first('image')}}</span>
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                        Remove </a>


                </div>
            </div>
        </div>


        <div class="form-group">
            <lable for="name">Name:</lable>
            <input id="name" type="text" name="name" class="form-control" placeholder="name" value="{{$category->name}}">
            <span class="error">{{$errors->first('name')}}</span>
        </div>




        <div class="form-action">
            <input type="submit" class="btn btn-primary" value="update">
            <a href="{{route('category.index')}}" class="btn btn-default">Cancel</a>
        </div>


    </form>



@endsection

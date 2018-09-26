@extends('base_layout._layout')
@section('body')

    @if('success')
        <span>Done</span>
    @endif
<div class="container">
    <h1 class="text-center">Add Category</h1>


    <form action="{{route('category.create')}}" method="post" enctype="multipart/form-data">

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
                        <input type="file" name="image">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                        Remove </a>
                    <span class="error">{{$errors->first('image')}}</span>

                </div>
            </div>
        </div>


        <div class="form-group" >
            <lable for="name">Category Title:</lable>
            <input id="name" type="text" name="name" class="form-control" placeholder="name" width='80%' >
            <span  style="color:darkred;">{{$errors->first('name')}}</span>
        </div>



        <div class="form-action">
            <input type="submit" class="btn btn-primary" value="Store">
            <input type="reset" class="btn btn-default" value="cancel">
        </div>
    </form>

</div>
<!--End Of Form Section-->
@endsection
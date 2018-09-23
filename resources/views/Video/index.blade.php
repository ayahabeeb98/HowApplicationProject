@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-video-camera"></i>
                <a href="{{route('video.index')}}">Videos</a>
            </li>

        </ul>
    </div>
@endsection
@section('style')
    <style>
        .fa-video-camera,.fa-search{
            margin-right: 10px;
        }
        td,th{
            text-align: center;
        }
    </style>

@endsection
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel panel-heading"><i class="fa fa-search"></i>Search</div>
                <div class="panel panel-body">
                    <form action="{{route('video.index')}}" method="get">
                        <div class=" form-group col-sm-4">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{app('request')->get('name')}}">
                        </div>
                        <div class=" form-group col-sm-4">
                            <label for="url">Url</label>
                            <input type="text" name="url" value="{{app('request')->get('url')}}">
                        </div>
                        <div class=" form-group col-sm-4">
                            <label for="category_id">Category_id</label>
                            <input type="text" name="category_id" value="{{app('request')->get('category_id')}}">
                        </div>
                        <div class=" form-group col-md-12">
                            <input type="submit" value="Search" class="btn btn-primary">
                            <a class=" btn btn-default" href="{{route('video.index')}}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading"><i class="fa fa-video-camera"></i>Videos</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>video_youtube_id</th>
                            <th>Url</th>
                            <th>Category_id</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $video)
                            <tr>
                                <td>{{$video->name}}</td>
                                <td>{{$video->video_id}}</td>
                                <td>{{$video->url}}</td>
                                <td>{{$video->category_id}}</td>
                                <td>
                                    <a class="btn btn-danger delete-video"
                                       data-value="{{$video->id}}"
                                       data-name="{{$video->name}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a  class="btn btn-primary"  href="{{route('video.edit',['id' => $video->id])}}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{$videos->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.delete-video').click(function () {
            var name = $(this).data('name')
            var id = $(this).data('value')
            swal({
                    title: "Are you sure?'",
                    text: "Do you want to delete book'" + name + " ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "cancel",
                    closeOnConfirm: false
                },
                function () {
                    window.location = '{{route('video.destroy')}}/' + id
                });
        })
    </script>
@endsection
@extends ('base_layout._layout')
@section('breadcrumb')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-video-camera"></i>
            <a href="{{route('category.index')}}">Categories</a>
        </li>

    </ul>
</div>
@endsection
@section('body')
    <!-- ......................Start Search............................... -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><i class="fa fa-search"></i> Search</div>
                <div class="panel-body">
                    <form method="get" action={{route('category.index')}}>
                        <div class="form-group col-md-4">
                            <lable for="name">name</lable>
                            <input id="name" type="text" name="name" class="form-control" placeholder="name" value="{{app('request')->get('name')}}">
                        </div>
                        <br>
                        <input class="btn btn-primary" type="submit" name="submit">
                        <a class="btn btn-default" href="{{route('category.index')}}">Cancel</a>
                    </form>
                </div>
        </div>
    </div>
    <!-- ...................... End Search............................... -->
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><i class="fa fa-list-ul"></i> Categories</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content text-center">
                        <thead >
                        <tr>
                            <th class="text-center">name</th>
                            <th class="text-center">lang</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($category as $cat)
                            <tr>

                                <td>{{$cat->name}}</td>


                                <td style="text-align: center">
                                    <a title="Options"  class="btn btn-danger"  onclick="return confirm('Are you sure?')" href="{{route('category.destroy',['id' => $cat->id])}}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <a class="btn btn-primary"  href="{{route('category.edit',['id' => $cat->id])}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--<!-- ......................BOOK_PAGINATION............................... -->--}}
    <div class="col-md-12 text-right">
        {{$category->links()}}
    </div>
    {{--<!-- ......................BOOK_PAGINATION............................... -->--}}


</div>

@endsection

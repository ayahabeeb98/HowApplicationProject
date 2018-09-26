<html>
<head>
    <title>Show Books</title>
    @extends ('base_layout._layout')
</head>

<body>
@section('body')


    <!-- ......................Start Search............................... -->

    <form method="get" action={{route('category.index')}}>
        <div class="form-group col-md-4">
            <lable for="name">name</lable>
            <input id="name" type="text" name="name" class="form-control" placeholder="name" value="{{app('request')->get('name')}}">
        </div>


        <br>
        <input class="btn btn-primary" type="submit" name="submit">
        <a class="btn btn-default" href="{{route('category.index')}}">Cancel</a>
    </form>
    <!-- ...................... End Search............................... -->



    <table border="1px" class="table table-bordered table-striped table-condensed flip-content text-center">
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
                    <a title="Options"  onclick="return confirm('Are you sure?')" href="{{route('category.destroy',['id' => $cat->id])}}">
                        <i class="fa fa-trash fa-1x"></i>
                    </a>

                    <a class="btn btn-primary"  href="{{route('category.edit',['id' => $cat->id])}}">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>


            </tr>
        @endforeach
        </tbody>
    </table>

    {{--<!-- ......................BOOK_PAGINATION............................... -->--}}
    <div class="col-md-12 text-right">
        {{$category->links()}}
    </div>
    {{--<!-- ......................BOOK_PAGINATION............................... -->--}}




@endsection

</body>
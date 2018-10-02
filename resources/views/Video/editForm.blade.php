<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Edit Video</title>
</head>
<body>
<form action="{{route('video.update',['id'=>$video->id])}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group "style="text-align: center">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput"  style="width: 200px; height: 150px;">
                    <img src="{{asset($video->getImage())}}">
                </div>
                <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists"> Change</span>
                                                                <input type="file" name="video_image"> </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                </div>
            </div>
            <span class="error col-md-12">{{$errors->first('video_image')}}</span>
        </div>
        <div class="form-group">
            <label for="name">Name</label><span class="danger">*</span>
            <input type="text" class="form-control" name="name" value="{{$video->name}}">
            <span class="error col-md-12">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group">
            <label for="url">Url</label><span class="danger">*</span>
            <input type="text" class="form-control" name="url" value="{{$video->url}}">
            <span class="error col-md-12">{{$errors->first('url')}}</span>
        </div>
        <div class="form-group">
            <label for="category_id">Category_id</label><span class="danger">*</span>
            <input type="text" class="form-control" name="category_id" value="{{$video->category_id}}">
            <span class="error col-md-12">{{$errors->first('category_id')}}</span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="submit" class="btn btn-default">cancel</button>
    </div>
</form>
</body>
</html>

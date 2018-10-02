@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('video.index')}}">Videos</a>
                <i  class="fa fa-angle-double-right"></i>
            </li>
            <li>
                <span>Edit</span>
            </li>
        </ul>
    </div>
@endsection
@section('body')
    @includeIf('Video.editForm')
@endsection

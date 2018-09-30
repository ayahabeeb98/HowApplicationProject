@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-user"></i>
                <a href="{{route('admin.profile',['id' => \Illuminate\Support\Facades\Auth::user()->id])}}">Admin</a>
            </li>
        </ul>
    </div>
@endsection
@section('body')
    <h1 class="page-title"> {{$admin->userName}} | Account
        <small>Admin account page</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet bordered">
                    <!-- SIDEBAR USERPIC -->
                    <div class="">
                        <img src="{{$admin->image}}" class="img-responsive  " alt=""> </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{$admin->userName}} </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->

                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->


                    <div class="profile-usermenu ">
                        <ul class="nav">
                            <li>
                                <a href="">
                                    <i class="icon-home"></i> Overview </a>
                            </li>

                            {{--<li class="active">--}}
                            {{--<a href="page_user_profile_1_account.html">--}}
                            {{--<i class="fa fa-plus"></i> requests </a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>

                <!-- END PORTLET MAIN -->
                <!-- PORTLET MAIN -->
                <div class="portlet light bordered">
                    <!-- STAT | the number of user request -->
                    <div class="row list-separated profile-stat ">
                        <div class="col-md-12">
                            <div class="uppercase profile-stat-title"> </div>
                            <div class="uppercase profile-stat-text"> Requests </div>
                        </div>
                    </div>
                    <!-- END STAT -->
                    <div>
                        <h4 class="profile-desc-title">About {{$admin->userName}}</h4>
                        <br>
                        <div class=" profile-desc-link">
                            <i class="fa fa-at"></i>
                            <a href="">{{$admin->email}}</a>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Accounts</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Edit Personal Info</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form action="{{route('admin.update',['id' => $admin->id])}}" method="POST" >
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label">User Name</label>
                                                <input type="text" value="{{$admin->userName}}" name="userName" class="form-control" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="text" value="{{$admin->email}}" name="email" class="form-control" /> </div>
                                            <div class="margiv-top-10">
                                                <input type="submit" value="save changes" name="submit" class="btn green">
                                                <a href="{{route('admin.profile',['id' => \Illuminate\Support\Facades\Auth::user()->id])}}" class="btn default"> Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE AVATAR TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
@endsection

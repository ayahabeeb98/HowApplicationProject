@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-user"></i>
                <a href="{{route('user.index')}}">Users</a>
            </li>

        </ul>
    </div>
@endsection
@section('style')
    <style>
        th{
            padding: 15px !important;
        }
    </style>
@endsection
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Search</h3>
            </div>
            <div class="panel-body">
                <form method="GET" action="{{route('user.index')}}">
                    <div class="col-md-12">
                        <div class="form-group col-md-3">
                            <label for="username">User Name</label>
                            <input type="text" name="UserName" id="username" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="visa">visa card</label>
                            <input type="text" name="visaCard" id="visa" class="form-control">
                        </div>
                        <div class="form-group text-left col-sm-12">
                            <input type="submit" name="search" value="search" class="btn btn-primary">
                            <a href="{{route('user.index')}}" value="cancle" class="btn btn-default">Cancle</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h1 class="panel-title"><i class="fa fa-user"></i> Users</h1>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Name</th>
                            <th>email</th>
                            <th>visa card</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->FirstName}}</td>
                                <td>{{$user->LastName}}</td>
                                <td>{{$user->UserName}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->visaCard}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-12">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

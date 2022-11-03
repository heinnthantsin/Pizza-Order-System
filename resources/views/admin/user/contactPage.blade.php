@extends('admin.layouts.master')


@section('title','Contact Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="overview-wrap">
                    <a href=" {{ route('user#contactPage') }} ">
                        <h1 class="title-1 fs-1">Messages From User</h1>
                    </a>
                </div>
                <div class="table-responsive table-responsive-data2 mt-5">
                    <table class="table table-data2 table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="col-2">Name</th>
                                <th>Email</th>
                                <th>Messages</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($messages as $m)
                                <tr>
                                    <td></td>
                                    <td>{{$m->name}}</td>
                                    <td>{{$m->email}}</td>
                                    <td>{{$m->message}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

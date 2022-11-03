@extends('admin.layouts.master')


@section('title','Admin List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content" style="width:1400px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <a href=" {{ route('admin#list') }} ">
                                <h1 class="title-1 fs-1">Admin List</h1>
                            </a>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href=" {{ route('category#createPage') }} ">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                <div class="row">
                    <span class="fs-3 my-3 text-muted">Total : <span class="text-dark">{{ $admins->total() }}</span> <span>

                </div>

                <div class="row">
                    <div class="col-3">
                        <h3>Search Key : <span class="text-danger">{{ request('key') }}</span></h3>
                        <small>Role - {{ Auth::user()->role }} </small>
                    </div>

                    <div class="col-3 offset-6">
                        <form action=" {{ route('admin#list') }} " method="get">
                            @csrf
                            <div class="input-group shadow-sm">
                                <input type="text" name="key" class="form-control" placeholder="Search..."
                                    value=" {{ request('key') }} ">
                                <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if(session('deleteSuccess'))
                <div class=" mt-3">
                    <div class="alert alert-warning alert-dismissible fade show">
                        <i class="fa solid fa-check"></i> {{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
                @endif

                @if(count($admins) >= 1)
                <div class="table-responsive table-responsive-data2 table-striped mt-4">
                    <table class="table table-data2">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Created Date</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr class="tr-shadow">
                                <input type="hidden" value="{{$admin->id}}" class="userId">
                                <td></td>
                                <td>
                                @if ($admin->image == null)

                                    @if ($admin->gender == 'female')
                                    <img src="{{ asset('image/default_profile2.jpg') }}" class="img-thumbnail" alt="">
                                    @else
                                    <img src="{{ asset('image/default_profile.jpg') }}" class="img-thumbnail" alt="">
                                    @endif

                                @else
                                    <img src="{{ asset('storage/'.$admin->image) }}" class="img-thumbnail" alt="">
                                @endif
                                </td>
                                <td class="fs-6">{{ $admin->name }}</td>
                                <td class="fs-6">{{ $admin->email }}</td>
                                <td class="fs-6">{{ $admin->phone }}</td>
                                <td class="fs-6">{{ $admin->address }}</td>
                                <td class="fs-6">{{ $admin->gender }}</td>
                                <td class="fs-6">{{ $admin->created_at->format('j/M/Y') }}</td>
                                <td class="colspan-2">
                                    <select class="p-2 fs-6 border-0 changeRole">
                                        <option value="admin" @if ($admin->role == "admin") selected @endif>Admin</option>
                                        <option value="user" @if ($admin->role == "user") selected @endif>User</option>
                                    </select>
                                </td>
                                <td>
                                    @if (Auth::user()->id !== $admin->id)
                                        <div class="table-data-feature">
                                            <a href="{{route('admin#changeRolePage',$admin->id)}}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                    <i class="zmdi zmdi-account fs-4"></i>
                                                </button>
                                            </a>

                                            <a href="{{route('admin#delete',$admin->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete fs-4"></i>
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- pagination --}}
                    <div class="mt-3">
                        {{ $admins->links() }}

                        {{-- {{ $admins->appends(request()->query()->links()) }} --}}
                    </div>

                </div>
                @else
                <div class="alert">
                   <div style="height: 500px; width:auto; display:flex;justify-content:center;align-items:center;">
                        <div class="text-danger fs-1">. . . There is no admin like you searched . . .</div>
                   </div>
                </div>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function () {
            $('.changeRole').click(function (e) {
                e.preventDefault();
                // console.log($(this).val());
                $currentRole = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();
                // console.log($userId);
                $data = {'userId':$userId,'currentRole':$currentRole}
                $.ajax({
                    type: "get",
                    url: "/ajax/change/role",
                    data: $data,
                    dataType: "json",
                });
                location.reload();
            });
           });
    </script>
@endsection

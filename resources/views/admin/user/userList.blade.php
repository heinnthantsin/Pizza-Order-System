@extends('admin.layouts.master')


@section('title','User List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="overview-wrap">
                    <a href=" {{ route('user#listPage') }} ">
                        <h1 class="title-1 fs-1">User List</h1>
                    </a>
                </div>
                <div class="row my-3">
                    <div class="col-3">
                        <span class="fs-4 d-block text-dark"> Total : {{  count($users) }} </span>
                        <span>Search Key : <span class="text-danger">{{ request('key') }}</span></span>
                    </div>

                    <div class="col-3 offset-6">
                        <form action=" {{ route('user#listPage') }} " method="get">
                            @csrf
                            <div class="input-group shadow-sm">
                                <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if(session('deleteSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show">
                        <i class="fa-solid fa-alert text-danger"></i>{{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="col-1">
                                            @if ($user->image == null)
                                                @if ($user->gender == 'female')
                                                    <img src="{{ asset('image/default_profile2.jpg') }}" alt="">
                                                @else
                                                    <img src="{{ asset('image/default_profile.jpg') }}" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$user->image) }}" alt="">
                                            @endif
                                        </td>
                                        <input type="hidden" value="{{ $user->id }}" class="userId">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>
                                            <select class="form-control changeStatus">
                                                <option value="user" @if ($user->role == 'user') selected  @endif>User</option>
                                                <option value="admin" @if ($user->role == 'admin') selected  @endif>admin</option>
                                            </select>
                                        </td>
                                        <td><a href="{{route('user#deleteUser',$user->id)}}"><i class="fa-solid fa-trash text-danger"></i></a></td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="">
                    {{ $users->links() }}
                </div>
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
            $('.changeStatus').change(function (e) {
                e.preventDefault();
                $currentStatus = $('.changeStatus').val();
                // console.log($currentStatus);
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();
                // console.log($userId);
                $data = {'userId' : $userId ,'role': $currentStatus};
                $.ajax({
                    type: "get",
                    url: "/user/change/role",
                    data: $data,
                    dataType: "json",
                });
                location.reload();
            });

        });
</script>
@endsection

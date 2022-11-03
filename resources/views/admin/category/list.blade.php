@extends('admin.layouts.master')


@section('title','Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content ms-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <a href=" {{ route('categroy#listPage') }} ">
                                <h1 class="title-1 fs-1">Category List</h1>
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
                    <span class="fs-3 my-3 text-muted">Total : <span class="text-success">{{ $categories->total() }}</span></span>
                </div>

                    <div class="row">
                        <div class="col-3">
                            <h3>Search Key : <span class="text-danger">{{ request('key') }}</span></h3>
                            <small>Role - {{ Auth::user()->role }} </small>
                        </div>

                        <div class="col-3 offset-6">
                            <form action=" {{ route('categroy#listPage') }} " method="get">
                                @csrf
                                <div class="input-group shadow-sm">
                                    <input type="text" name="key" class="form-control" placeholder="Search..." value=" {{ request('key') }} ">
                                    <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- alert message --}}
                    @if(session('createSuccess'))
                    <div class="mt-3">
                        <div class="alert alert-info alert-dismissible fade show">
                            <i class="fa solid fa-check"></i> {{ session('createSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                    @endif

                    @if(session('deleteSuccess'))
                    <div class=" mt-3">
                        <div class="alert alert-warning alert-dismissible fade show">
                            <i class="fa solid fa-check"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                    @endif

                    @if(session('updateSuccess'))
                    <div class=" mt-3">
                        <div class="alert alert-warning alert-dismissible fade show">
                            <i class="fa solid fa-check"></i> {{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                    @endif

                <div class="table-responsive table-responsive-data2">
                    @if (count($categories) != 0)
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="tr-shadow">
                                <td> {{ $category->id }} </td>
                                <td> {{ $category->name }} </td>
                                <td> {{ $category->created_at->format('j/F/Y') }} </td>
                                <td>
                                    <div class="table-data-feature mx-3">
                                        {{-- <button class="item mx-3" data-toggle="tooltip" data-placement="top"
                                            title="View">
                                            <i class="fa solid fa-eye"></i>
                                        </button> --}}
                                        <a href=" {{ route('category#editPage',$category->id) }} ">
                                            <button class="item mx-3" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href=" {{ route('category#delete',$category->id) }} ">
                                            <button class="item mx-3" data-toggle="tooltip" data-placement="top"
                                                title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- pagination --}}
                    <div class="mt-3">
                        {{ $categories->links() }}

                        {{-- {{ $categories->appends(request()->query()->links()) }} --}}
                    </div>

                </div>
                <!-- END DATA TABLE -->
                @else
                <div class="mt-5 fs-1 text-center text-muted"> *** There is no category here ***</div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

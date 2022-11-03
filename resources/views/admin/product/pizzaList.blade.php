@extends('admin.layouts.master')


@section('title','Pizza List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <a href=" {{ route('product#listPage') }} ">
                                <h1 class="title-1 fs-1">Product List</h1>
                            </a>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href=" {{ route('product#createPage') }} ">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>



                <div class="row">
                    <div class="col-3">
                        <h3>Search Key : <span class="text-danger">{{ request('key') }}</span></h3>
                        <small>Role - {{ Auth::user()->role }} </small>
                        <h4> Total : {{  $pizzas->total() }} </h4>
                    </div>

                    <div class="col-3 offset-6">
                        <form action=" {{ route('product#listPage') }} " method="get">
                            @csrf
                            <div class="input-group shadow-sm">
                                <input type="text" name="key" class="form-control" placeholder="Search..."
                                    value=" {{ request('key') }} ">
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

        @if (count($pizzas) != 0)
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th class="col-2">Category</th>
                            <th>Price</th>
                            <th class="col-2">Waiting Time(min)</th>
                            <th class="col-2">View Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizzas as $p)
                        <tr class="tr-shadow">
                            <td class="col-2"><img src=" {{ asset('storage/'.$p->image) }} " class="img-thumbnail" /></td>
                            <td> {{ $p->name }} </td>
                            <td class="text-center"> {{ $p->category_name }} </td>
                            <td> {{ $p->price }} </td>
                            <td class="text-center"> {{ $p->waiting_time }} </td>
                            <td class="text-center"> <i class="fa-solid fa-eye"></i> {{ $p->view_count }} </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('product#detailPage',$p->id)}}">
                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa solid fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('product#editPage',$p->id)}}">
                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>

                                    <a href="{{route('product#delete',$p->id)}}">
                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Delete">
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
                    {{ $pizzas->links() }}

                    {{-- {{ $pizzas->appends(request()->query()->links()) }} --}}
                </div>

            </div>
        @else
        <div class="mt-5 fs-1 text-center text-muted"> *** There is no Pizza here ***</div>
        @endif
        <!-- END DATA TABLE -->

    </div>
</div>
</div>
</div>
<!-- END MAIN CONTENT-->
@endsection

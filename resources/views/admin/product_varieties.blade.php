@section('title', 'Marmalade Grove | Admin - Product Varieties')

@include('layouts.header')

@include('navbar')

<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    @include('sidebar')
    </nav>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- <h2 class="font-weight-bolder mb-5">Fruits</h2> -->
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-11 mb-3">
                                    <h4 class="card-title">Product Varieties</h4>
                                </div>

                                <div class="col mb-3">
                                    <a href="{{ url('admin/add_product_variety') }}" class="btn btn-sm btn-primary">Add</a>
                                </div>

                            </div>

                            <div class="table-responsive mt-2" id="tbl">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                        @if (count($varieties) > 0)
                                            @foreach ($varieties as $variety)
                                                @php $id = $variety['product_id']; @endphp
                                        <tr>
                                            <td>{{ $variety['product_name'] }}</td>
                                            <td>
                                                <a href="{{ url('admin/edit_product_variety') }}/{{ $id }}" type="button" class="btn btn-sm btn-success btn-icon-text">
                                                    Edit
                                                    <i class="ti-file btn-icon-append"></i>
                                                </a>

                                                <a href="{{ url('admin/delete_product_variety/') }}/{{ $id }}" type="button" class="btn btn-sm btn-danger btn-icon-text" onclick="return confirm('Do you want to delete this variety ?')">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @else
                                        <tr>
                                            <td colspan="100" class="text-center text-danger"><b>No Data Found</b></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')

        </body>

        </html>
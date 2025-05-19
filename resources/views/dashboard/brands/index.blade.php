@extends('layouts.master')
@section('title')
    Devices | X Net System - CDD V1.0
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">


@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">General</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Devices</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">

        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('Error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    @can('Add')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal"
                            href="#modaldemo8"> Add Devices </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th> Operations </th>
                                    <th> Brands </th>
                                    <th> Model</th>
                                    <th> Serial Number </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 0; ?>
                                {{-- @foreach ($brands as $brand)


                                    <td>{{ $i }}</td>
                                    <td>
                                        @can('Edit')
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $brand->id }}" data-name ="{{ $brand->deviceBrand->name }}"
                                                data-model="{{ $brand->model }}"
                                                data-serial_number="{{ $brand->serial_number }}" data-toggle="modal"
                                                href="#exampleModal2" title="Upadte"><i class="las la-pen"></i></a>
                                        @endcan

                                        @can('Delete')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $brand->id }}" data-serial_number="{{ $brand->serial_number }}"
                                                data-toggle="modal" href="#modaldemo9" title="Delete"><i
                                                    class="las la-trash"></i></a>
                                        @endcan
                                    </td>

                                    {{-- <td>{{ $brand->deviceBrand->name }}</td>
                                    <td> {{ optional($brand->deviceBrand)->name ?? '— غير محدد' }}</td>

                                    <td>{{ $brand->model }}</td>
                                    <td>{{ $brand->serial_number }}</td>



                                    </tr>
                                @endforeach --}}
                                @foreach ($brands as $brand)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            @can('Edit')
                                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    data-id="{{ $brand->id }}"  data-devicebrand_id="{{ $brand->devicebrand_id }}"
                                                    data-model="{{ $brand->model }}"
                                                    data-serial_number="{{ $brand->serial_number }}" data-toggle="modal"
                                                    href="#exampleModal2" title="Update"><i class="las la-pen"></i></a>
                                            @endcan

                                            @can('Delete')
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-id="{{ $brand->id }}"
                                                     data-devicebrand_id="{{ $brand->devicebrand_id }}"
                                                    data-serial_number="{{ $brand->serial_number }}" data-toggle="modal"
                                                    href="#modaldemo9" title="Delete"><i class="las la-trash"></i></a>
                                            @endcan
                                        </td>
                                        <td>{{ optional($brand->deviceBrand)->name ?? '— غير محدد' }}</td>
                                        <td>{{ $brand->model }}</td>
                                        <td>{{ $brand->serial_number }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> Add Device </h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brands.store') }}" method="post">
                        @csrf

                        <select name="devicebrand_id" id="devicebrand_id" class="form-control" required>
                            <label for="devicebrand_id" class="col-form-label">Brands</label>
                            <option value="" selected disabled>-- Select the Brand --</option>
                            @foreach ($deviceBrands as $db)
                                <option value="{{ $db->id }}"
                                    {{ old('devicebrand_id') == $db->id ? 'selected' : '' }}>
                                    {{ $db->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-group mt-4">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" name="model"
                                placeholder="Enter model name" required>
                        </div>

                        <div class="form-group mt-4">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" pattern="[A-Za-z0-9\-]+" class="form-control" id="serial_number"
                                name="serial_number" placeholder="Enter serial number" required>
                            <small class="form-text text-muted">Only letters, numbers, and hyphens allowed.</small>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary">Add</button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->

        <!-- /row -->
    </div>


    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="brands/update" method="post" autocomplete="off">
                        {{ method_field('put') }}
                        {{ csrf_field() }}



                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="devicebrand_id" class="col-form-label">Brandse</label>
                            <select name="devicebrand_id" id="devicebrand_id" class="form-control" required>
                                <option value="" selected disabled>-- Select the Brand --</option>
                                @foreach ($deviceBrands as $db)
                                    <option value="{{ $db->id }}"
                                        {{ old('devicebrand_id') == $db->id ? 'selected' : '' }}>
                                        {{ $db->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group mt-4">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" name="model"
                                placeholder="Enter model name" required>
                        </div>

                        <div class="form-group mt-4">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" pattern="[A-Za-z0-9\-]+" class="form-control" id="serial_number"
                                name="serial_number" placeholder="Enter serial number" required>
                            <small class="form-text text-muted">Only letters, numbers, and hyphens allowed.</small>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Confirm</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                {{-- <form action="brands/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p> Are you sure about the deletion process?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </div>
            </div>
            </form> --}}
                <form action="{{ route('brands.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>Are you sure about the deletion process?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="serial_number" id="serial_number" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </div>
                </form>

            </div>
        </div>



        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var model = button.data('model')
            var serial_number = button.data('serial_number')
             var devicebrand_id = button.data('devicebrand_id');
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #model').val(model);
            modal.find('.modal-body #serial_number').val(serial_number);
            modal.find('#devicebrand_id').val(devicebrand_id);
        })
    </script>

    <script>
        // $('#modaldemo9').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget)
        //     var id = button.data('id')
        //     var serial_number = button.data('serial_number')
        //     // var email = button.data('email')
        //     // var phone = button.data('phone')
        //     var modal = $(this)
        //     modal.find('.modal-body #id').val(id);
        //     modal.find('.modal-body #serial_number').val(serial_number);
        //     // modal.find('.modal-body #email').val(email);
        //     // modal.find('.modal-body #phone').val(phone);
        // })
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var serial_number = button.data('serial_number')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #serial_number').val(serial_number);
        })
    </script>
@endsection

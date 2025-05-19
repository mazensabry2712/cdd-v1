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

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    @php
        $alerts = [
            'Add' => 'success',
            'edit' => 'success',
            'delete' => 'danger',
            'Error' => 'danger',
        ];
    @endphp

    @foreach ($alerts as $key => $type)
        @if (session()->has($key))
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                <strong>{{ session()->get($key) }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endforeach


    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">


                <div class="card-header pb-0">
                    @can('Add')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal"
                            href="#modaldemo8"> Add Devices</a>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th> Operations </th>
                                    <th>Brands </th>
                                    <th> Models</th>
                                    <th>Serial Number</th>
                                </tr>




                            </thead>

                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($brands as $x)
                                    <?php $i++; ?>

                                    <td>{{ $i }}</td>
                                    <td>
                                        @can('Edit')
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-serial_number="{{ $x->serial_number }}"
                                                data-brand="{{ $x->brand }}" data-model="{{ $x->model }}"
                                                data-toggle="modal" href="#exampleModal2" title="Upadte"><i
                                                    class="las la-pen"></i></a>
                                        @endcan

                                        @can('Delete')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-serial_number="{{ $x->serial_number }}"
                                                data-toggle="modal" href="#modaldemo9" title="Delete"><i
                                                    class="las la-trash"></i></a>
                                        @endcan
                                    </td>


                                    <td>{{ $x->brand }}</td>
                                    <td>{{ $x->model }}</td>
                                    <td>{{ $x->serial_number }}</td>

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
                    <h6 class="modal-title"> Add Device</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brands.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="serial_number">Serial Number </label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number"
                                placeholder="Please enter your serial number" required>

                        </div>

                        {{-- <div class="form-group">
                            <label for="brand">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand"
                                placeholder="Please enter your brand" required>
                        </div> --}}

                        {{-- <div class="col">
                            <label for="brand" class="control-label">Brand</label>
                            <select class="form-control SlectBox"onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')" id="brand" name="brand" required>
                                <option value="">Select</option>
                                <option value="acer">Acer</option>
                                <option value="apple">Apple</option>
                                <option value="asus">Asus</option>
                                <option value="dell">Dell</option>
                                <option value="hp">HP</option>
                                <option value="lenovo">Lenovo</option>
                                <option value="msi">MSI</option>
                                <option value="samsung">Samsung</option>
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="brand_id">Brands</label>
                            <select name="brand_id" id="brand_id" class="form-control" required>
                                <option value="" selected disabled>Please select your brands</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->brand }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" name="model"
                                placeholder="Please enter your model" required>
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

                    <form action="brands/update" method="POST" autocomplete="off">
                        {{ method_field('PUT') }}
                        @csrf


                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="recipient-name" class="col-form-label">Serial Number</label>
                            <input class="form-control" name="serial_number" id="serial_number" type="text">
                        </div>





                        {{-- <div class="col">
                            <label for="brand" class="control-label">Brand</label>
                            <select class="form-control SlectBox"onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')" id="brand" name="brand" required>
                                <option value="">Select</option>
                                <option value="acer">Acer</option>
                                <option value="apple">Apple</option>
                                <option value="asus">Asus</option>
                                <option value="dell">Dell</option>
                                <option value="hp">HP</option>
                                <option value="lenovo">Lenovo</option>
                                <option value="msi">MSI</option>
                                <option value="samsung">Samsung</option>
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label for="brand_id">Brands</label>
                            <select name="brand_id" id="brand_id" class="form-control" required>
                                <option value="" selected disabled>Brands</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->brand }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" name="model">
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
                <form action="brands/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p> Are you sure about the deletion process?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="serial_number" id="serial_number" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </div>
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
            var serial_number = button.data('serial_number')
            var brand = button.data('brand')
            var model = button.data('model')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #serial_number').val(serial_number);
            modal.find('.modal-body #brand').val(brand);
            modal.find('.modal-body #model').val(model);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var serial_number = button.data('serial_number')
            var brand = button.data('brand')
            var phone = button.data('phone')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #serial_number').val(serial_number);
            modal.find('.modal-body #brand').val(brand);
            modal.find('.modal-body #model').val(model);
        })
    </script>
@endsection

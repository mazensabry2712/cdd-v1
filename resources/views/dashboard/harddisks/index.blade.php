@extends('layouts.master')
@section('title')
    HardDisks | X Net System - CDD V1.0
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
                    Hard Disk</span>
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

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
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

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
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
                        <a class=" btn btn-outline-primary btn-block" href="{{ route('harddisks.create') }}"> Add HardDisk</a>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th> Operations </th>
                                    <th> Model</th>
                                    <th> Health</th>
                                    <th> Interface</th>
                                    <th> Capacity Value</th>
                                    <th> Capacity Unit</th>
                                    <th> Serial Number</th>
                                    <th> PDF File</th>
                                </tr>




                            </thead>

                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($harddisks as $x)
                                    <?php $i++; ?>

                                    <td>{{ $i }}</td>
                                    <td>
                                        @can('Edit')
                                            <a class=" btn btn-sm btn-info" href="{{ route('harddisks.edit', $x->id) }}"
                                                title="Upadte"><i class="las la-pen"></i></a>
                                        @endcan

                                        @can('Delete')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-model="{{ $x->model }}"
                                                data-toggle="modal" href="#modaldemo9" title="Delete"><i
                                                    class="las la-trash"></i></a>
                                        @endcan
                                    </td>
                                    <td>{{ $x->model }}</td>
                                    <td>{{ $x->health }}</td>
                                    <td>{{ $x->interface }}</td>
                                    <td>{{ $x->capacity_gb }}</td>
                                    <td>{{ $x->capacity_unit }}</td>
                                    <td>{{ $x->serial_number }}</td>
                                    {{-- <td class="px-4 py-2 text-center">
                                        @empty($x->pdf)
                                            <span class="text-gray-400 italic">— No PDF —</span>
                                        @else
                                            <a href="{{ route('harddisks.download', $x->id) }}" target="_blank"
                                                class="inline-flex items-center justify-center text-red-600 hover:text-red-800 transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1 text-red-600"
                                                    viewBox="0 0 64 64" fill="currentColor">
                                                    <path
                                                        d="M44 2H16a4 4 0 0 0-4 4v52a4 4 0 0 0 4 4h32a4 4 0 0 0 4-4V14L44 2zM44 14H32V2.5L44 14z" />
                                                </svg>
                                                <span class="font-medium text-sm">Show PDF</span>
                                            </a>
                                        @endempty
                                    </td> --}}
                                    <td class="px-4 py-2 text-center">
                                        @empty($x->pdf)
                                            <span class="text-gray-400 italic">— No PDF —</span>
                                        @else
                                            <div class="flex justify-center space-x-3">
                                                {{-- زر عرض PDF --}}
                                                <a href="{{ route('harddisks.download', $x->id) }}" target="_blank"
                                                    class="inline-flex items-center text-red-600 hover:text-red-800 transition duration-200">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-red-600"
                                                        viewBox="0 0 64 64" fill="currentColor">
                                                        <path
                                                            d="M44 2H16a4 4 0 0 0-4 4v52a4 4 0 0 0 4 4h32a4 4 0 0 0 4-4V14L44 2zM44 14H32V2.5L44 14z" />
                                                    </svg> --}}
                                                    <span class="font-medium text-sm">Show PDF |</span>
                                                </a>

                                                {{-- زر طباعة PDF --}}
                                                <a href="{{ route('harddisks.print', $x->id) }}" target="_blank"
                                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 transition duration-200">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-blue-600"
                                                        viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M6 9V2h12v7h4v13H2V9h4zm2-5v5h8V4H8zm10 7H6v7h12v-7z" />
                                                    </svg> --}}
                                                    <span class="font-medium text-sm">| Print</span>
                                                </a>
                                            </div>
                                        @endempty
                                    </td>










                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                <form action="harddisks/destroy" method="post">
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

    {{-- <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            var phone = button.data('phone')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #phone').val(phone);
        })
    </script> --}}

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var model = button.data('model')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #model').val(model);

        })
    </script>
@endsection

@extends('layouts.master')
@section('title')
    Branches | X Net System - CDD V1.0
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
                    Branches</span>
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


                <div class="card-header pb-0"> @can('Add')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal"
                            href="#modaldemo8"> Add Branch</a>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th> Operations </th>
                                    <th> Compony </th>
                                    <th> Name </th>
                                    <th> Location </th>
                                    <th> Country </th>
                                    <th> City </th>
                                    <th> Phone</th>

                                </tr>




                            </thead>

                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($branches as $x)
                                    <?php $i++; ?>

                                    <td>{{ $i }}</td>
                                    <td>
                                        @can('Edit')
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-name="{{ $x->name }}"data-compony_id="{{ $x->compony_id }}"
                                                data-br_location="{{ $x->br_location }}" data-country="{{ $x->country }}"
                                                data-city="{{ $x->city }}" data-phone="{{ $x->phone }}"
                                                data-toggle="modal" href="#exampleModal2" title="Upadte"><i
                                                    class="las la-pen"></i></a>
                                        @endcan

                                        @can('Delete')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-name="{{ $x->name }}"
                                                data-toggle="modal" href="#modaldemo9" title="Delete"><i
                                                    class="las la-trash"></i></a>
                                        @endcan
                                    </td>
                                    <td>{{ $x->compony->name }}</td>
                                    <td>{{ $x->name }}</td>
                                    <td>{{ $x->br_location }}</td>
                                    <td>{{ $x->country }}</td>
                                    <td>{{ $x->city }}</td>
                                    <td>{{ $x->phone }}</td>

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
                    <h6 class="modal-title"> Add Branches </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('branches.store') }}" method="post">
                        @csrf

                        <select name="compony_id" id="compony_id" class="form-control" required>
                            <label for="compony_id" class="col-form-label">Compony</label>
                            <option value="" selected disabled>-- Select the Compony --</option>
                            @foreach ($companies as $db)
                                <option value="{{ $db->id }}" {{ old('compony_id') == $db->id ? 'selected' : '' }}>
                                    {{ $db->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="name"> Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your name" required>
                        </div>

                        <div class="form-group">
                            <label for="br_location"> Location</label>
                            <input type="text" class="form-control" id="br_location" name="br_location"
                                placeholder="Enter your Location" required>
                        </div>
                        <div class="form-group">
                            <label for="country"> Country</label>
                            <input type="text" class="form-control" id="country" name="country"
                                placeholder="Enter Your Country " required>
                        </div>
                        <div class="form-group">
                            <label for="city"> City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                placeholder ="Enter Your City" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"> Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="Enter AM phone number" {{-- pattern="[0-9]{10}" --}}required>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit AM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="branches/update" method="post" autocomplete="off">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="compony_id" class="col-form-label">Compony</label>
                            <select name="compony_id" id="compony_id" class="form-control" required>
                                <option value="" selected disabled>-- Select the Compony --</option>
                                @foreach ($companies as $db)
                                    <option value="{{ $db->id }}"
                                        {{ old('compony_id') == $db->id ? 'selected' : '' }}>
                                        {{ $db->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">

                            <label for="recipient-name" class="col-form-label"> Name</label>
                            <input class="form-control" name="name" id="name" type="text">
                        </div>




                        <div class="form-group">
                            <label for="br_location"> Location</label>
                            <input type="text" class="form-control" id="br_location" name="br_location"
                                {{--  placeholder="Enter AM name" --}} required>
                        </div>
                        <div class="form-group">
                            <label for="country"> Country</label>
                            <input type="text" class="form-control" id="country" name="country"
                                {{--  placeholder="Enter AM name" --}} required>
                        </div>
                        <div class="form-group">
                            <label for="city"> City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                {{--  placeholder="Enter AM name" --}} required>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
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
                <form action="branches/destroy" method="post">
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

    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var compony_id= button.data('compony_id')
            var name = button.data('name')
            var br_location = button.data('br_location')
            var country = button.data('country')
            var city = button.data('city')
            var phone = button.data('phone')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #compony_id').val(compony_id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #br_location').val(br_location);
            modal.find('.modal-body #country').val(country);
            modal.find('.modal-body #city').val(city);
            modal.find('.modal-body #phone').val(phone);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);

        })
    </script>
@endsection

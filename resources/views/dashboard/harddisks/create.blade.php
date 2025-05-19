@extends('layouts.master')
@section('title')
    Add HardDisk | X Net System - CDD V1.0
@stop
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Add HardDisks </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    HardDisk </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- @if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                <strong>{{ session()->get('Add') }}</strong>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
    @endif -->

    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="yourFormId" action="{{ route('harddisks.store') }}" method="post"
                        enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}



                        <div class="row mt-3">


                            <div class="col">
                                <label for="model" class="control-label"> Model </label>
                                <input type="text" class="form-control" id="model" name="model"
                                    title="   Please enter your Model " placeholder="Please enter your Model" required>
                            </div>

                            <div class="col">
                                <label for="health" class="control-label">Health</label>
                                <select class="form-control SlectBox"onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" id="health" name="health">
                                    <option value="">Select</option>
                                    <option value="Good">Good</option>
                                    <option value="Warning">Warning</option>
                                    <option value="Critical">Critical</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="interface" class="control-label">Interface</label>
                                <select class="form-control SlectBox"onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" id="interface" name="interface">
                                    <option value="">Select</option>
                                    <option value="SATA">SATA</option>
                                    <option value="NVMe">NVMe</option>
                                    <option value="SAS">SAS</option>
                                    <option value="PCIe">PCIe</option>
                                </select>
                            </div>
                        </div>




                        <div class="row mt-4">





                            <div class="col">
                                <label for="capacity_gb" class="control-label">Capacity Value</label>
                                <input type="number" class="form-control" id="capacity_gb" name="capacity_gb"
                                    title="Please enter the capacity value" required min="0" step="1"
                                    placeholder="Enter capacity value">
                            </div>



                            <div class="col">
                                <label for="status" class="control-label">Capacity Unit</label>
                                <select class="form-control SlectBox"onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" id="capacity_unit" name="capacity_unit">
                                    <option value="">Select</option>
                                    <option value="GB">GB</option>
                                    <option value="TB">TB</option>
                                </select>
                            </div>


                            <div class="col">
                                <label for="serial_number" class="control-label">Serial Number</label>
                                <input type="text" class="form-control" id="serial_number" name="serial_number"
                                    title="Please enter your serial number" required placeholder="Like: SN0XYZ12345">
                            </div>


                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <div style="text-align: justify;">
                                    <div style="display: inline-flex;">
                                        <h5 class="card-title mr-3">PDF File</h5>
                                        <p class="text-danger">* Attachment format PDF File</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="pdf" id="pdf" class="dropify"
                                        accept="application/pdf" data-height="70" data-allowed-file-extensions="pdf"
                                        data-max-file-size="5M" data-errors-position="outside"
                                        data-err-message="Please upload a valid PDF file." />
                                </div>
                                <br>
                            </div>
                        </div>


                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary"> Save </button>
                </div>

                <br>

                </form>
            </div>
        </div>
    </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'mm/dd/yy'
        }).val();
    </script>


@endsection

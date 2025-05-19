@extends('layouts.master')

@section('title', 'Edit Brand | X Net System - CDD V1.0')

@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Internal Fileupload css -->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" />
    <!-- Internal Fancy uploader css -->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!-- Internal Sumoselect css -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!-- Internal TelephoneInput css -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Edit HardDisk</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ HardDisk</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    {{-- عرض رسائل الجلسة --}}
    @foreach (['Error', 'Add', 'delete', 'edit'] as $msg)
        @if (session()->has($msg))
            <div class="alert alert-{{ in_array($msg, ['Error', 'delete']) ? 'danger' : 'success' }} alert-dismissible fade show"
                role="alert">
                <strong>{{ session()->get($msg) }}</strong>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif
    @endforeach

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('harddisks.update', $harddisks->id) }}" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')

                        {{-- Model --}}
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="model" class="control-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model"
                                    title="Please enter your Model" placeholder="Please enter your Model" required
                                    value="{{ old('model', $harddisks->model) }}">
                            </div>

                            <div class="col-md-4">
                                <label for="health" class="control-label">Health</label>
                                <select class="form-control" id="health" name="health" required>
                                    <option value="">Select</option>
                                    <option value="Good"
                                        {{ old('health', $harddisks->health) == 'Good' ? 'selected' : '' }}>Good</option>
                                    <option value="Warning"
                                        {{ old('health', $harddisks->health) == 'Warning' ? 'selected' : '' }}>Warning
                                    </option>
                                    <option value="Critical"
                                        {{ old('health', $harddisks->health) == 'Critical' ? 'selected' : '' }}>Critical
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="interface" class="control-label">Interface</label>
                                <select class="form-control" id="interface" name="interface" required>
                                    <option value="">Select</option>
                                    <option value="SATA"
                                        {{ old('interface', $harddisks->interface) == 'SATA' ? 'selected' : '' }}>SATA
                                    </option>
                                    <option value="NVMe"
                                        {{ old('interface', $harddisks->interface) == 'NVMe' ? 'selected' : '' }}>NVMe
                                    </option>
                                    <option value="SAS"
                                        {{ old('interface', $harddisks->interface) == 'SAS' ? 'selected' : '' }}>SAS
                                    </option>
                                    <option value="PCIe"
                                        {{ old('interface', $harddisks->interface) == 'PCIe' ? 'selected' : '' }}>PCIe
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- Capacity, Unit, Serial --}}
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label for="capacity_gb" class="control-label">Capacity Value</label>
                                <input type="number" class="form-control" id="capacity_gb" name="capacity_gb"
                                    title="Please enter the capacity value" required min="0" step="1"
                                    placeholder="Enter capacity value"
                                    value="{{ old('capacity_gb', $harddisks->capacity_gb) }}">
                            </div>

                            <div class="col-md-4">
                                <label for="capacity_unit" class="control-label">Capacity Unit</label>
                                <select class="form-control" id="capacity_unit" name="capacity_unit" required>
                                    <option value="">Select</option>
                                    <option value="GB"
                                        {{ old('capacity_unit', $harddisks->capacity_unit) == 'GB' ? 'selected' : '' }}>GB
                                    </option>
                                    <option value="TB"
                                        {{ old('capacity_unit', $harddisks->capacity_unit) == 'TB' ? 'selected' : '' }}>TB
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="serial_number" class="control-label">Serial Number</label>
                                <input type="text" class="form-control" id="serial_number" name="serial_number"
                                    title="Please enter your serial number" required placeholder="Like: SN0XYZ12345"
                                    value="{{ old('serial_number', $harddisks->serial_number) }}">
                            </div>
                        </div>

                        {{-- PDF Upload --}}
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label class="control-label d-block mb-2">PDF File <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="pdf" id="pdf" class="dropify"
                                    accept="application/pdf" data-height="70" data-allowed-file-extensions="pdf"
                                    data-max-file-size="5M" data-errors-position="outside"
                                    data-default-file="{{ $harddisks->pdf ? asset('storage/' . $harddisks->pdf) : '' }}"
                                    data-err-message="Please upload a valid PDF file." />
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Internal jQuery (مطلوب للـ Dropify و Fancy Uploader وغيرها) -->
    <script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Internal Dropify js (ضمن Fancy Uploader) -->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

    <!-- Internal Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Sumoselect js -->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!-- Internal jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!-- Internal spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>

    <!-- تهيئة الـ Dropify -->
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endsection

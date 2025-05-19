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
                <h4 class="content-title mb-0 my-auto">Edit Brand</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Brand</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    {{-- عرض رسائل الجلسة --}}
    @foreach (['Error', 'Add', 'delete', 'edit'] as $msg)
        @if (session()->has($msg))
            <div class="alert alert-{{ in_array($msg, ['Error','delete']) ? 'danger' : 'success' }} alert-dismissible fade show" role="alert">
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
                    <form action="{{ route('devicebrands.update', $devicebrands->id) }}"
                          method="POST"
                          enctype="multipart/form-data"
                          autocomplete="off">
                        @csrf
                        @method('PUT')

                        {{-- اسم البراند --}}
                        <div class="form-group">
                            <label for="name">Brand Name</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $devicebrands->name) }}"
                                   required>
                        </div>

                        {{-- شعار البراند --}}
                        <div class="form-group mt-4">
                            <label>Brand Logo</label>
                            <input type="file"
                                   name="image"
                                   class="dropify"
                                   data-height="100"
                                   data-default-file="{{ $devicebrands->image
                                       ? asset('storage/'.$devicebrands->image) : '' }}"
                                   accept=".jpg, .png, image/jpeg, image/png"/>
                            <small class="form-text text-muted">
                                Formats: jpeg, jpg, png. الحد الأقصى: 2 MB.
                            </small>
                        </div>

                        {{-- زر الحفظ --}}
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

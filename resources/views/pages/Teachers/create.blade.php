@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('page-header')
    <!-- breadcrumb -->

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form id="addTeacherForm" action="{{ route('teacher.store') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">Teacher Email</label>
                                        <input type="email" name="Email" class="form-control">
                                        @error('Email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title"> Teacher Password</label>
                                        <input type="password" name="Password" class="form-control">
                                        @error('Password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">Teacher Name</label>
                                        <input type="text" name="Name" class="form-control">
                                        @error('Name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity"> Teacher specialization</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Specialization">
                                            <option selected disabled>specialization choose...</option>
                                            @foreach ($Specializations as $specialization)
                                                <option value="{{ $specialization->id }}">{{ $specialization->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('Specialization_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">Teacher Gender</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                            <option selected disabled>Gander Choose...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>

                                        </select>
                                        @error('Gender')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">Joining_Date</label>
                                        <div class='input-group date'>
                                            <input class="form-control" type="text" id="datepicker-action"
                                                name="Joining_Date" data-date-format="yyyy-mm-dd" required>
                                        </div>
                                        @error('Joining_Date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">teacher Address</label>
                                    <textarea class="form-control" name="Address" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    @error('Address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#addTeacherForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('teacher.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#addTeacherForm')[0].reset();
                        } else {
                            $('.text-danger').remove();

                            $.each(response.errors, function(key, value) {
                                console.log('Input name:', key);
                                console.log('Error messages:', value);
                                var inputField = $('[name="' + key + '"]');
                                var errorDiv = $('<div class="error-container"></div>');
                                inputField.wrap(errorDiv);
                                inputField.after('<span class="text-danger">' + value[
                                    0] + '</span>');;
                            });

                        }

                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred while adding the teacher.');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    @toastr_js
    @toastr_render
@endsection

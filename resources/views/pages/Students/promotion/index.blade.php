@extends('layouts.master')
@section('css')
    @toastr_css

@endsection

<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                        <h6 style="color: red;font-family: Cairo">Old School Stage</h6><br>

                    <form method="post" action="{{ route('promotion.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState"> Phase <span
                                    class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="phase_id" required>
                                    <option selected disabled>Select Phase...</option>
                                    @foreach($Phases as $phase)
                                        <option value="{{$phase->id}}">{{$phase->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="grade_id">Grade : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="grade_id" required>

                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="section_id">Class: </label>
                                <select  class="custom-select mr-sm-2" name="section_id" required>

                                </select>
                            </div>
                        </div>
                        <br><h6 style="color: red;font-family: Cairo"> New School Stage </h6><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">Phase : <span
                                    class="text-danger">*</span></label>
                                <select required  class="custom-select mr-sm-2" name="phase_id_new" >
                                    <option selected disabled>Select Phase...</option>
                                    @foreach($Phases as $phase)
                                        <option value="{{$phase->id}}">{{$phase->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="grade_id">Grade: <span
                                        class="text-danger">*</span></label>
                                <select required class="custom-select mr-sm-2" name="grade_id_new" >

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">Class :<span
                                    class="text-danger">*</span> </label>
                                <select required class="custom-select mr-sm-2" name="section_id_new" >

                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
@section('js')

    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function() {
            $('select[name="phase_id_new"]').on('change', function() {
                var phase_id = $(this).val();
                console.log(phase_id)
                if (phase_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_grade') }}/" + phase_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data)
                            $('select[name="grade_id_new"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="grade_id_new"]').append('<option value="' +
                                    value + '">' + key + '</option>');
                            });
    
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    
    
    <script>
        $(document).ready(function() {
            $('select[name="grade_id_new"]').on('change', function() {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data)
                            $('select[name="section_id_new"]').append(
                                '<option  value=""  selected>select Grade</option>');
    
                            $('select[name="section_id_new"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="section_id_new"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
    
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

@endsection

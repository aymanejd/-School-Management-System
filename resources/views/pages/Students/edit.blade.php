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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{route('student.update',$Students->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue"> Personal Information</h6><br>
                        <div class="row">
                           

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Student Name: <span class="text-danger">*</span></label>
                                    <input value="{{$Students->name}}" class="form-control" name="Name" type="text" >
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $Students->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Student Email: </label>
                                    <input type="email" value="{{ $Students->email }}" name="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Student Password :</label>
                                    <input value="{{ Str::limit($Students->password,'8')  }}" type="password" name="password" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Gender">Student Gender : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Gender">
                                            <option  disabled>Gander Choose...</option>
                                            <option {{"Male" == $Students->Gender ? 'selected' : ""}} value="Male">Male</option>
                                            <option  {{"Female" == $Students->Gender ? 'selected' : ""}} value="Female">Female</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">Student Nationality: <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationalitie_id">
                                        <option selected disabled>Select Nationality...</option>
                                        @foreach($nationals as $nal)
                                            <option value="{{ $nal->id }}" {{$nal->id == $Students->nationalitie_id ? 'selected' : ""}}>{{ $nal->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                           

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Student Date Birth :</label>
                                    <input class="form-control" type="text" value="{{$Students->Date_Birth}}" id="datepicker-action" name="Date_Birth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                        </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">Student Information</h6><br>
                    <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="phase_id">Student Phase : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="phase_id">
                                        <option  disabled>Select Phase...</option>
                                        @foreach($Phases as $Phase)
                                            <option value="{{ $Phase->id }}" {{$Phase->id == $Students->Phase_id ? 'selected' : ""}}>{{ $Phase->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="grade_id">Student Class : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option value="{{$Students->grade_id}}">{{$Students->grade->grade_name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">Student Grade : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                        <option value="{{$Students->section_id}}"> {{$Students->section->Name_Section}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">Student parent: <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>Select parent...</option>
                                       @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ $parent->id == $Students->parent_id ? 'selected' : ""}}>{{ $parent->Name_Father }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">Student Academie Year: <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>Academic Year..</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $Students->academic_year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        </div><br>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Update</button>
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
            $('select[name="phase_id"]').on('change', function() {
                var phase_id = $(this).val();
                console.log(phase_id)
                if (phase_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_grade') }}/" + phase_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data)
                            $('select[name="grade_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="grade_id"]').append('<option value="' +
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
            $('select[name="grade_id"]').on('change', function() {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data)
                            $('select[name="section_id"]').append(
                                '<option  value=""  selected>select Grade</option>');
    
                            $('select[name="section_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="section_id"]').append(
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

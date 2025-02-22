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
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                    Rollback All
                                </button>
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">Student Name</th>
                                            <th class="alert-danger">Old Phase  </th>
                                            <th class="alert-danger">  Old Grade</th>
                                            <th class="alert-danger">Old Class  </th>
                                            <th class="alert-success"> Actuel Phase</th>
                                            <th class="alert-success">Actuel Grade  </th>
                                            <th class="alert-success"> Actuel Class </th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->f_phase->Name}}</td>
                                                <td>{{$promotion->f_grade->grade_name}}</td>
                                                <td>{{$promotion->f_section->Name_Section}}</td>
                                                <td>{{$promotion->t_phase->Name}}</td>
                                                <td>{{$promotion->t_grade->grade_name}}</td>
                                                <td>{{$promotion->t_section->Name_Section}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">Return Student</button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">تخرج الطالب</button>
                                                </td>
                                            </tr>
                                   @include('pages.Students.promotion.Delete_all')
                                   @include('pages.Students.promotion.Delete_one')

                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

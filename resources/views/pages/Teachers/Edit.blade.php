@extends('layouts.master')
@section('css')
    @toastr_css

@endsection
@section('page-header')

<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
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
                            <form id="updateteacher" action="{{route('teacher.update',$teacher->id)}}" method="post">
                             @csrf
                             @method('put')
                            <div class="form-row">
                                <div class="col">
                                    <label for="title"> Teacher Email</label>
                                    <input type="hidden" value="{{$teacher->id}}" name="id">
                                    <input type="email" name="Email" value="{{$teacher->Email}}" class="form-control">
                                    @error('Email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">Teacher Password</label>
                                    <input type="password" name="Password" value="{{$teacher->Password}}" class="form-control">
                                    @error('Password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                               
                                <div class="col">
                                    <label for="title">Teacher Name</label>
                                    <input type="text" name="Name" value="{{ $teacher->Name}}" class="form-control">
                                    @error('Name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">Teacher specialization</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                        <option value="{{$teacher->Specialization_id}}">{{$teacher->specializations->Name}}</option>
                                        @foreach($specializations as $specialization)
                                            <option value="{{$specialization->id}}">{{$specialization->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Specialization_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState"> Teacher Gender</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Gender">
                                        <option value="{{$teacher->Gender}}">{{$teacher->Gender}}</option>
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
                                    <label for="title">Teacher Joining_Date</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action"  value="{{$teacher->Joining_Date}}" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                    </div>
                                    @error('Joining_Date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Teacher Address</label>
                                <textarea class="form-control" name="Address"
                                          id="exampleFormControlTextarea1" rows="4">{{$teacher->Address}}</textarea>
                                @error('Address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Update</button>
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
    @toastr_js
    
  
    
@endsection

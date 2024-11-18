@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('page-header')
@endsection
@section('content')
    <style>
        .acd-heading !important {
            background-color: #455ddc;
        }

        input:focus {
            border: 1px solid #455ddc !important;
        }

        input {
            border-radius: 0.75rem !important;
        }
    </style>
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        Add Section</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($phases as $phase)
                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $phase->Name }}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th>#</th>
                                                                        <th>Section Name
                                                                        </th>
                                                                        <th>Grade name</th>
                                                                        <th>Status</th>
                                                                        <th>Proccess</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 0; ?>
                                                                    @foreach ($phase->sections as $list_Sections)
                                                                        <tr id="tr_{{ $list_Sections->id }}">
                                                                            <?php $i++; ?>
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $list_Sections->Name_Section }}</td>
                                                                            <td>{{ $list_Sections->grades->grade_name }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($list_Sections->Status === 1)
                                                                                    <label
                                                                                        class="badge badge-success">Active</label>
                                                                                @else
                                                                                    <label class="badge badge-danger">Not
                                                                                        active</label>
                                                                                @endif

                                                                            </td>
                                                                            <td>

                                                                                <a href="#"
                                                                                    class="btn btn-outline-info btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-target="#edit{{ $list_Sections->id }}">Edit</a>
                                                                                <a href="#"
                                                                                    class="btn btn-outline-danger btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-target="#delete{{ $list_Sections->id }}">Delete</a>
                                                                            </td>
                                                                        </tr>


                                                                        <div class="modal fade"
                                                                            id="edit{{ $list_Sections->id }}" tabindex="-1"
                                                                            role="dialog"
                                                                            aria-labelledby="exampleModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            style="font-family: 'Cairo', sans-serif;"
                                                                                            id="exampleModalLabel">
                                                                                            Edit Section
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <form
                                                                                            action="{{ route('section.update', 'test') }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('put')
                                                                                            <div class="row">


                                                                                                <div class="col">
                                                                                                    <input type="text"
                                                                                                        name="Name_Section"
                                                                                                        required
                                                                                                        class="form-control"
                                                                                                        value="{{ $list_Sections->Name_Section }}">
                                                                                                    <input id="id"
                                                                                                        type="hidden"
                                                                                                        name="id"
                                                                                                        required
                                                                                                        class="form-control"
                                                                                                        value="{{ $list_Sections->id }}">
                                                                                                </div>

                                                                                            </div>
                                                                                            <br>


                                                                                            <div class="col">
                                                                                                <label for="inputName"
                                                                                                    class="control-label">Phase
                                                                                                    Name</label>
                                                                                                <select name="phase"
                                                                                                    class="custom-select"
                                                                                                    onclick="console.log($(this).val())"
                                                                                                    required>
                                                                                                    <option value=""
                                                                                                        selected disabled>
                                                                                                        --Select Phase--
                                                                                                    </option>
                                                                                                    @foreach ($list_phases as $list_phase)
                                                                                                        <option
                                                                                                            value="{{ $list_phase->id }}">
                                                                                                            {{ $list_phase->Name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            <br>

                                                                                            <div class="col">
                                                                                                <label for="inputName"
                                                                                                    class="control-label">Grade
                                                                                                    Name</label>
                                                                                                <select name="grade"
                                                                                                    required
                                                                                                    class="custom-select">
                                                                                                    <option
                                                                                                        value="{{ $list_Sections->grades->id }}">
                                                                                                        {{ $list_Sections->grades->grade_name }}
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <br>

                                                                                            <div class="col">
                                                                                                <div class="form-check">

                                                                                                    @if ($list_Sections->Status === 1)
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            checked
                                                                                                            class="form-check-input"
                                                                                                            name="Status"
                                                                                                            
                                                                                                            id="exampleCheck1">
                                                                                                    @else
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            class="form-check-input"
                                                                                                            name="Status"
                                                                                                            
                                                                                                            id="exampleCheck1">
                                                                                                    @endif
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="exampleCheck1">
                                                                                                        Section
                                                                                                        Status</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <label for="inputName" class="control-label">Teacher Name</label>
                                                                                                <select multiple name="teacher[]" class="form-control" id="exampleFormControlSelect2">
                                                                                                    @foreach($list_Sections->teachers as $teacher)
                                                                                                        <option selected value="{{$teacher['id']}}">{{$teacher['Name']}}</option>
                                                                                                    @endforeach

                                                                                                    @foreach($teachers as $teacher)
                                                                                                        <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Close</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-success">Update</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="modal fade delete_model"
                                                                            id="delete{{ $list_Sections->id }}"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="exampleModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                            class="modal-title"
                                                                                            id="exampleModalLabel">
                                                                                            Delete Section
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form
                                                                                            action="{{ route('section.destroy', $list_Sections->id) }}"
                                                                                            method="post">
                                                                                            @method('delete')
                                                                                            @csrf
                                                                                            Are You sure about the deleting
                                                                                            proccess
                                                                                            @foreach ($list_Sections->teachers as $teacher)
                                                                                                <input id="teacher_id"
                                                                                                    type="hidden"
                                                                                                    name="teacher_id"
                                                                                                    class="form-control"
                                                                                                    required
                                                                                                    value="{{ $teacher->pivot->teacher_id }}">
                                                                                            @endforeach
                                                                                            <input 
                                                                                                type="hidden"
                                                                                                name="id"
                                                                                                class="form-control"
                                                                                                required
                                                                                                value="{{ $list_Sections->id }}">
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">Close</button>
                                                                                                <button type="submit"
                                                                                                    id="delete"
                                                                                                    class="btn btn-danger">Delete</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                    Add Section</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('section.store') }}" id="addsection" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="Name_Section" class="form-control" required
                                                placeholder="Section Name">
                                        </div>

                                    </div>
                                    <br>
                                    <div class="col">
                                        <label for="inputName" class="control-label">Phase Name</label>
                                        <select name="phase" required class="custom-select"
                                            onchange="console.log($(this).val())">
                                            <option value="" selected disabled>--Select Phase--
                                            </option>
                                            @foreach ($list_phases as $list_phase)
                                                <option value="{{ $list_phase->id }}"> {{ $list_phase->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="inputName" class="control-label">Grade Name</label>
                                        <select name="grade" required class="custom-select">

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">teacher Name</label>
                                        <select required name="teacher[]" multiple class="form-control"
                                            id="exampleFormControlSelect2">
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}"> {{ $teacher->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="add" class="btn btn-success">Add</button>
                            </div>
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
    @toastr_render
    <script>
        $(document).ready(function() {
            $('select[name="phase"]').on('change', function() {
                var phase = $(this).val();
                if (phase) {
                    $.ajax({
                        url: "{{ URL::to('phases') }}/" + phase,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="grade"]').empty();
                            $.each(data, function(key, value) {
                                console.log(data);
                                $('select[name="grade"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
            // $(document).on('click', '#delete', function(e) {
            //     e.preventDefault();

            //     var sectionId = $(this).closest('.modal').find('#id').val();
            //     console.log(sectionId);
            //     var teacherId = $(this).closest('.modal').find('#teacher_id').val(); // Assuming the teacher_id is stored in an input with id "teacher_id"

            //     $.ajax({
            //         url: '/section/' + sectionId,
            //         type: 'DELETE',
            //         dataType: 'json',
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             teacher_id: teacherId // Pass the teacher_id parameter

            //         },
            //         success: function(response) {
            //             $('.delete_model').removeClass(' in show').css;
            //             console.log(response);
            //             toastr.success('Section deleted successfully.');
            //             $('#Name_Section').value = '';

            //             $("#" + response['tr']).slideUp("slow");
            //             var phase = $(this).val();

            //             if (phase) {
            //                 $.ajax({
            //                     url: "{{ URL::to('phases') }}/" + phase,
            //                     type: "GET",
            //                     dataType: "json",
            //                     success: function(data) {
            //                         $('select[name="grade"]').empty();
            //                         $.each(data, function(key, value) {
            //                             $('select[name="grade"]').append(
            //                                 '<option value="' +
            //                                 key + '">' + value +
            //                                 '</option>');
            //                         });
            //                     },
            //                 });
            //             }
            //         },
            //         error: function(xhr, status, error) {
            //             console.error(xhr.responseText);
            //         }
            //     });
            // });
            /* $(document).on('submit', '#addsection', function(e) {
                 e.preventDefault();

                 var formdata = $('#addsection').serialize();
                 console.log(formdata);

                 $.ajax({
                     url: "{{ route('section.store') }}",
                     type: 'POST',
                     dataType: 'json',
                     data: formdata,
                     success: function(response) {
                         console.log(response);
                         toastr.success('Section created successfully.');
                         var newRow = '<tr>' +
                 '<td>' + response.Name_Section + '</td>' +
                 '</tr>';

             $('table tbody').append(newRow);
                         $('#addsection')[0].reset()
                     },
                     error: function(xhr, status, error) {
                         console.error(xhr.responseText);
                     }
                 });
             });*/
        });
    </script>
@endsection

@extends('layouts.master')
@section('css')
    @toastr_css

@endsection
@section('page-header')
@section('PageTitle')
@stop
@endsection
@section('content')
<style>
    .select:focus,
    input:focus {
        border: 1px solid #455ddc !important;
    }

    input {
        border-radius: 0.75rem !important;
    }

    .addgrade {
        display: flex;
        justify-content: flex-end;
    }
</style>
<div class="row">

    <div class="col-xl-12 mb-30">
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

                <button type="button" class=" x-small btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    Add Grade
                </button>
                <button type="button" class=" x-small btn btn-danger" id="btn_delete_all">
                    Delete Selected Grades
                </button>
                <br><br>
                <form style="margin-bottom: 20px" action="{{ route('filter_grade') }}" method="post">
                    @csrf
                    <select onchange="this.form.submit()" class="custom-select" name="phase_id">
                        <option disabled>
                            --Select Phase--
                        </option>
                        @foreach ($phases as $phase)
                            <option value="{{ $phase->id }}">
                                {{ $phase->Name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" onclick="checkAll('box2',this)"></th>
                                <th>Number</th>
                                <th>Grade Name</th>
                                <th>Phase Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @if (@isset($searchgrade))
                            <?php $list_phase = $searchgrade; ?>
                        @else
                            <?php $list_phase = $grades; ?>
                        @endif
                        <tbody>
                            <?php $i = 0; ?>

                            @foreach ($list_phase as $grade)
                                <?php $i++; ?>

                                <tr>
                                    <td><input type="checkbox" class="box2" value="{{ $grade->id }}"></td>
                                    <td>{{ $i }}</td>
                                    <td>{{ $grade->grade_name }}</td>
                                    <td>
                                        {{ $grade->phases->Name }}
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $grade->id }}" title="Edit"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $grade->id }}" title="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    edit Grade
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('grade.update', $grade->id) }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="grade_name" class="mr-sm-2">Grade Name
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $grade->grade_name }}" name="grade_name"
                                                                required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="grade_name" class="mr-sm-2">Phase Name
                                                                :</label>
                                                            <select id="filter_grade" class="custom-select"
                                                                name="phase_id" required>
                                                                <option value=" {{ $grade->phases->id }} ">
                                                                    {{ $grade->phases->Name }}
                                                                </option>
                                                                @foreach ($phases as $phase)
                                                                    <option value="{{ $phase->id }}">
                                                                        {{ $phase->Name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    Delete Grade
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('grade.destroy', $grade->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    Are You Sure of the deleting process

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        Add Grade
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class=" row mb-30" action="{{ route('grade.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Phases">
                                    <div data-repeater-item>

                                        <div class="row">
                                            <div class="col">
                                                <label for="grade_name" class="mr-sm-2">Grade Name
                                                    :</label>
                                                <input class="form-control" type="text" name="grade_name"
                                                    required />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">Phase Name
                                                    :</label>

                                                <div class="box">
                                                    <select id="filter_grade" class="custom-select" name="Grade_id">
                                                        <option disabled>
                                                            --Select Phase--
                                                        </option>
                                                        @foreach ($phases as $phase)
                                                            <option value="{{ $phase->id }}">{{ $phase->Name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">Action
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button" value="delete" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="Add More Phase" />
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>

    </div>
</div>
</div>
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Delete Grade
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('delete_all') }}" method="post">
                    @csrf
                    @method('delete')
                    <span>Are You Sure of the deleting process
                    </span>
                    <input type="text" class="text" id="delete_all_id" name="delete_all_id" />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('js')
<script>
    function checkAll(className, elt) {
        let elmts = document.getElementsByClassName(className);
        for (let i = 0; i < elmts.length; i++) {
            elmts[i].checked = elt.checked;
        }
    }
</script>
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = [];

            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push($(this).val());
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show');
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>

@toastr_js
@toastr_render
@endsection

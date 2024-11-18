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
                                <a href="{{ route('teacher.create') }}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">Add Teacher</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> Name</th>
                                                <th> Gender</th>
                                                <th> Joining_Date</th>
                                                <th>specialization</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($Teachers as $Teacher)
                                                <tr id="tr_{{ $Teacher->id }}">
                                                    <?php $i++; ?>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $Teacher->Name }}</td>
                                                    <td>{{ $Teacher->Gender }}</td>
                                                    <td>{{ $Teacher->Joining_Date }}</td>
                                                    <td>{{ $Teacher->specializations->Name }}</td>
                                                    <td>
                                                        <a href="{{ route('teacher.edit', $Teacher->id) }}"
                                                            class="btn btn-info btn-sm" role="button"
                                                            aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_Teacher{{ $Teacher->id }}"
                                                            title=""><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="delete_Teacher{{ $Teacher->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{ route('teacher.destroy',$Teacher->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                        class="modal-title" id="exampleModalLabel">
                                                                      Delete teacher </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>     Are You sure about the deleting
                                                                        proccess </p>
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $Teacher->id }}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit"
                                                                        data-dismiss="modal" id="delete" class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
@endsection
@section('js')
 
    @toastr_js
    @toastr_render
    <script>
           $(document).on('click', '#delete', function(e) {
                e.preventDefault();

                var teacherId = $(this).closest('.modal').find('input[name="id"]').val();
                console.log(teacherId);

                $.ajax({
                    url: '/teacher/'+teacherId,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        toastr.success('Teacher deleted successfully.');
                        $('#Name_Section').value = '';

                        $("#" + response['tr']).slideUp("slow");
                        var phase = $(this).val();

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
    </script>
@endsection

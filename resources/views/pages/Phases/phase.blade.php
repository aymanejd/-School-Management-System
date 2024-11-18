@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
Grade List
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<style>
    textarea:focus ,input:focus{
        border:1px solid #455ddc !important;
    }
    textarea , input{
        border-radius:0.75rem !important ;
    }
    .addgrade{
        display: flex;
        justify-content: flex-end;
    }
    
</style>
<div class="row">


{{-- @if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif --}}



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
                 <button type="button" class=" x-small btn btn-success"  data-toggle="modal"
                    data-target="#exampleModal" >
                    Add Phase
                </button>
            
            <br><br>

            <div class="table-responsive">
                <table id="datatable"  class="table table-striped" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col">Number</th>
                            <th  scope="col">Name</th>
                            <th scope="col" >Note</th>
                            <th scope="col">Processes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($grades as $Grade)
                            <tr>
                                <?php $i++; ?>
                                <td >{{ $i }}</td>
                                <td>{{ $Grade->Name }}</td>
                                <td>{{ $Grade->Notes }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm btn-primary" data-toggle="modal"
                                        data-target="#edit{{ $Grade->id }}"
                                        ><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $Grade->id }}"
                                        ><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $Grade->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Edit Phase
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('phase.update', $Grade->id) }}" method="post">
                                                 @method('put') 
                                                @csrf
                                                <div class="row">
                                                   
                                                    <div class="col">
                                                        <label for="Name_en"
                                                            class="mr-sm-2">Phase name
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $Grade->Name }}"
                                                            name="Name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">Notes
                                                        :</label>
                                                    <textarea class="form-control" name="Notes"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{ $Grade->Notes }}</textarea>
                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-success">Update</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Delete Grade                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('phase.destroy', $Grade->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                              Are You Sure of the deleting process
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">Delete</button>
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


<!-- add_modal_Grade -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Add Phase
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        
                        <div class="col">
                            <label for="Name" class="mr-sm-2">stage name
                                :</label>
                            <input type="text" class="form-control" name="Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Notes
                            :</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                            rows="3" required ></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success"> Add</button>
            </div>
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
@endsection

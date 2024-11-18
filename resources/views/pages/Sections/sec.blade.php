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
        .collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
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
                                    <button class="collapsible">{{ $phase->Name }}</button>
                                    <div class="acd-des content">

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

             

            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
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
           
            
        });
    </script>
@endsection

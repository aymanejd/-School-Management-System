<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd"
    type="button">Add New Parent</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
        style="text-align: center">
        <thead>
            <tr class="table-success">
                <th>Email</th>
                <th>Name</th>
                <th>Nationality</th>
                <th>Phone</th>
                <th>Job</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($my_parents as $my_parent)
                <tr>
                    <td>{{ $my_parent->Email }}</td>
                    <td>{{ $my_parent->Name_Father }}</td>
                    <td>{{ $my_parent->National_ID_Father }}</td>
                    <td>{{ $my_parent->Phone_Father }}</td>
                    <td>{{ $my_parent->Job_Father }}</td>
                    <td>
                        <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('Grades_trans.Edit') }}"
                            class="btn btn-outline-info btn-sm">Edit</button>
                        <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                            data-target="#delete{{ $my_parent->id }}">Delete</a>
                    </td>
                </tr>
                <div class="modal fade delete_model" id="delete{{ $my_parent->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    Delete Section
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                Are You sure about the deleting proccess
                                <input id="id" type="hidden" name="id" class="form-control"
                                    value="{{ $my_parent->id }}">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="b" id="delete" data-dismiss="modal"
                                        wire:click="delete({{ $my_parent->id }})"
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

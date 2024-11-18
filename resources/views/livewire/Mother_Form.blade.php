    <div  class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div style="max-width: 50%" class="col">
                        <label for="title">Mother Name</label>
                        <input type="text" wire:model="Name_Mother" class="form-control">
                        @error('Name_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                </div>

                <div class="form-row">
                   
                    <div class="col-md-3">
                        <label for="title">Mother Jod</label>
                        <input type="text" wire:model="Job_Mother" class="form-control">
                        @error('Job_Mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">Mother National Id</label>
                        <input type="text" wire:model="National_ID_Mother" class="form-control">
                        @error('National_ID_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">Mother Passport Id</label>
                        <input type="text" wire:model="Passport_ID_Mother" class="form-control">
                        @error('Passport_ID_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">Mother Phone</label>
                        <input type="text" wire:model="Phone_Mother" class="form-control">
                        @error('Phone_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Mother Nationalitie choose... </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Mother_id">
                            <option selected>Mother Nationalitie choose...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->Name}}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col">
                        <label for="inputZip">Mother Religion</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Mother_id">
                            <option selected>Mother Religion choose....</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->Name}}</option>
                            @endforeach
                        </select>
                        @error('Religion_Mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Mother Adress</label>
                    <textarea class="form-control" wire:model="Address_Mother" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('Address_Mother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button  style="width: 70px " class="btn btn-danger btn-md nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                   Back
                </button>

                @if ($updateMode)
                <button style="width: 70px " class="btn btn-success btn-md nextBtn btn-lg pull-right"
                    wire:click="secondStepSubmit_edit">
                    Next
                </button>
            @else
                <button style="width: 70px " class="btn btn-success btn-md nextBtn btn-lg pull-right"
                    wire:click="secondStepSubmit">
                    Next
                </button>
            @endif


            </div>
        </div>
    </div>



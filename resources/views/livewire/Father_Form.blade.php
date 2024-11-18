    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="title">Email</label>
                        <input type="email" wire:model="Email" class="form-control">

                        @error('Email')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">Password</label>
                        <input type="password" wire:model="Password" class="form-control">
                        @error('Password')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col" style="max-width: 50%">
                        <label for="title">Father Name</label>
                        <input type="text" wire:model="Name_Father" class="form-control">
                        @error('Name_Father')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">Father Job</label>
                        <input type="text" wire:model="Job_Father" value="{{ old('Job_Father') }}"
                            class="form-control">
                        @error('Job_Father')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-3">
                        <label for="title">Father National ID</label>
                        <input type="text" wire:model="National_ID_Father" class="form-control">
                        @error('National_ID_Father')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">Father Passport Id</label>
                        <input type="text" wire:model="Passport_ID_Father" class="form-control">
                        @error('Passport_ID_Father')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="title">Father Phone</label>
                        <input type="text" wire:model="Phone_Father" class="form-control">
                        @error('Phone_Father')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Father Nationalitie </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Father_id">
                            <option  selected>Father Nationalitie choose...</option>
                            @foreach ($Nationalities as $National)
                                <option value="{{ $National->id }}">{{ $National->Name }}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Father_id')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <label for="inputZip">Father Religion </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Father_id">
                            <option  selected>Father Religion choose...</option>
                            @foreach ($Religions as $Religion)
                                <option value="{{ $Religion->id }}">{{ $Religion->Name }}</option>
                            @endforeach
                        </select>
                        @error('Religion_Father_id')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Father Adress</label>
                    <textarea class="form-control" wire:model="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('Address_Father')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                @if ($updateMode)
                    <button style="width: 70px " class="btn btn-success btn-md nextBtn btn-lg pull-right"
                        wire:click="firstStepSubmit_edit">
                        Next
                    </button>
                @else
                    <button style="width: 70px " class="btn btn-success btn-md nextBtn btn-lg pull-right"
                        wire:click="firstStepSubmit">
                        Next
                    </button>
                @endif


            </div>
        </div>
    </div>

<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    <div class="stepwizard">
          <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="" disabled
                   class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                <p>Father Information</p>
            </div>
            <div class="stepwizard-step">
                <a href="" 
                   class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                <p>Mother Information</p>
            </div>
            <div class="stepwizard-step">
                <a href="" 
                   class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                   disabled="disabled">3</a>
                <p>Confirm Information</p>
            </div>
        </div>
    </div>
 @if($show_table)
 @include('livewire.Parent_Table')

 @else
 @if($currentStep == 1)
 @include('livewire.Father_Form')
@elseif($currentStep == 2)
 @include('livewire.Mother_Form')
@endif

 <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
     @if ($currentStep != 3)
         <div style="display: none" class="row setup-content" id="step-3">
     @endif
     <div class="col-xs-12">
         <div class="col-md-12">
             <h3 style="font-family: 'Cairo', sans-serif;">Are you sure about saving the data? </h3><br>
             <button class="btn btn-danger btn-md nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
             @if ($updateMode)
             <button class="btn btn-success btn-md btn-lg pull-right" wire:click="submitForm_edit" type="button">Finish</button>
         @else
         <button class="btn btn-success btn-md btn-lg pull-right" wire:click="submitForm" type="button">Finish</button>
         @endif

         </div>
     </div>
 </div>
 @endif
   
</div>

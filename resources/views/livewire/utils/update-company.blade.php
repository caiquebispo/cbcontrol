<div>
    
    <x-select 
    class="hidden sm:block mr-5 w-52"
        wire:model.defer="company_id"
        placeholder="Selecione uma Empresa"
        :async-data="route('users.index', auth()->user()->id)"
        option-label="corporate_reason"
        option-value="id" 
        
        x-on:selected=" Livewire.emit('changeCompany')"
    />
</div>

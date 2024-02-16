<div class="w-80">
    <input wire:model.live="query" id="{{ $this->fieldName }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5 autocomplete-field" placeholder="Select your winner!" aria-autocomplete="list" aria-details="list of elements will appear below when you type"/>
    @error('query')
        <span class="text-md text-red-500">Click an option in the list!</span>
    @enderror
    @if($results)
        <div class="relative">
            <div class="absolute w-64">
                @foreach($results as $row)
                    <div class="cursor-pointer p-2 hover:bg-slate-800 bg-slate-200 text-black hover:text-gray-100 border-b" wire:click="inputSelected('{{ $row->id }}', '{{ $this->eventId }}', '{{ $this->fieldName }}')" style="z-index: 1" aria-details="Clickable element for inputting answer to field. Autocomplete list item">
                        {{$row->name }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@script
<script>
    if ($wire.focusThisField){
        let el = document.getElementById($wire.fieldName);
        el.focus();
    }
</script>
@endscript
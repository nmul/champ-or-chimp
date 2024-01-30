<div class="w-80">
    <input wire:model.live="query" id="{{ $this->table }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" placeholder="Select your winner!" />
    @if($results)
        <div class="relative">
            <div class="absolute w-64">
                @foreach($results as $row)
                    <div class="p-2 bg-slate-800 hover:bg-slate-200 hover:text-black text-gray-100 border-b" wire:click="inputSelected('{{ $row->id }}', '{{ $this->eventId }}', '{{ $this->fieldName }}')" style="z-index: 1">
                        {{$row->name }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

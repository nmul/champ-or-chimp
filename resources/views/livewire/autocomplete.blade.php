<div class="w-80">
    <input wire:model.live="query" id="{{ $this->table }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type to see answers" />
    @if($results)
        <div class="relative">
            <div class="absolute w-full">
                @foreach($results as $row)
                    <div class="p-2 bg-white hover:bg-slate-300 text-gray-800 border-b" wire:click="inputSelected('{{ $row->id }}', '{{ $this->eventId }}', '{{ $this->fieldName }}')">
                        {{$row->name }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

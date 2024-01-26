<div>
    <div class="flex flex-wrap gap-2">
    @foreach($genres as $g)
        <span
         class="cursor-pointer px-2 py-1 rounded-lg font-medium transition text-white {{$selected == $g->title ? 'bg-primary-500' : 'bg-gray-500'}}"
         wire:click="topten('{{$g->title}}')"
            >
            {{ $g->title }}
        </span>
    @endforeach
    </div>

    <div class="grid mt-4">
        @foreach($movies as $inx => $m)
            <p class="" >
                {{$inx+1}}: {{ $m->title }}
            </p>
        @endforeach
    </div>
</div>

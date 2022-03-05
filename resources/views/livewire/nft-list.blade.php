<div>
    <div class="mt-6">
        <div class="flex items-center">
            <div class="">
                Sort by
            </div>

            <div class="sm:hidden ml-auto">
                <label for="tabs" class="sr-only">Select a tab</label>
                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                <select id="sort" name="sort" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" wire:model="sort">
                    @foreach($sorts as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
              </div>
              <div class="hidden sm:block ml-auto">
                <nav class="flex space-x-4" aria-label="Tabs">
                    @foreach($sorts as $key => $value)
                        <button 
                            wire:click="sort('{{ $key }}')"
                            class="@if($sort == $key) bg-gray-200 text-gray-700 @else text-gray-500 hover:text-gray-700 @endif px-3 py-2 font-medium text-sm rounded-md">{{ $value }}
                        </button>
                    @endforeach
                </nav>
              </div>
            
        </div>
    </div>
    <div class="my-4">
        <ul class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-10 gap-4">
            @foreach ($coins as $index => $coin)
                @php 
                    $lgflip = false;
                    $mdflip = false;
                    $flip = false;
                    if ($index > 0) {
                        $pos = $index + 1;
                        if ($pos % 10 == 0) {
                            $lgflip = true;
                        }
                        if ($pos % 8 == 0) {
                            $mdflip = true;
                        }
                        if ($pos % 4 == 0) {
                            $flip = true;
                        }
                    }
                @endphp
                <li class="group p-4 bg-white rounded-lg border shadow-sm flex items-center justify-center relative h-full">
                    <div class="h-full flex-col text-center">
                        <div class=" grow h-full">
                            <img src="{{ $coin->logo_url }}" class="w-full" alt="">
                        </div>
                    </div>
                    <div class="absolute flex-shrink-0 top-0 left-0 text-xs bg-white rounded-lg p-1">{{ $index+1 }}</div>
                    <div class="invisible group-hover:visible absolute opacity-75 rounded-lg h-56 md:h-72 w-48 
                        top-0 left-0 {{ $lgflip ? 'lg:-ml-20' : '' }} {{ $mdflip ? 'md:-ml-24' : '' }} {{ $flip ? '-ml-24' : '' }}
                        bg-black z-10">
                        <a class="block rounded-lg h-full w-full" href="https://nomics.com/assets/{{ $coin->symbol }}">
                        <div class="p-4">
                            <div class="text-white text-sm">{{ $coin->name }}</div>
                            <div class="mt-2 text-white text-xs">Last</div>
                            <div class="text-white text-sm">{{ '$'.number_format($coin->price, 2) }}</div>

                            <div class="mt-2 text-white text-xs">Market cap</div>
                            <div class="text-white text-sm">{{ '$'.capFormat($coin->market_cap) }}</div>

                            <div class="mt-2 text-white text-xs">One day volume</div>
                            <div class="text-white text-sm">{{ '$'.capFormat($coin->oneday_volume) }}</div>

                        </div>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@php 
    function capFormat($number)
    {
        if ($number < 1000000) {
            // Anything less than a million
            $format = number_format($number);
        } else if ($number < 1000000000) {
            // Anything less than a billion
            $format = number_format($number / 1000000, 2) . 'M';
        } else if ($number < 1000000000000) {
            // At least a billion
            $format = number_format($number / 1000000000, 2) . 'B';
        } else {
            // At least a trillion
            $format = number_format($number / 1000000000000, 2) . 'T';
        }

        return $format;
    }
@endphp
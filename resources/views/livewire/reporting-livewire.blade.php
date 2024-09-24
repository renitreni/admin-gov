<div class="flex justify-center">
    <div
        class="relative isolate overflow-hidden bg-gray-900 py-16 sm:py-24 lg:py-32 rounded-lg w-full lg:w-1/2 shadow-2xl">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div wire:loading>
                <div class="flex flex-row text-white font-bold w-full gap-2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="animate-spin size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </div>
                    <div>Loading...</div>
                </div>
            </div>
            @if (!$open)
                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2"
                    wire:loading.remove>
                    <div class="max-w-xl lg:max-w-lg">
                        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">OFW Reporting.</h2>
                        <p class="mt-4 text-lg leading-8 text-gray-300">Provide Passport no. and your PIN</p>
                    </div>
                    <dl class="grid grid-cols-1 gap-x-8 gap-y-8 lg:pt-2">
                        <div class="flex flex-col items-start gap-3 w-full">
                            <div>
                                <div class="flex flex-col text-white font-bold w-full">
                                    <label>Passport</label>
                                    <input type="text" required required wire:model='passport'
                                        class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                        placeholder="Enter Passport Keyword">
                                    @error('passport')
                                        <label class="text-red-500">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="flex flex-col text-white font-bold w-full mt-2">
                                    <label>PIN</label>
                                    <input type="password" required wire:model='pin'
                                        class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                        placeholder="Enter PIN Keyword">
                                    @error('pin')
                                        <label class="text-red-500">{{ $message }}</label>
                                    @enderror
                                </div>
                                <button type="submit" wire:click='showPanel'
                                    class="flex-none mt-3 rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                    Login
                                </button>
                                @error('authentication')
                                    <label class="text-red-500">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </dl>
                </div>
            @endif
            @if ($open)
                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 lg:max-w-none">
                    <dl class="grid grid-cols-1 gap-x-8 gap-y-8 lg:pt-2">
                        <div class="flex flex-col items-start gap-3" wire:loading.remove>
                            {{-- 
                            Report Details
                            lat and lang
                            --}}
                            <div class="flex flex-col w-full">
                                <div class="flex border border-gray-500 rounded-lg p-4 bg-white">
                                    <span class="relative flex h-3 w-3 mt-2">
                                        @if ($worker->agency->agency_status == 'good')
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                        @endif
                                        @if ($worker->agency->agency_status == 'warning')
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                                            <span
                                                class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                                        @endif
                                        @if ($worker->agency->agency_status == 'danger')
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                        @endif
                                    </span>
                                    </span>
                                    <div class="ml-2">
                                        <div class="flex flex-row">
                                            <h4 class="font-semibold text-base text-primary tracking-normal mr-2">
                                                {{ $worker->first_name }} {{ $worker->middle_name }}
                                                {{ $worker->last_name }}
                                            </h4>
                                            <p class="bg-blue-200 px-2 rounded-full border border-blue-500">
                                                {{ $worker->agency->agency_name }}
                                            </p>
                                        </div>
                                        <p class="text-sm font-normal text-gray tracking-normal">
                                            Passport No. {{ $worker->passport_number }}
                                        </p>
                                        <p class="text-sm font-bold text-gray tracking-normal">
                                            Emergency Contact
                                        </p>
                                        <p class="text-sm font-normal text-gray tracking-normal">
                                            <span class="font-semibold">Name</span>
                                            {{ $worker->emergency_contact_name }}
                                        </p>
                                        <p class="text-sm font-normal text-gray tracking-normal">
                                            <span class="font-semibold">Phone</span>
                                            {{ $worker->emergency_contact_phone }}
                                        </p>
                                        <p class="text-sm font-normal text-gray tracking-normal">
                                            <span class="font-semibold">Relationship</span>
                                            {{ $worker->emergency_contact_relationship }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col text-white font-bold w-full">
                                <label>Date Today</label>
                                <input type="date" required wire:model='dateReport'
                                    class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                            </div>
                            <div class="flex flex-col text-white font-bold w-full mt-2">
                                <label>Report Details</label>
                                <textarea type="text" required
                                    class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                        <div class="flex flex-row mt-2">
                            <button type="submit" wire:click='submitReport'
                                class="flex-none mr-2 rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Submit
                            </button>
                            <button type="submit" wire:click='cancelPanel'
                                class="flex-none rounded-md bg-gray-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                Cancel
                            </button>
                        </div>
                </div>
                </dl>
        </div>
        @endif
    </div>
    <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
        <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30"
            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
        </div>
    </div>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                $wire`${latitude},${longitude}`);
            });
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    </script>
</div>

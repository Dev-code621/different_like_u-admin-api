@extends('layouts.app')
<div>
    @include('partials.merchant-dash-header')
    <div class="flex font-poppins">
        @include('partials.merch-sidebar')
        <div class="min-h-screen flex-1">
            <div class="flex flex-col items-center justify-between w-3/4 mx-auto  pt-12">

                <h1 class="mb-8 text-4xl text-secondary-dark font-bold">{{$photoUrl ? 'Edit Verification Request' : 'Verify your Business'}}</h1>
                <div class="space-y-8 w-full flex flex-col mx-auto">
                    <div class="flex flex-col relative items-start"
                         x-data="{ search: $wire.entangle('search'), isOpen: false}">
                        <p x-show="search" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">
                            Business Name</p>
                        <input wire:model="search"
                               @input.debounce.10ms="isOpen = true"
                               class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                               placeholder="Enter your business name"/>
                    <!-- <div class="flex self-end"> @error('search') <span class="error mb-4 text-red-400">{{ $message }}</span> @enderror</div> -->
                        <div x-show="isOpen"
                             class="absolute top-16 bg-white rounded w-full shadow-2xl z-10">
                            <div class="max-h-64 flex-col overflow-y-scroll">
                                <div wire:loading class="flex w-full px-4 py-2 items-center hover:bg-gray-300">
                                    Loading...
                                </div>
                                <!-- <p>Loading</p> -->
                                @foreach($places as $key=>$place)
                                    <button x-on:click="$wire.addPlace({{$key}}); search='{{addslashes($place['name'])}}'; isOpen = false"
                                            class="flex w-full px-4 py-2 items-center hover:bg-gray-300">
                                        @if (isset($place['photos']))
                                            <img class="rounded h-12 cover w-12"
                                                 src="{{ 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photo_reference='.$place['photos'][0]['photo_reference'].'&key='.env('ADDRESS_AUTOCOMPLETE_API_KEY', SECRET_MANAGER_DATA['ADDRESS_AUTOCOMPLETE_API_KEY']??'') }}"/>
                                        @else
                                            <div class="rounded h-12 bg-gray-300 w-12"></div>
                                        @endif
                                        <div class="ml-4 flex flex-col items-start">
                                            <p class="text-sm font-bold mb-2">{{ $place['name'] }}</p>
                                            <p class="text-sm text-gray-600">{{ $place['formatted_address'] }}</p>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                            <div class="p-4 bg-gray-300 flex justify-between items-center rounded-b">
                                <div>
                                    <p class="text-sm font-bold mb-2">Nothing found? What about adding it to Google?</p>
                                    <p class="text-sm text-gray-700">Takes less than 5 minutes. 100% Free</p>
                                </div>
                                <a class="text-sm underline font-bold"
                                   href="https://business.google.com/create/new?gmbsrc=ww-ww-et-gs-z-gmb-v-z-h~bhc-core-u%7Cmybb">Add
                                    it here</a>
                            </div>
                        </div>
                        @error('search') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
                    </div>
                </div>
                @if (session()->has('error-message'))
                    <p class="alert alert-success mt-2 mb-2 text-center text-red-600"
                       id="alert">{{ session('error-message') }}</p>
                @endif
                @if (!isset($photo) && !isset($photoUrl))
                    <div class="flex w-full mb-4">
                        <div class="w-1/3 mr-4">
                            <p class="font-bold text-lg mb-2">Business Proof <sup
                                        class="font-bold text-red-error">*</sup>
                            </p>
                            <p class="mb-4">Please add <strong>1</strong> of the following documents:</p>
                            <ul class="list-disc text-gray-label mb-6 ml-6 space-y-2">
                                <li>Utility Bill
                                <li>EIN Number</li>
                                <li>Proof of Business Bank Account</li>
                                <li>Tax Return or K-1</li>
                                <li>Articles of Incorporation</li>
                                <li>Articles of Organization</li>
                                <li>Contract Agreements</li>
                                <li>Stock Certificates or Shares Ledgers</li>
                                <li>Purchase Orders</li>
                                <li>DBA (Doing Business As)</li>
                            </ul>
                        </div>
                        <label class="w-2/3 flex-grow-0 border-dashed border-2 rounded-lg border-gray-placehold flex flex-col items-center justify-center h-80"
                               x-data="drop_file_component()"
                               x-on:drop="dropingFile = false">
                            <form class="flex h-full overflow-hidden" wire:submit.prevent="save"
                                  x-on:drop.prevent="handleFileDrop($event)"
                                  x-on:dragover.prevent="dropingFile = true"
                                  x-on:dragleave.prevent="dropingFile = false">
                                <div class="flex flex-col items-center justify-center">
                                    <img class="w-10 h-10" src="{{asset('/images/camera.svg')}}"/>
                                    <p class="font-bold text-sm  text-gray-placehold">Drag your image here</p>
                                    <p class="text-xs  text-gray-placehold">or click to browse for a file</p>
                                    <div class="text-xs  text-gray-placehold" wire:loading wire:target="photo">
                                        Uploading...
                                    </div>
                                </div>
                                <input type="file" wire:model="photo" class="hidden">

                            </form>
                        </label>
                    </div>
                    <div class="flex self-end"> @error('photo') <span
                                class="error mb-4 text-red-400">{{ $message }}</span> @enderror</div>
                @else
                    <div class="flex border-2 rounded-lg w-full mb-4 mr-auto ">
                        <div class="w-1/3"><img class="object-contain p-8"
                                                src="{{ $photoUrl ?? $photo->temporaryUrl() }}"
                            /></div>
                        <div class="w-3/4 border-l-2 p-4 flex flex-col justify-center">
                            <p class="text-blue-secondary mb-2 truncate max-w-">{{$fileName}}</p>
                            <p class="text-gray-label"> {{$imageWidth}} x {{$imageHeight}} • {{$imageSize}}kb</p>
                            <div class="text-xs  text-gray-placehold" wire:loading wire:target="photo">Uploading...
                            </div>
                        </div>
                    </div>
                    <div class="inset-y-0 left-0 w-full">
                        <form class="flex h-full overflow-hidden" wire:submit.prevent="save">
                            <label for="file-upload"
                                   class="mr-auto border border-blue-secondary rounded-lg p-2 flex items-center text-blue-secondary font-bold mb-8">
                                <img class="mr-2"
                                     src="{{asset('/images/ph_arrows-counter-clockwise-bold.svg')}}"/>Replace
                            </label>
                            <input id="file-upload" type="file" wire:model="photo" class="hidden">
                        </form>
                    </div>
                @endif
                <div wire:submit.prevent="submit" class="flex w-full flex-col">
                    <form x-data="{ emailVal: '{{$email}}', phoneVal: '{{$phone}}' }">
                        <div class="flex flex-col relative items-start flex-1">
                            <p x-show="emailVal"
                               class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Business Email
                                Address</p>
                            <input x-model="emailVal"
                                   wire:model="email"
                                   class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                                   placeholder="Business Email"/>
                            @error('email') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col relative items-start flex-1">
                            <p x-show="phoneVal"
                               class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Phone
                                Number</p>
                            <input x-model="phoneVal"
                                   wire:model="phone"
                                   class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                                   placeholder="Business Phone Number"/>
                            @error('phone') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
                        </div>
                        <p class="mt-4 mb-8 text-center text-gray-400 text-center"><a target="_blank"
                                                                                      class="font-bold text-gray-600"
                                                                                      href="/terms-conditions">Terms &
                                Conditions</a> & <a target="_blank" class="font-bold text-gray-600"
                                                    href="https://www.differentlikeyouinc.com/privacy-policy">Privacy
                                Policy</a></p>
                        <p wire:loading wire:target="submitNewData"
                           class="alert alert-success mt-2 mb-2 text-center text-green-600" id="alert">Saving ...</p>
                        <p wire:loading wire:target="validateForm"
                           class="alert alert-success mt-2 mb-2 text-center text-green-600" id="alert">Validating
                            ...</p>
                        @if (session()->has('message'))
                            <p class="alert alert-success mt-2 mb-2 text-center text-green-600" id="alert"
                               x-data="{ show: true }" x-show="show"
                               x-init="setTimeout(() => show = false, 5000)">{{ session('message') }}</p>
                        @endif
                        @if (session()->has('error-message'))
                            <p class="alert alert-success mt-2 mb-2 text-center text-red-600" id="alert"
                               x-data="{ show: true }" x-show="show"
                               x-init="setTimeout(() => show = false, 50000)">{{ session('error-message') }}</p>
                        @endif
                        @if (!empty($business))
                            <div class="flex px-40">
                                <div class="pr-10 pt-1">
                                    <button type="button"
                                            class="bg-white w-72 flex-0 font-bold text-yellow-600 rounded px-6 py-4 outline outline-yellow-600/50">
                                        Cancel
                                    </button>
                                </div>
                                <div>
                                    <button wire:click="validateForm" type="button"
                                            class="new-request bg-yellow-600 w-72 flex flex-0 font-bold text-white rounded px-10 py-4">
                                        Submit New Request
                                        <img class=" ml-4 w-5 h-5 items-right" src="{{asset('/images/send.svg')}}"/>
                                    </button>
                                </div>
                            </div>
                        @else
                            <button wire:click="submitNewData" type="button"
                                    class="bg-yellow-600 w-full flex-0 font-bold text-white rounded px-6 py-4">
                                Submit Request
                            </button>
                    @endif
                    <!-- Button trigger modal -->
                        <!-- <button type="button"
                          class="bg-yellow-600 w-full flex-0 font-bold text-white rounded px-6 py-4"
                          id="showModal"
                          data-bs-toggle="modal" data-bs-target="#claimModalCenter">
                          Open Modal
                        </button> -->
                        <!-- Modal -->
                        <div wire:ignore.self
                             class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                             id="claimModalCenter" tabindex="-1" aria-labelledby="claimModalCenterTitle"
                             aria-modal="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
                                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-2 rounded-t-md">
                                        <button type="button"
                                                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body relative p-4 px-16 text-center">
                                        <div class="px-40 pb-9">
                                            <img class="w-12 h-12" src="{{asset('/images/alert.svg')}}"/>
                                        </div>
                                        <h5 class="text-xl pb-5 leading-normal text-gray-800 font-bold"
                                            id="claimModalScrollableLabel">
                                            You’re about to submit your request again
                                        </h5>
                                        <p class="text-gray-500 font-lighter pb-10">This will restart the verification
                                            process and delete your previously submitted request.</p>
                                    </div>
                                    <p wire:loading wire:target="submitData"
                                       class="alert alert-success mt-2 mb-2 text-center text-green-600" id="alert">
                                        Saving ...</p>
                                    @if (session()->has('message'))
                                        <p class="alert alert-success mt-2 mb-2 text-center text-green-600" id="alert"
                                           x-data="{ show: true }" x-show="show"
                                           x-init="setTimeout(() => show = false, 5000)">{{ session('message') }}</p>
                                    @endif
                                    @if (session()->has('error-message'))
                                        <p class="alert alert-success mt-2 mb-2 text-center text-red-600" id="alert"
                                           x-data="{ show: true }" x-show="show"
                                           x-init="setTimeout(() => show = false, 50000)">{{ session('error-message') }}</p>
                                    @endif
                                    <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end px-5 pb-5 rounded-b-md">
                                        <button wire:click="submitData" type="button"
                                                class="mb-5 bg-yellow-600 w-full flex-0 font-bold text-white rounded px-6 py-4">
                                            Delete Previous Request & Submit
                                        </button>
                                        <button type="button"
                                                class="bg-white w-full  flex-0 font-bold text-yellow-600 rounded px-6 py-4 outline outline-yellow-600/50"
                                                data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    </form>
                    <p class="mt-8 mb-8 mx-auto">Your business is already claimed by someone else?<span
                                class="font-bold text-orange-primary"><a href="mailto:support@differentlikeyouinc.com"> We can help </a></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@livewireScripts
<script type="text/javascript">

    function drop_file_component() {
        return {
            dropingFile: false,
            handleFileDrop(e) {
                if (event.dataTransfer.files.length > 0) {
                    const files = e.dataTransfer.files;
                @this.uploadMultiple('files', files,
                    (uploadedFilename) => {
                    }, () => {
                    }, (event) => {
                    }
                )
                }
            }
        };
    }

    window.addEventListener('claimModal', event => {
        console.log('Name updated to: ');
        window.livewire.emit('show');
    })
    document.addEventListener('livewire:load', () => {
        window.livewire.on('show', () => {
            $('#claimModalCenter').modal('toggle');
        });
    });
</script>

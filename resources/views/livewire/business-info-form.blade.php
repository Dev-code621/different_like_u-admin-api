<div class="items-center">
	<h1 class = "mb-4 text-4xl">Edit Business Info</h1>
          <p class="tracking-tight leading-6 text-xl">Review and confirm your information so that customers can find you.</p>
</div>
<div class="mt-12">
	<form wire:submit.prevent="save" enctype="multipart/form-data">
		<div class="md:space-y-2 mb-6">
			<label class="text-2xl font-bold text-blueGray-600 py-2 bg-white font-bold z-10">Cover picture</label>
			<input type="input" id="blob-file" class="blob-file">
			<div class="grid grid-cols-1 space-y-2">
	            <div x-data="showImage()" class="flex items-center justify-center w-full" x-on:drop="dropingFile = false" x-on:drop.prevent="handleFileDrop($event)" x-on:dragover.prevent="dropingFile = true" x-on:dragleave.prevent="dropingFile = false">
	                <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-full p-10 group text-center">
	                    <div class="h-full w-full text-center flex flex-col items-center justify-center items-center">
	                        <div class="flex mx-auto">
								@if ($file)
									<img src="{{ $file->temporaryUrl() }}" id="preview" class="inset-0 w-full h-full">
							    @elseif ($this->image)
									<img id="preview" class="inset-0 w-full h-full" src="{{
										$this->image }} ">
							    @endif
		                        <img class="has-mask h-6 object-center" src="images/bw_camera.svg" alt="upload image">
		                        <input type="file" class="hidden" accept="image/*" name="files" wire:model.defer="file"/>
	                        </div>
	                        <div class="text-xs  text-gray-placehold" wire:loading wire:target="file">Uploading...</div>
	                    </div>
	                </label>
	           </div>
	               @error('file') <span class="error font-semibold text-red-900">{{ $message }}</span> @enderror
            </div>
		</div>
		<div class="md:flex flex-row md:space-x-4 w-full mb-6">
			<div class="mb-3 space-y-2 w-full text-xs">
				<label class="text-2xl font-bold text-blueGray-600 py-2">Business Name</label>
				<input placeholder="Business Name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="business_name" id="business_name" wire:model="business_name" readonly="true">
				@error('business_name') <span class="error font-semibold text-red-900">{{ $message }}</span> @enderror
			</div>
		</div>
		<div class="md:flex flex-row md:space-x-4 w-full mb-6">
			<div class="mb-3 space-y-2 w-full text-xs">
				<label class=" text-2xl font-bold text-blueGray-600 py-2">About</label>
				<textarea name="about" id="about" class="w-full min-h-[100px] max-h-[300px] h-28 appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg  py-4 px-4" placeholder="About your business" spellcheck="false" wire:model.defer="about"></textarea>
				@error('about') <span class="error font-semibold text-red-900">{{ $message }}</span> @enderror
			</div>
		</div>
		<div class="md:flex flex-row md:space-x-4 w-full mb-6">
			<div class="mb-3 space-y-2 w-full text-xs">
				<label class="text-2xl font-bold text-blueGray-600 py-2">Link #1 - URL</label>
				<input placeholder="i.e: Your Website, Social Media" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="link_one" id="link_one" wire:model.defer="link_one">
				@error('link_one') <span class="error font-semibold text-red-900">{{ 'The Link #1 field is required.' }}</span> @enderror
			</div>
		</div>
		<div class="md:flex flex-row md:space-x-4 w-full mb-6">
			<div class="mb-3 space-y-2 w-full text-xs">
				<label class="text-2xl font-bold text-blueGray-600 py-2">Link #2 - URL</label>
				<input placeholder="i.e: Online Menu, Product List, etc." class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="link_two" id="link_two" wire:model.defer="link_two">
			</div>
		</div>
		<div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-green-600">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
		<div class="mt-5 text-center md:space-x-3 md:block flex flex-col-reverse">
			<button class="bg-yellow-600 w-full flex-0 font-bold text-white rounded-2xl	px-6 py-4 h-16 text-2xl">Apply Changes</button>
		</div>
		<p class="text-base text-gray-400 text-left mt-8">Disclaimer/Privacy Policy/Terms & Conditions placeholder et sem ut a ut. Enim eu in pellentesque pretium sed orci, nunc, sed. Porttitor blandit.</p>
	</form>
</div>

<script>
function showImage() {
    return {
		// showPreview(file) {
		// 	// console.log(file);
  //           var src = URL.createObjectURL(file);
  //           var preview = document.getElementById("preview");
  //           var blob = document.getElementById("blob-file");
  //           blob.value = src;
  //           preview.src = blob.value;
  //           preview.style.display = "block";
  //       },
        browsePreview(event) {
            if (event.target.files.length > 0) {
				var file = event.target.files[0];
                //this.showPreview(file);
            }
        },
		dropingFile: true,
		handleFileDrop(event) {
			if (event.dataTransfer.files.length > 0) {
				const files = event.dataTransfer.files;
				@this.uploadMultiple('file', files,
				    (uploadedFilename) => {}, () => {}, (event) => {}
				)
			}
		}
    };
}
</script>

<div x-data class="flex flex-col items-center justify-center h-full">
    <div class="flex p-2 border-2 rounded-lg items-center mb-2">
        <img class="w-20 h-20 object-cover rounded-lg mr-4" src="https://i.pravatar.cc/300"/>
        <div class="flex flex-col justify-between mr-6">
            <div>
                <p class="text-secondary-dark font-bold mb-2">Akira Seabright</p>
                <p class="text-xs text-gray-label">Restaurant</p>
            </div>
            <p class="text-gray-600 text-sm">317 Ventura Drive, Santa Cruz California</p>
        </div>
        <div class="flex justify-between bg-orange-primary rounded-xl px-3 py-2 w-18 box-content mr-4">
            <img class="mr-2" src="{{asset('images/Star.svg')}}"/>
            <p class="text-white font-bold text-lg">4.8</p>
        </div>
    </div>
    <p class="text-lg text-gray-label text-md mb-8">Not your business? <a class="font-bold">Search for a different
            business</a></p>
    <div class="flex flex-col items-center" x-show="$wire.emailSuccess === false">
        <p class="text-secondary-dark text-4xl font-bold mb-8">Almost there! Complete the verification process</p>
        <div class="flex p-4 border-2 rounded-lg items-center mb-2">
            <img class="mr-4" src="{{asset('images/email.svg')}}"/>
            <div class="flex flex-col justify-between mr-6">
                <div>
                    <p class="text-secondary-dark font-bold mb-2">Email me at:</p>
                    <p class="text-xs text-gray-label">Be will sent you a link to your registred email on Google to
                        verify
                        your account</p>
                </div>
                <p class="text-gray-600 text-sm mb-2">317 Ventura Drive, Santa Cruz California</p>
                <div class="flex items-center space-x-2">
                    <input
                            class="px-3 py-3 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                            placeholder="email address"/>
                    <p class="font-bold">@sushirestaurant.com</p>
                    <button x-on:click="$wire.email()"
                            class="flex justify-between bg-orange-primary rounded-xl px-6 py-2 w-18 box-content cursor-pointer">
                        <p class="text-white font-bold text-lg">Send</p>
                    </button>
                </div>
            </div>
        </div>
        <p class="text-gray-label mt-8 w-1/2 leading-normal">Disclaimer/Privacy Policy/Terms & Conditions placeholder et
            sem
            ut a ut. Enim eu in pellentesque pretium sed orci, nunc, sed. Porttitor blandit.</p>
    </div>
    <div class="flex flex-col items-center w-1/2" x-show="$wire.emailSuccess">
        <p class="text-secondary-dark text-4xl font-bold mb-8">Email Sent, check your inbox</p>
        <p class="text-gray-600 mb-8 text-center">To finish claiming Sushi Example, please click on the verification link that was
            emailed to: <span class="font-bold">iamtheowner@sushirestaurant.com</span></p>
        <button
                class="flex justify-between bg-orange-primary rounded-xl px-10 py-2 box-content cursor-pointer">
            <p class="text-white font-bold text-md">Resend Verification Email</p>
        </button>
    </div>

</div>

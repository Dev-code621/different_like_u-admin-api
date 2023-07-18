@extends('layouts.app')
@include('partials.merchant-dash-header')
<div class="flex min-h-screen">
    @include('partials.merch-sidebar')
    <div class="p-8 font-poppins" style="width: calc(100% - 16rem)">
        <h1 class="mb-4 text-4xl text-secondary-dark font-bold">Welcome {{Auth::user()->name}}!</h1>
        <p class="mb-8">Check out our resources to help you become a more inclusive business owner.</p>
        <div class="flex space-x-4 mb-8 w-full overflow-x-scroll scroll-items">
            @if(!App\BusinessProof::where('user_id', Auth::id())->first())
                <x-dash-resource
                        disabled="0"
                        header="Verify your Business"
                        subhead="Provide up to date information so that consumers know how to find you."
                        link="/merchant-claim"></x-dash-resource>
            @endif
            @if($claimStatus === 'Pending')
                <x-dash-resource
                        disabled="0"
                        header="Claim Request Sent"
                        subhead="Our team is analyzing the request you submitted to verify your business. We will contact you shortly."
                        link="/merchant-claim"></x-dash-resource>
            @elseif($claimStatus === 'Rejected')
            <x-dash-resource
                        disabled="0"
                        header="Claim Request has been Rejected"
                        subhead="{{$reason}}. "
                        link="/merchant-claim"></x-dash-resource>
            @endif
            <x-dash-resource
                    disabled="{{$claimStatus === 'Pending' || $claimStatus === 'Unclaimed' || $claimStatus === 'Rejected' }}"
                    header="Edit your Business Profile"
                    subhead="Provide up to date information so that consumers know how to find you."
                    link="/business-edit-page"></x-dash-resource>
            <x-dash-resource disabled="{{$claimStatus === 'Pending' || $claimStatus === 'Unclaimed' || $claimStatus === 'Rejected' }}"
                            header="Reply to your Reviews"
                             subhead="Let consumers know that you value their feedback"
                             link="/merchant-dash/business"></x-dash-resource>
            <x-dash-resource disabled="0"
                             header="Contact Us"
                             subhead="For questions about your account and our specialized service offerings."
                             link="mailto:support@differentlikeyouinc.com"></x-dash-resource>
        </div>
        <livewire:merchant-reviews-compact :claimStatus="$claimStatus" :reason="$reason"/>
        <div class="flex justify-between mt-8 space-x-10">
            <x-learning-resources/>
            <livewire:merchant-metrics/>
        </div>
    </div>
</div>

<style type="text/css">
/*.scroll-items:hover {
  overflow-x: scroll;
}*/

/*.scroll-items {
  width: 240px;
  height: 200px;
  overflow-y: scroll;
  background-color: #f6f6f6;
}*/
.scroll-items::-webkit-scrollbar {
  background-color: transparent;
  width: 0px;
}

.scroll-items:hover::-webkit-scrollbar {
  width: 8px;
}
.scroll-items:hover::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.2);
}

@media (hover: none) {
  .scroll-items::-webkit-scrollbar {
    width: 8px;
  }
  .scroll-items::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.2);
  }
}

.cursor-allowed .border-gray-line:hover{border-color:#004878}
</style>
<script type="text/javascript">
    const scrollContainer = document.querySelector(".scroll-items");

    scrollContainer.addEventListener("wheel", (evt) => {
        evt.preventDefault();
        scrollContainer.scrollLeft += evt.deltaY;
    });
</script>

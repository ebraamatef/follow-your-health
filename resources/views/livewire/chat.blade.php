
<div wire:poll >
    <div id="chat" class="col d-flex flex-column p-3 mb-3" style="height: 500px; overflow:scroll">
        @foreach($messages as $message)
            @if(Auth::user()->type == "patient")
                @if($message->sender == Auth::user()->id)
                <div class="justify-content-end">
                    <div class="float-end p-3 primary_color text-white text-end rounded-3 mb-2 col-auto mw-100">{{ $message->message }}</div>
                </div>
                @else
                    <div class="justify-content-end">
                        <div class="float-start p-3 greybg_color text-dark rounded-3 mb-2 col-auto mw-100">{{ $message->message }}</div>
                    </div>
                @endif
            @elseif(Auth::user()->type == "doctor")
                @if($message->sender == Auth::user()->id)
                <div class="justify-content-end">
                    <div class="float-end p-3 primary_color text-white text-end rounded-3 mb-2 col-auto mw-100">{{ $message->message }}</div>
                </div>
                @else
                    <div class="justify-content-end">
                        <div class="float-start p-3 greybg_color text-dark rounded-3 mb-2 col-auto mw-100">{{ $message->message }}</div>
                    </div>
                @endif
            @else
                @if($message->sender == Auth::user()->id)
                <div class="justify-content-end">
                    <div class="float-end p-3 primary_color text-white text-end rounded-3 mb-2 col-auto mw-100">{{ $message->message }}</div>
                </div>
                @else
                    <div class="justify-content-end">
                        <div class="float-start p-3 greybg_color text-dark rounded-3 mb-2 ">{{ $message->message }}</div>
                    </div>
                @endif
            @endif
         @endforeach
    </div>
    
    <div>
        <form id="form" wire:submit.prevent = "sendMessage" class="row">
            <div class="col-8 col-md-10">
                <input id="inpt" class="col-auto form-control" wire:model.defer="messageText" type="text" autocomplete="off" placeholder="Type your message here.." required>
            </div>
            <div class="col-4 col-md-2">
                <button onclick="setTimeout(function () {
                    scrollDown()
                  }, 200)" id="sbmt" class="col-auto form-control btn btn-primary primary_color primary_color_border">Send</button>
            </div>
            
        </form>
    </div>
</div>

<script>
    function scrollDown() {
        document.getElementById('chat').scrollTop =  document.getElementById('chat').scrollHeight;
    }
    
    window.onload = scrollDown;

    // $(document).ready(function(){
    //     $("#sbmt").click(function(){
    //         $('#form').sumbit();
    //         $('#inpt, textarea').val('');
    //     });
    // }); 

</script>
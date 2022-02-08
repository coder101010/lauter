@extends('layouts.app')

@section('content')
<div class="c-App container">
    <div class="c-Composer">
        <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
    </div>
    <div class="c-Feed">
        <chat-messages :messages="messages" :userid="{{ Auth::user()->id }}"></chat-messages>
    </div>
</div>
<div class="c-Footer">
    &#169; Lauter <?php echo date("Y");?> | Icons by svgrepo.com
</div>
@endsection

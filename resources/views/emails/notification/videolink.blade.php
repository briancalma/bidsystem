@component('mail::message')
# Congratulation!

Good Day! 
You're bidding proposal is been approved by our organization. 
Click the button below to go the bidding video chat session. 

{{-- @component('mail::button', ['url' => $video_link])
Proceed To Video Chat
@endcomponent --}}

<a href="{{$video_link}}">Click Here to Go to video chat bidding session.</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

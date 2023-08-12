<x-mail::message>
{{-- #  New Published Post: {{ $postTitle }}

Dear Subscriber,

We are pleased to inform you about a new post that has been published on our website:

**Post Title:** {{$postTitle}} <br/>

@component('mail::button', ['url' => url($postUrl)])
Read Post
@endcomponent

Stay updated with our latest posts and news by visiting our website.

If you no longer wish to receive notifications, you can unsubscribe:

[Unsubscribe]({{ url($unsubscribeUrl) }}) --}}


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

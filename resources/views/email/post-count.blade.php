<x-mail::message>
# Post Count

You have {{ $postCount }} posts on your database

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

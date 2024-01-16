<x-mail::message>
# Hello Freind This New Job In {{ env('APP_NAME') }}

@foreach($jobs as $job)
    {{ $job->title }}
    {{ number_format($job->salary) }}
@endforeach

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<x-mail::message>
# Hi, {{ $firstName }}

Here's your temporary password. Please update it upon your first login.

# {{ $password }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

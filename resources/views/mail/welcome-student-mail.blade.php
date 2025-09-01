<x-mail::message>
# Welcome to {{ config('app.name') }}

We are excited to have you on board!

Here are your login details:

- Email: {{ $user->email }}<br>
- Password: {{ $password }}<br>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

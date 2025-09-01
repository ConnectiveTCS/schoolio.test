<x-mail::message>
# Welcome to {{ config('app.name') }}

We're excited to have you on board!

Here are your login details:

- **Email:** {{ $user->email }}
- **Password:** {{ $password }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<x-mail::message>
Hi,

You have been added to Schoolio.

Here are your login details:

Email: {{ $user->email }}
Password: {{ $password }}

<x-mail::button :url="route('login')">
Login to your account
</x-mail::button>

Thanks,<br>
</x-mail::message>

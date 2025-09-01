<x-mail::message>
    # Welcome to {{ config('app.name') }} - Parent Portal

    Dear {{ $user->name }},

    We are excited to welcome you to our school management system! You have been registered as a parent/guardian for
    {{ $student ? $student->name : 'your student' }}.

    ## Your Login Details

    Please use the following credentials to access the parent portal:

    - **Email:** {{ $user->email }}
    - **Temporary Password:** {{ $password }}

    <x-mail::button :url="url('/')">
        Access Parent Portal
    </x-mail::button>

    ## Important Notes

    - Please change your password after your first login for security purposes
    - You can view your student's academic progress, attendance, and communicate with teachers through the portal
    - Keep your login credentials secure and do not share them with others

    If you have any questions or need assistance, please don't hesitate to contact our school administration.

    Thanks,<br>
    {{ config('app.name') }} Team
</x-mail::message>

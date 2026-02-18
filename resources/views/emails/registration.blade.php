
@component('mail::message')
# Welcome, {{ $user->name }} 🎉

Thanks for registering at **ReadVault**. We’re excited to have you.

@component('mail::button', ['url' => url('/')])
Visit ReadVault
@endcomponent

Thanks,<br>
The ReadVault Team
@endcomponent

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">

    <table align="center" width="600" cellpadding="0" cellspacing="0"
        style="background: #ffffff; border-radius: 8px; overflow: hidden;">
        <!-- Header -->
        <tr style="background: #4F46E5;">
            <td align="center" style="padding: 20px;">
                <img src="{{ asset('customer/assets/images/logo-d.png') }}" alt="Logo"
                    style="display:block; max-width: 150px;">
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 30px; color: #333;">
                <h1 style="margin: 0 0 15px;">Hello {{ $user->name }} 🎉</h1>
                <p style="margin: 0 0 20px; font-size: 16px; line-height: 1.5;">
                    Welcome to <strong>{{ config('app.name') }}</strong>!
                    We’re really excited to have you join us.
                </p>

                <p style="margin: 0 0 30px; font-size: 15px;">
                    Explore your account and start enjoying our services.
                </p>

                <a href="{{ $user->role == 'customer' ? route('customer.dashboard') : route('vendor.dashboard') }}"
                    style="background: #4F46E5; color: #fff; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-size: 16px;">
                    Go to Dashboard
                </a>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" style="background: #f0f0f0; padding: 15px; font-size: 13px; color: #666;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>

</body>

</html>

@component('mail::message') #

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
       style="max-width:670px;text-align:center; @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap'); font-family: 'Poppins', sans-serif;">
    <tr>
        <td align="center">
            <h1 style="color:#023252; font-weight:800; margin:0;font-size:32px;font-family: 'Poppins', sans-serif; font-size: 30px; line-height: 34px; margin-bottom:30px;text-align: center;">
                Email Verification</h1>
            <p style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;">
                To complete email verification, please click the verify button below.</p>
            <a href="{{ $url }}"
               style="text-decoration:none !important; font-weight:500; padding:15px 5px; margin-top:35px; color:#fff; background: #D87860;border-radius: 12px; text-align: center; font-family: 'Poppins', sans-serif; font-weight:600; display: block; max-width: 300px; width:100%;">Verify
                your email</a>
            <p style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;">
                Or verify using this link:
            </p>
            <p style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;">
                <a href="{{ $url }}"
                   style="text-align: center;color: #D87860;font-family: 'Poppins', sans-serif; font-weight: 600; text-decoration: auto;line-height:18px; overflow-wrap: break-word; word-wrap: break-word; -ms-word-break: break-all;word-break: break-all; word-break: break-word;-ms-hyphens: auto;-moz-hyphens: auto;-webkit-hyphens: auto;hyphens: auto;">
                   {{ $url }}</a>
            </p>
            <h2 style="text-align: center; font-family: 'Poppins', sans-serif; font-weight:600; font-size: 22px; color:#023252;line-height: 24px;margin-top: 30px;">
                This link is valid for one use only. It will expire in 2 hours.</h2>
            <p style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;">
                If you didn’t request this password reset or you received this message in error, please disregard this
                email.</p>
        </td>
    </tr>
</table>
@endcomponent

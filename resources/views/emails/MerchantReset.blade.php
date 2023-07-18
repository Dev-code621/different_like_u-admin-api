@component('mail::message') #



<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;text-align:center; @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap'); font-family: 'Poppins', sans-serif;">
                                <tr>
                                    <td align="center">
                                        <h1 style="color:#023252; font-weight:800; margin:0;font-size:32px;font-family: 'Poppins', sans-serif; font-size: 30px; line-height: 34px; margin-bottom:30px;text-align: center;">Password Reset Information</h1> <a href="{{$body['url']}}" style="text-decoration:none !important; font-weight:500; padding:15px 5px; margin-top:35px; color:#fff; background: #D87860;border-radius: 12px; text-align: center; font-family: 'Poppins', sans-serif; font-weight:600; display: block; max-width: 300px; width:100%;">Reset Your Password</a> 
                                        <p style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;"> After you click the button above, you’ll be prompted to complete the following steps: </p>
                                        <ul style="padding:0;">
                                            <li style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:10px; font-family: 'Poppins', sans-serif; list-style-type:none;">1. Enter new password.</li>
                                            <li style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:10px; font-family: 'Poppins', sans-serif; list-style-type:none;">2. Confirm your new password.</li>
                                            <li style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:10px; font-family: 'Poppins', sans-serif; list-style-type:none;">3. Hit “Reset Password” to submit</li>
                                        </ul>
                                        <h2 style="text-align: center; font-family: 'Poppins', sans-serif; font-weight:600; font-size: 22px; color:#023252;line-height: 24px;margin-top: 30px;">This link is valid for one use only. It will expire in 2 hours.</h2>
                                        <p style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;">If you didn’t request this password reset or you received this message in error, please disregard this email.</p>
                                    </td>
                                </tr>
</table>
@endcomponent

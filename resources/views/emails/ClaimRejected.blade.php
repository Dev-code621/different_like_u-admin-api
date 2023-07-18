@component('mail::message') #



<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;text-align:center; @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap'); font-family: 'Poppins', sans-serif;">
                                <tr>
                                    <td align="center">
                                        <h1 style="color:#023252; font-weight:800; margin:0;font-size:32px;font-family: 'Poppins', sans-serif; font-size: 30px; line-height: 34px; margin-bottom:30px;text-align: center;">Your Sacki Business Verification Request Was Rejected!</h1> 
                                        <p style="text-align: left; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;"> Your Sacki Business Verification Request was rejected for {{ $body['reject_reason'] }}. Please login to the Sack Merchant dashboard to resubmit your request. </p>
                                        <!--  -->
                                        <a href="{{ $body['merchant_url'] }}" style="text-decoration:none !important; font-weight:500; padding:15px 5px; margin-top:35px; color:#fff; background: #D87860;border-radius: 12px; text-align: center; font-family: 'Poppins', sans-serif; font-weight:600; display: block; max-width: 300px; width:100%;">Log In <span></span></a>
                                    </td>
                                </tr>
</table>
@endcomponent

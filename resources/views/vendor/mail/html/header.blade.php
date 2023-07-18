<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;text-align:center; @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap'); font-family: 'Poppins', sans-serif;">
                                <tr>
                                    <td style="padding:10px;"  align="center">
                                       <a href="{{ $url }}" style="display: inline-block;">
                                           
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" width="253" class="logo" alt="Laravel Logo" style="height: auto !important;max-height: initial !important;width: 253px !important;">
@else
{{ $slot }}
@endif
</a>
                                        <p style="text-align: center !important;"><span style="text-align: center; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;">Need help?</span><span> <a href="mailto:support@differentlikeyouinc.com" style="text-align: center;color: #D87860;font-family: 'Poppins', sans-serif; font-weight: 600; text-decoration: auto;">Contact us.</a></span></p>
                                        
                                    </td>
                                </tr>
</table> 
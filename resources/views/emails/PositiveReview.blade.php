@component('mail::message') #



<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;text-align:center; @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap'); font-family: 'Poppins', sans-serif;">
                                <tr>
                                    <td align="center">
                                        <h1 style="color:#023252; font-weight:800; margin:0;font-size:32px;font-family: 'Poppins', sans-serif; font-size: 30px; line-height: 34px; margin-bottom:30px;text-align: center;">Congrats! 
                                        You got a new review!</h1> <a href="javascript:void(0);" style="text-decoration:none !important; font-weight:500; padding:15px 5px; margin-top:35px; color:#fff; background: #D87860;border-radius: 12px; text-align: center; font-family: 'Poppins', sans-serif; font-weight:600; display: block; max-width: 134px; width:100%; font-size: 28px;">
                                        <svg width="27" height="27" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="-webkit-transform: translate(0px,2px);">
                                        <path d="M6.87459 1.88881C7.08843 1.37656 7.81415 1.37656 8.02798 1.88881L9.39894 5.17296C9.4844 5.37768 9.67199 5.52174 9.89182 5.5515L13.5236 6.04304C14.0653 6.11636 14.2584 6.80086 13.8349 7.1465L11.0381 9.42871C10.8536 9.57931 10.7707 9.82172 10.8244 10.0538L11.7181 13.9157C11.8473 14.4741 11.2194 14.8973 10.7502 14.5681L7.8103 12.5047C7.59484 12.3534 7.30773 12.3534 7.09228 12.5047L4.15231 14.5681C3.68317 14.8974 3.05524 14.4741 3.18446 13.9157L4.07808 10.0538C4.13178 9.82172 4.04889 9.57931 3.86435 9.42872L1.06769 7.14649C0.644131 6.80085 0.837232 6.11636 1.37898 6.04304L5.01075 5.5515C5.23059 5.52174 5.41817 5.37768 5.50363 5.17296L6.87459 1.88881Z" fill="white" stroke="white" stroke-width="1.66648" stroke-miterlimit="3.3292" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        {{ $body['overall_score'] }}</a>
                                        <p style="text-align: left; color:#6E8791; font-size:15px;line-height:24px; margin-top:30px; font-family: 'Poppins', sans-serif;">Another customer has recognized your efforts to create inclusive experiences! </p>
                                        <a href="{{ $body['review_url'] }}" style="text-decoration:none !important; font-weight:500; padding:15px 5px; margin-top:35px; color:#fff; background: #D87860;border-radius: 12px; text-align: center; font-family: 'Poppins', sans-serif; font-weight:600; display: block; max-width: 300px; width:100%;">Read Review & Reply <span></span></a>
                                    </td>
                                </tr>
</table>
@endcomponent

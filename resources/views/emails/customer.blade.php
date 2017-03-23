<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
        <title>Ceek - Order Confirmed</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <style type="text/css">
            
            body{
                width: 100%; 
                background-color: #fff; 
                margin:0; 
                padding:0; 
                -webkit-font-smoothing: antialiased;
                mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;
            }

            p,h1,h2,h3,h4,h5,h6{
                margin-top:0;
                margin-bottom:0;
                padding-top:0;
                padding-bottom:0;
            }
            a {
                text-decoration: none;
                color: #6e6e6e;
            }
            html{
                width: 100%; 
            }

            table{
                border: 0;
            }            
            @media only screen and (max-width: 640px){       
                body[yahoo] .container590{width: 480px !important;}
                body[yahoo] .container580{width: 420px !important;}
                body[yahoo] .container570{width: 418px !important;}
                body[yahoo] .container560{width: 390px !important;}
            }            
            @media only screen and (max-width: 479px){
                body[yahoo] .container590{width: 280px !important;}
                body[yahoo] .container580{width: 270px !important;}
                body[yahoo] .container570{width: 269px !important;}
                body[yahoo] .container560{width: 250px !important;}
                body[yahoo] .container550{width: 269px !important;}

                body[yahoo] .thank {font-size: 30px !important;}
                body[yahoo] .your {font-size: 24px !important;}
                body[yahoo] .ship {font-size: 14px !important;}
            }
        </style>
    </head>
    
    <body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">        
        <!-- ======= container ======= -->
        <table border="0" align="center" width="600" cellpadding="0" cellspacing="0" class="container590">
            <!-- ======= header ======= -->
            <tr>
                <td height="16" style="background-color: #3333ff;" align="center" valign="middle"></td>
            </tr>
            <tr>
                <td height="120" valign="middle">                    
                    <table border="0" align="center" width="490" cellpadding="0" cellspacing="0" class="container580">                       
                        <tr>
                            <td align="left" valign="middle" width="50%">
                                <img src="{{ url('/public/ceek-v3/img/email/ceek-logo.png') }}" alt="Ceek" />
                            </td>
                            <td align="right" valign="middle" width="50%" style="font-family: Open Sans, Arial; font-size:14px; color:#6e6e6e;">
                                <p><strong>CEEK CONTACT INFORMATION</strong></p>
                                <p>(877) 407-9797</p>
                                <p>M-F 9am - 6pm EST</p>
                                <p><a href="mailto:support@ceek.com">support@ceek.com</a></p>
                            </td>
                        </tr>                   
                    </table>
                </td>
            <tr>
                <td height="160" style="background: url( {{ url('/public/ceek-v3/img/email/frame.jpg') }} ) center no-repeat; font-family: Open Sans, Arial; color:#fff;" align="center" valign="middle">
                    <p style="font-size:42px; font-weight:800;" class="thank">THANKS</p>
                    <p style="font-size:24px; font-weight:800;" class="your">FOR YOUR PURCHASE!</p>
                    <p style="font-size:16px; font-weight:600;" class="ship">We will ship your item out to you right away.</p>
                </td>
            </tr>
            <!-- ======= order number ======= -->
            <tr>
                <td align="center" height="100">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" valign="middle" style="font-family: Open Sans, Arial; font-size:18px; color:#fff; border:2px solid #3333ff; color:#3333ff; padding:10px">
                                <?php 
                                    $num = 6 - strlen($order);
                                    $zeros = '';
                                    if (strlen($order) < $num) {
                                        for ($i = 0; $i < $num; $i++){
                                            $zeros = $zeros . '0';
                                        }
                                    }
                                ?>
                                <p><strong>ORDER NUMBER: <?php echo $zeros?>{{ $order }}</strong></p> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- ======= main content ======= -->
            <tr>
                <td align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="490" class="container580">
                        <tr>
                            <td align="center">
                                <table border="0" cellpadding="0" cellspacing="0" width="221" class="container570" align="left">
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="25">
                                                        <img src="{{ url('/public/ceek-v3/img/email/icon-product.png') }}" />
                                                    </td>
                                                    <td style="font-family: Open Sans, Arial; font-size:15px; color:#2a2a2a;">
                                                        <strong>PRODUCT</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10" colspan="2" style="border-bottom:2px solid #333;"></td>
                                                </tr>
                                                <tr>
                                                    <td height="10" colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-family: Open Sans, Arial; color:#2a2a2a;">
                                                        <p style="font-size:14px">{{ $product }}</p>
                                                        <p style="font-size:11px">{{ $details }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="25">
                                                        <img src="{{ url('/public/ceek-v3/img/email/icon-balance.png') }}" />
                                                    </td>
                                                    <td style="font-family: Open Sans, Arial; font-size:15px; color:#2a2a2a;">
                                                        <strong>TOTAL</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10" colspan="2" style="border-bottom:2px solid #333;"></td>
                                                </tr>
                                                <tr>
                                                    <td height="10" colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-family: Open Sans, Arial; font-size:14px; color:#6e6e6e;">
                                                        <p>{{ $price }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30"></td>
                                    </tr>
                                </table>
                                <!-- ====== second column ====== -->
                                <table border="0" cellpadding="0" cellspacing="0" width="221" class="container570" align="right">
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="25">
                                                        <img src="{{ url('/public/ceek-v3/img/email/icon-shipping.png') }}" />
                                                    </td>
                                                    <td style="font-family: Open Sans, Arial; font-size:15px; color:#2a2a2a;">
                                                        <strong>SHIPPING INFORMATION</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10" colspan="2" style="border-bottom:2px solid #333;"></td>
                                                </tr>
                                                <tr>
                                                    <td height="10" colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-family: Open Sans, Arial; font-size:11px; color:#6e6e6e; font-weight:600;">
                                                        <p>{{ $name }}</p>
                                                        <p>{{ $address }}</p>
                                                        <p>{{ $city }}</p>
                                                        <p>{{ $zipcode }}</p>
                                                        <p>{{ $country }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="25">
                                                        <img src="{{ url('public/ceek-v3/img/email/icon-payment.png') }}" />
                                                    </td>
                                                    <td style="font-family: Open Sans, Arial; font-size:15px; color:#2a2a2a;">
                                                        <strong>PAYMENT INFORMATION</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10" colspan="2" style="border-bottom:2px solid #333;"></td>
                                                </tr>
                                                <tr>
                                                    <td height="10" colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-family: Open Sans, Arial; font-size:11px; color:#6e6e6e;">
                                                        <p>Card number: XXXX XXXX XXXX {{ $lastfourDigit }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- ======= footer ======= -->
            <tr>
                <td style="background-color: #3333ff;" height="120" align="center">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" valign="middle" style="font-family: Open Sans, Arial; font-size:16px; color:#fff;" colspan="2">
                                <p><strong>Download the CEEK App for iOS and Android</strong></p>
                            </td>
                        </tr>
                        <tr><td colspan="2" height="15"></td></tr>
                        <tr>
                            <td width="50%" align="right">
                                <a href="https://itunes.apple.com/us/app/ceek-virtual-reality/id1169054349?mt=8">
                                    <img src="{{ url('/public/ceek-v3/img/email/ios-logo.png') }}" />
                                </a>
                            </td>
                            <td width="50%" align="left">
                                <a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en">
                                    <img src="{{ url('/public/ceek-v3/img/email/android-logo.png') }}" />
                                </a>                                
                            </td>
                        </tr>
                    </table>                                
                </td>
            </tr>
            <tr>
                <td height="16" style="background: url( {{ url('/public/ceek-v3/img/email/frame.jpg') }} ) center no-repeat;"></td>                            
            </tr>
        </table> 
    </body>
</html>
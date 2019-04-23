<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mail</title>
<style type="text/css">

body{background-color:#1F1F1F}
</head>
<body>
</style>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<table width="830" height="577" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#666666">
  <tr>
    <td width="820" height="577">
	<table width="622" height="453" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top:20px; ">
  <tr>
    <td height="96" align="center" bgcolor="#000000"><img src="https://redchillinorthallerton.co.uk/public/layouts/img/logo.png" alt="Redchilli" width="293" height="83" /></td>
  </tr>
  <tr>
    <td height="323" align="center">
      <table width="571" height="379" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-left: none;border-right: none;">
      <tr style="border-style: none;">
        <td height="47" colspan="3" style="border-style: none;"><span style='color: #353535;font-size: 18px;font-family: Georgia, "Times New Roman", Times, serif;'>Your order has been received and is now being process.Your order details are shown below for your reference </span></td>
        </tr>
      <tr style="border-style: none;">
        <td height="44" colspan="2" style="border-style: none;"><span style="font-size: 24px;font-weight: bold;">Order:# ORD-{{ $data['id'] }}</span></td>
		    <td align="center" style="border-style: none;"><span style="font-weight: bold;">Type: {{ $data['type'] }}</span></td>
        </tr>
      <tr>
        <td height="30" colspan="2" align="center" bgcolor="#F5F5F5"><span style="font-weight: bold;">Items Details </span></td>
        <td width="137" align="center" bgcolor="#F5F5F5"><span style="font-weight: bold;">Price</span></td>
      </tr>
      @foreach($data['carts'] as $cart)
      <tr>
        <td height="24" colspan="2" align="center"><span style="font-family: Geneva, Arial, Helvetica, sans-serif;">{{ $cart->qty }} X {{ $cart->name }}@if($cart->sub_items!=null) <br> {{$cart->sub_items}}  @endif</span></td>
        <td align="center"><span style="font-family: Geneva, Arial, Helvetica, sans-serif;">{{ $cart->total }}</span></td>
      </tr>
      @endforeach
      <tr>
        <td width="387" height="23" align="right"><span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; '>Sub Total</span></td>
        <td width="47" align="center"><span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; '>:</span></td>
        <td align="center">{{ $data['subtotal'] }}</td>
      </tr>
      <tr>
        <td height="23" align="right"><span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; '>Delivery Charge </span></td>
        <td align="center"><span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; '>:</span></td>
        <td align="center">{{ $data['fee'] }}</td>
      </tr>
      <tr>
        <td height="26" align="right"><span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; '>Discount</span></td>
        <td align="center"><span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; '>:</span></td>
        <td align="center">{{ $data['discount'] }}</td>
      </tr>
      <tr>
        <td height="23" align="right"><span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; '>Total</span></td>
        <td align="center"><span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; '>:</span></td>
        <td align="center">{{ $data['grand_total'] }}</td>
      </tr>
      <tr style="border-style: none;">
        <td height="41" colspan="3" align="left" style="border-style: none;"><span style='font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold;'>Customer Details:</span></td>
        </tr>
      <tr>
        <td height="64" colspan="3" align="left" style="border-style: none;"><div style='font-size: 24;font-family: Georgia, "Times New Roman", Times, serif;'>{{ $data['name'] }}</div>
		  <div style='font-size: 24;font-family: Georgia, "Times New Roman", Times, serif;'>{{ $data['phone'] }},{{ $data['email'] }}</div>
		  <div style='font-size: 24;font-family: Georgia, "Times New Roman", Times, serif;'>{{ $data['delivery'] }}</div>		</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="34" align="center">Powered By: www.redchillinorthallerton.co.uk </td>
  </tr>
</table>

	</td>
  </tr>
</table>
</body>

</html>
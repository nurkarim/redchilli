<style type="text/css">
<!--
.style1 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;

	color: #272727;
}
.style2 {
	color: #242424;
	font-family: Georgia, "Times New Roman", Times, serif;
}
.style3 {font-family: Georgia, "Times New Roman", Times, serif}
.style5 {font-family: Georgia, "Times New Roman", Times, serif; font-weight: bold; }
.style9 {font-family: Georgia, "Times New Roman", Times, serif;  }
.style11 {font-family: Georgia, "Times New Roman", Times, serif;  }
-->
</style>
<?php
function ccMasking($number, $maskingCharacter = '*') {
    return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
}
?>
<script type="text/javascript">
  window.print();
</script>
<table width="218px" height="auto" border="0" align="center" cellpadding="0" cellspacing="0" style="font-size:60px;">
  <tr>
    <td width="218" height="32" align="center"><span class="style1">{{ $app->app_name }}</span></td>
  </tr>
  <tr>
    <td height="28" align="center"><span class="style3">{{ $app->app_address }}</span></td>
  </tr>
  <tr>
    <td height="21" align="center">Tel: <strong>{{ $app->app_contact }}</strong></td>
  </tr>
  <tr>
    <td height="33" align="center"><span class="style2">Order Placed at: {{ $order->created_at->format('d/m/y H:m A') }}</span></td>
  </tr>
  <tr>
    <td height="19" align="left">-----------------------------------------</td>
  </tr>
  <tr>
    <td height="30" align="center">
      <span class="style3"><strong>DELIVERY</strong></span></td>
  </tr>
  <tr>
    <td height="30"><span class="style3">Delivery Time: {{ $order->delivery_times }}</span></td>
  </tr>
  <tr>
    <td height="26"><span class="style3">Order Number: #ORD-{{ $order->id }}</span></td>
  </tr>
  <tr>
    <td height="38">-----------------------------------------</td>
  </tr>
  
  <tr>
    <td height="196"><table width="auto" border="0" cellpadding="0" cellspacing="0" style="font-size:50px; line-height:60px" >
      <tr>
        <td width="252" height="27" align="right"><span class="style5">Item</span></td>
        <td width="136" align="center"><span class="style5">GBP</span></td>
      </tr>
      @foreach($order->carts as $cart)
      <tr>
        <td height="25" align="right"><span class="style11">{{$cart->qty}} x {{ $cart->name }} @if($cart->sub_items!=null) <br> {{$cart->sub_items}}  @endif</span></td>
        <td align="center"><span class="style11">{{$cart->total}}</span></td>
      </tr>
      @endforeach
      <tr >
        <td height="34" style="border-top:2px solid #000" align="right"><span class="style9">Food and Drink</span></td>
        <td style="border-top:2px solid #000" align="center"><span class="style3">{{ $order->sub_total }}</span></td>
      </tr>
      <tr>
        <td height="35" align="right"><span class="style9">Delivery Charge</span></td>
        <td align="center"><span class="style3">{{ $order->tax }}</span></td>
      </tr>
      <tr>
        <td height="35" align="right"><span class="style9">Discount</span></td>
        <td align="center"><span class="style3">{{ $order->discount }}</span></td>
      </tr>
      <tr>
        <td height="27" align="right"><span class="style5">Total Due</span></td>
        <td align="center"><span class="style3">{{ $order->total }}</span></td>
      </tr>
    </table></td>
  </tr>
<td style="border-top:2px solid #000; padding:10px 0px 10px 0px" align="center"><span class="style3"> </span></td>
  <tr>
    <td height="39" align="center"><span class="style5" style="font-size:55px; padding:10px 0px 0px 0px ">Order  @if($order->pay_type==1) not paid @else has been paid @endif</span></td>
  </tr>
  <tr>
    <td height="31" align="center"><span class="style3" style="font-size:55px; ">@if($order->pay_type==1) @else Card {{ ccMasking($order->stripe_card)}}@endif</span></td>
  </tr>
  
  <tr>
    <td height="38">-----------------------------------------</td>
  </tr>
  
  
  <tr>
    <td height="24" align="center"><span class="style5">CUSTOMER</span></td>
  </tr>
  <tr>
    <td height="26"><span class="style3">Name: {{ $order->customer_name }}</span></td>
  </tr>
  <tr>
    <td height="24"><span class="style3">Delivery Address: {{ $order->delivery_address }}</span></td>
  </tr>
  <tr>
    <td height="27"><span class="style3">Contact Number: {{ $order->contact }}</span></td>
  </tr>

  <tr>
    <td height="38">-----------------------------------------</td>
  </tr>

  <tr>
    <td height="29" align="center"><span class="style3">www.redchillinorthallerton.co.uk</span></td>
  </tr>
</table>

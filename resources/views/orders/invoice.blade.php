<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{url('http://orders.bestcena.com/assets/stylesheet.css')}}">
<!-- body_text //-->
<style type="text/css">
  body, div.row { background-color: white; } 
</style>
</head>
<body>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td>
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left">
          <img src="{{url('http://orders.bestcena.com/assets/logo-bestcena.png')}}" width="300" height="100">
        </td>
        <td align="right">
        </td>
      </tr>
      <tr>
        <td colspan="2" align="left">
          <p><strong>FAKTURA BPL{{$order->orders_id}}</strong></p>
        </td>
      </tr>
      <tr>
        <td valign="top">
          <table width="100%" cellspacing="0" cellpadding="2" border="0">
          <tr>
            <td class="main" width="50%">
              <table width="100%" cellspacing="0" cellpadding="2" border="0">
              <tr>
                <td class="main">
                  <b>DOSTAWCA:</b>
                </td>
              </tr>
              <tr>
                <td class="main">
                  <b>HATON LTD</b>
                </td>
              </tr>
              <tr>
                <td class="main">
Suite 2, First Floor, Kenwood House <br>
77A Shenley Rd., Borehamwood WD6 1AG <br>
company nr. 09152610
                </td>
              </tr>
              
              <tr>
                <td class="main">
                  W sprawach związanych z<br>
                  <b>HATON LTD o.z.p.</b>
                </td>
              </tr>
              <tr>
                <td class="main">
Hradbova 19 <br>
04001 Kosice, Slovakia <br>
IČO: 50796097
                </td>
              </tr>
            </table>  
          </td>
          <td align="right" valign="top"  width="50%">
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
              <td valign="top">
              <table width="100%" cellspacing="0" cellpadding="2" border="0">
              <tr>
                <td class="main">
                  <b>Kontakt:</b>
                </td>
              </tr>
              <tr>
                <td class="main">
                  E-mail: czesc@bestcena.pl<br />
Web: www.bestcena.pl<br />
Tel. : (61) 227 85 20<br />
ING Bank Śląski S.A.<br />
Account nr: 08 1050 1520 1000 0024 0879 6833<br />
IBAN: PL 08 1050 1520 1000 0024 0879 6833<br />
SWIFT: INGBPLPW 

                </td>
              </tr>
              </table>
              </td>
              </tr>
            </table>  
          </td>
        </tr>
      </table>
      </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="2"><img width="100%" height="1" alt="" src="{{url('http://orders.bestcena.com/assets/pixel_black.gif')}}"></td>
      </tr>

      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>Dane Płatnika:</b></td>
          </tr>
          <tr>
            <td class="main">
              {{$order->orderBillingAddress->company }}
              <br>
              {{$order->orderBillingAddress->name }}
              <br>
              {{$order->orderBillingAddress->street_address }}
              <br>
              {{$order->orderBillingAddress->suburb }}
              <br>
              {{$order->orderBillingAddress->postcode }}
              {{$order->orderBillingAddress->city }}
              <br>
              {{$order->orderBillingAddress->state }}
              {{$order->orderBillingAddress->country }}
            </td>
          </tr>
          <tr>
            <td class="main">Tel:{{$order->orderCustomer->telephone }}</td>
          </tr>
          <tr>
            <td class="main">E-mail:{{$order->orderCustomer->email_address }}</td>
          </tr>
        </table>
        </td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>Adres do wysyłki:</b></td>
          </tr>
          <tr>
            <td class="main">
            {{$order->orderShippingAddress->company }}
            <br>
            {{$order->orderShippingAddress->name }}
            <br>
            {{$order->orderShippingAddress->street_address }}
            <br>
            {{$order->orderShippingAddress->suburb }}
            <br>
            {{$order->orderShippingAddress->postcode }}
            {{$order->orderShippingAddress->city }}
            <br>
            {{$order->orderShippingAddress->state }}
            {{$order->orderShippingAddress->country }}
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img width="100%" height="1" alt="" src="{{url('http://orders.bestcena.com/assets/pixel_black.gif')}}"></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><b>FAKTURA nr.</b></td>
        <td class="main">{{$order->orders_id}}</td>        
      </tr>
      <tr>
        <td class="main"><strong>Data zamówienia:</strong></td>
        <td class="main">{{date('d.m.Y h:i:s', strtotime($order->date_purchased)) }}</td>
      </tr>
      <tr>
        <td class="main"><strong>Data płatności:</strong></td>
        <td class="main">{{date('d.m.Y h:i:s', strtotime($order->date_purchased)) }}</td>
      </tr>
      <tr>
        <td class="main"><strong>Sposób płatności:</strong></td>
        <td class="main">{{$order->payment_method }}</td>
      </tr>
      <tr>
        <td class="main"><strong>Forma transportu:</strong></td>
        <td class="main">{{$order->shipping_method }}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img width="100%" height="1" alt="" src="{{url('http://orders.bestcena.com/assets/pixel_black.gif')}}"></td>
  </tr>

    <tr>       
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2" >
      <tr class="dataTableHeadingRow">
        <td class="dataTableHeadingContent">Ilość</td>
        <td class="dataTableHeadingContent">Produkty</td>
         <td class="dataTableHeadingContent" align="right">Magazyn</td>       
         <td class="dataTableHeadingContent" align="right">J.m</td>       
         <td class="dataTableHeadingContent" align="right">Wartość za szt.</td>
         <td class="dataTableHeadingContent" align="right">Całkowita wartość</td>
      </tr>
        <?php 
        $price = 0;
        foreach($order->orderTotal as $total){
			if (in_array($total->class, array('ot_cod_fee', 'ot_shipping'))) {
				$price = $price + $total->value;
			}
        }
        ?>
        {{-- @foreach($stockOrders as $stockOrder) --}}
          <tr class="dataTableRow">
            <td valign="top" align="center" class="dataTableContent">1&nbsp;x</td>
            <td valign="top" class="dataTableContent">{{$order->stockProduct->name }} [{{$order->stockProduct->products_pid }}]
              @if ($order->stockProduct->imei1 != '')
              <br />IMEI:{{$order->stockProduct->imei1 }}
              @endif
              @if ($order->stockProduct->imei2 != '' && $order->stockProduct->imei2 != $order->stockProduct->imei1)
              <br />IMEI2:{{$order->stockProduct->imei2 }}
              @endif
            </td>
            <td valign="top" align="right" class="dataTableContent">YUK</td>            
            <td valign="top" align="right" class="dataTableContent">Szt</td> 
            <td valign="top" align="right" class="dataTableContent"><b>{{round($order->stockProduct->final_price + $price, 2) }}&nbsp;zł</b></td>
            <td valign="top" align="right" class="dataTableContent"><b>{{round($order->stockProduct->final_price + $price, 2) }}&nbsp;zł</b></td>
          </tr>
          <?php $price = 0; ?>                    
        {{-- @endforeach --}}
      <tr>
        <td align="right" colspan="8"><table width="100%" border="0" cellspacing="0" cellpadding="2">
        @foreach($order->orderTotal as $total)
          @if (in_array($total->class, array('ot_total')))         
          <tr>
            <td align="right" class="{{str_replace('_', '-', $total->class) }}-Text">{{$total->title }}</td>
            <td align="right" class="{{str_replace('_', '-', $total->class) }}-Amount">{{round($total->value,2) }}&nbsp;zł</td>
          </tr>
          @endif
        @endforeach
        </table></td>
      </tr>
    </table>
    </td>
  </tr>

  <tr>
    <td colspan="8"><img width="100%" height="1" alt="" src="{{url('http://orders.bestcena.com/assets/pixel_black.gif')}}"></td>
  </tr>      
      <tr>
        <td align="left" colspan="8">
          Faktura stanowi potwierdzenie właściwej jakości i kompletności zamówionego towaru oraz podstawę do realizacji uprawnień gwarancyjnych. 
         </td>
      </tr>
  <tr>
    <td colspan="8"><img width="100%" height="1" alt="" src="{{url('http://orders.bestcena.com/assets/pixel_black.gif')}}"></td>
  </tr>      
    </table>
    </td>
  </tr>
  <tr>
    <td align="right" >
        <img src="http://bestcena.sk/adminPanel/images/haton_stamp.png" height="100" width="150">
    </td>
  </tr>   
</table>
<center>www.bestcena.pl | +48 (61) 227 85 20 | czesc@bestcena.pl | Biuro obsługi klienta, ul. Wierzbięcice 44a, Poznań 61-568</center>
<!-- body_text_eof //-->
</body>
</html>
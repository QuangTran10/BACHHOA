<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>In đơn hàng</title>

<style type="text/css">
    *{
      font-family: DejaVu Sans, sans-serif;
    }
    main{
      width: 100%,
      height: 90%;
    }
    table{
      font-size: x-small;
    }
    tfoot tr td{
      font-size: x-small;
    }
    .tbl2{
      width: 100%;
    }
    .tbl_details td{
      padding: 10px 15px;
    }
    .tbl2 td{
      padding: 0 15px;
    }
</style>

</head>
<body>
  @php
    use Carbon\Carbon;
    $image = $URL;
    $imageData = base64_encode(file_get_contents($image));
    $src = 'data:'.mime_content_type($image).';base64,'.$imageData;
  @endphp

  <table width="100%">
    <tr>
      <td valign="top" align="center"><img src="{{$src}}" style="width: 150px"></td>
      <td align="left">
        <div>
          @foreach($contact as $k)
          <p><b>Địa Chỉ: </b>{{$k->DiaChi}} </p>
          <p><b>Số Điện Thoại: </b>{{$k->SoDienThoai}}</p>
          <p><b>Email: </b>{{$k->Email}}</p>
          @endforeach   
        </div>
      </td>
    </tr>
    <tfoot>
      <td colspan="2" align="right">
        @php
          $now = Carbon::now('Asia/Ho_Chi_Minh');
        @endphp
        <i>Sóc Trăng, Ngày..{{$now->day}}.Tháng..{{$now->month}}.Năm..{{$now->year}}.</i>
      </td>
    </tfoot>
  </table>

  <br><br>
  <main>
    @foreach($order as $value)
    @php
      $tong = $value->ThanhTien;
    @endphp
    <div class="tbl2">
      <table>
        <tbody>
          <tr>
            <td colspan="2"><h3>THÔNG TIN PHIẾU NHẬP</h3></td>
          </tr>
          <tr>
            <td width="40%">Họ Và Tên</td>
            <td width="60%">{{$value->HoTen}}</td>
          </tr>
          <tr>
            <td>Địa Chỉ Giao Hàng</td>
            <td>{{$value->DiaChi}}</td>
          </tr>
          <tr>
            <td>Ngày Đặt Hàng</td>
            <td>{{\Carbon\Carbon::parse($value->NgayDat )->format('d/m/Y')}}</td>
          </tr>
          <tr>
            <td>Số Điện Thoại</td>
            <td>{{$value->SDT}}</td>
          </tr>
          <tr>
            <td>Loại Giao Hàng</td>
            <td>
              {{$value->TT_Ten}}
            </td>
          </tr>
          <tr>
            <td>Thanh Toán</td>
            <td>
              <?php
              if($value->TT_TrangThai ==0)
                echo 'Chưa Thanh Toán';
              elseif($value->TT_TrangThai ==1){
                echo 'Đã Thanh Toán';
              }elseif($value->TT_TrangThai==2){
                echo 'Thanh Toán VNPAY';
              }else{
                echo 'Thanh Toán MOMO';
              }
              ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    @endforeach

    <br><br>

    <table width="100%" class="tbl_details">
      <thead style="background-color: lightgray;">
        <tr>
          <th width="40%">Tên sản phẩm</th>
          <th>Giá</th>
          <th>Số Lượng </th>
          <th>Giảm Giá</th>
          <th>Thành Tiền</th>
        </tr>
      </thead>
      <tbody>
        @php
          $dis_total=0;
        @endphp
        @foreach($order_details as $order)
        @php
        $dis_total=$dis_total+$order->SoLuong*$order->GiaDatHang*$order->GiamGia;
        @endphp
        <tr>
          <td style="text-align: left;">{{$order->TenSP}}</td>
          <td align="center">{{number_format($order->GiaDatHang , 0, ',', ' ').'đ';}}</td>
          <td align="center">{{$order->SoLuong}}</td>
          <td align="right">{{$order->GiamGia*100}}%</td>
          <td align="right">{{number_format($order->ThanhTien , 0, ',', ' ').'đ';}}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
          <tr>
              <td colspan="2"></td>
              <td align="right" colspan="2"><b>Phí Vận Chuyển</b></td>
              <td align="right">
                @if($tong >1000000)
                  Miễn phí giao hàng
                @else
                  {{number_format(30000 , 0, ',', ' ').'đ';}}
                @endif
              </td>
          </tr>
          <tr>
              <td colspan="3"></td>
              <td align="right"><b>Thành Tiền</b></td>
              <td align="right">{{number_format($tong , 0, ',', ' ').'đ';}}</td>
          </tr>
      </tfoot>
    </table>
  </main>
</body>
</html>
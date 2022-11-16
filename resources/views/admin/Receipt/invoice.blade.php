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
    <h3 style="text-align: center;">THÔNG TIN PHIẾU NHẬP HÀNG</h3>
    <div class="tbl2">
      <table>
        <tbody>
          <tr>
            <td width="40%">Người nhập hàng</td>
            <td width="60%">{{$receipt->HoTenNV}}</td>
          </tr>
          <tr>
            <td>Ngày nhập hàng</td>
            <td>{{\Carbon\Carbon::parse($receipt->NgayLap )->format('d/m/Y')}}</td>
          </tr>
          <tr>
            <td>Nhà cung cấp</td>
            <td>{{$receipt->Ten}}</td>
          </tr>
          <tr>
            <td>Tình Trạng</td>
            <td>
              <?php
              if($receipt->TinhTrang ==0)
                echo 'Ghi Nợ';
              elseif($receipt->TinhTrang ==1){
                echo 'Đã Thanh Toán';
              }
              ?>
            </td>
          </tr>
          <tr>
            <td>Số sản phẩm</td>
            <td><?php echo count($receipt_details) ?></td>
          </tr>
        </tbody>
      </table>
    </div>
   

    <br><br>

    <table width="100%" class="tbl_details">
      <thead style="background-color: lightgray;">
        <tr>
          <th width="40%">Tên sản phẩm</th>
          <th>Số Lượng </th>
          <th>Giá</th>
          <th>Thành Tiền</th>
        </tr>
      </thead>
      <tbody>
        @foreach($receipt_details as $value)
        <tr>
          <td style="text-align: left;">{{$value->TenSP}}</td>
          <td align="center">{{$value->SoLuong}}</td>
          <td align="center">{{number_format($value->DonGia, 0, ',', ' ').'đ';}}</td>
          <td align="right">{{number_format($value->SoLuong*$value->DonGia , 0, ',', ' ').'đ';}}</td>
        </tr>
        @endforeach
        <tr>
          <th colspan="3" style="font-size: 16px;">
            Tổng giá trị đơn hàng
          </th>
          <td style="font-size: 16px;">
            {{number_format($receipt->ThanhTien , 0, ',', ' ').'đ';}}
          </td>
        </tr>
      </tbody>
    </table>

    <h4 style="text-align: right;margin-top: 30px">Người xuất đơn</h4>
    <p style="text-align: right;font-size: 12px">(Ký ghi rõ họ tên)</p>
  </main>
</body>
</html>
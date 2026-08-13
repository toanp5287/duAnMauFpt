<?php

class Payment
{
    private $modelBy;

    public function __construct()
    {
        require_once __DIR__ . '/../models/model-buy.php';
        $this->modelBy = new Model_by();
    }

    public function createPayment()
    {


        require_once __DIR__ . '/../../config/vnpay.php';

        $id = (int)$_GET['id'];

        $order = $this->modelBy->getOrderById($id);

        if (!$order) {
            die("Không tìm thấy đơn hàng");
        }

        $vnp_TxnRef = $order['maDon'];
        $vnp_OrderInfo = "Thanh toan don hang " . $order['maDon'];
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $order['tong_tien'] * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);

        $query = "";
        $hashdata = "";

        foreach ($inputData as $key => $value) {

            $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';

            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $hashdata = rtrim($hashdata, '&');

        $query = rtrim($query, '&');

        $vnpSecureHash = hash_hmac(
            'sha512',
            $hashdata,
            $vnp_HashSecret
        );

        $paymentUrl = $vnp_Url .
            "?" .
            $query .
            "&vnp_SecureHash=" .
            $vnpSecureHash;

        header("Location: " . $paymentUrl);
        exit();
    }

    public function vnpayReturn()
    {


        require_once __DIR__ . '/../../config/vnpay.php';
        if (!isset($_GET['vnp_ResponseCode'], $_GET['vnp_TxnRef'])) {
            die("Dữ liệu trả về không hợp lệ.");
        }


        $maDon = $_GET['vnp_TxnRef'];
        $responseCode = $_GET['vnp_ResponseCode'];
        $transactionNo = $_GET['vnp_TransactionNo'];

        if ($responseCode == "00") {

            // Thanh toán thành công
            $this->modelBy->updatePayment(
                $maDon,
                1,
                $transactionNo,
                date("Y-m-d H:i:s")
            );

            echo "<script>
        alert('Thanh toán thành công');
        location='index.php?controller=san_pham';
    </script>";
        } elseif ($responseCode == "24") {

            // Người dùng hủy thanh toán
            $this->modelBy->updatePayment(
                $maDon,
                2
            );

            echo "<script>
        alert('Bạn đã hủy thanh toán');
        location='index.php?controller=buy';
    </script>";
        } else {

            // Thanh toán thất bại
            $this->modelBy->updatePayment(
                $maDon,
                3
            );

            echo "<script>
        alert('Thanh toán thất bại');
        location='index.php?controller=buy';
    </script>";
        }
    }
}

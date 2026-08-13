<?php

class PaymentModel
{
    private $vnp_TmnCode;
    private $vnp_HashSecret;
    private $apiUrl;

    public function __construct()
    {
        require_once "./config/vnpay.php";

        $this->vnp_TmnCode    = $vnp_TmnCode;
        $this->vnp_HashSecret = $vnp_HashSecret;
        $this->apiUrl         = $apiUrl;
    }

    /**
     * Gửi request tới VNPAY
     */
    private function callAPI($method, $url, $data = null)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);

        $result = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }

        curl_close($curl);

        return json_decode($result, true);
    }

    /**
     * Hoàn tiền
     */
    public function refund(
        $txnRef,
        $transactionDate,
        $amount,
        $createBy,
        $transactionType = "02"
    ) {

        $requestId = time() . rand(1000, 9999);

        $request = [
            "vnp_RequestId"      => $requestId,
            "vnp_Version"        => "2.1.0",
            "vnp_Command"        => "refund",
            "vnp_TmnCode"        => $this->vnp_TmnCode,
            "vnp_TransactionType" => $transactionType,
            "vnp_TxnRef"         => $txnRef,
            "vnp_Amount"         => $amount * 100,
            "vnp_OrderInfo"      => "Hoan tien don hang",
            "vnp_TransactionNo"  => "0",
            "vnp_TransactionDate" => $transactionDate,
            "vnp_CreateBy"       => $createBy,
            "vnp_CreateDate"     => date("YmdHis"),
            "vnp_IpAddr"         => $_SERVER["REMOTE_ADDR"]
        ];

        $hashData = implode("|", [
            $request["vnp_RequestId"],
            $request["vnp_Version"],
            $request["vnp_Command"],
            $request["vnp_TmnCode"],
            $request["vnp_TransactionType"],
            $request["vnp_TxnRef"],
            $request["vnp_Amount"],
            $request["vnp_TransactionNo"],
            $request["vnp_TransactionDate"],
            $request["vnp_CreateBy"],
            $request["vnp_CreateDate"],
            $request["vnp_IpAddr"],
            $request["vnp_OrderInfo"]
        ]);

        $request["vnp_SecureHash"] = hash_hmac(
            "sha512",
            $hashData,
            $this->vnp_HashSecret
        );

        return $this->callAPI(
            "POST",
            $this->apiUrl,
            json_encode($request)
        );
    }
}

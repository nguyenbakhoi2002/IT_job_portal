<?php
// namespace App\Helpers;

if(! function_exists('getProvinceByJSON')) {
    function getProvinceByJSON() {
        //lấy json
        $jsonFilePath = storage_path('app\json\provinces.json');
        //đọc nội dung của tập tin json
        $jsonContent = file_get_contents($jsonFilePath);
        //chuyển đổi json thành mảng
        $dataProvinces = json_decode($jsonContent, true);
        return $dataProvinces;
    }
}
?>
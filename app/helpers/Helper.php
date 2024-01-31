<?php

// require_once './helpers/ArrayHelper.php';
// require_once './helpers/AuthenticationHelper.php';
// require_once './helpers/ErrorHelper.php';
require_once 'app/helpers/FunctionHelper.php';
require_once 'app/helpers/ImageHelper.php';
require_once 'app/helpers/JsonHelper.php';
require_once 'app/helpers/PostHelper.php';
// require_once './helpers/SessionHelper.php';
require_once 'app/helpers/StringHelper.php';

// Hàm CRUD chung

function readEntity($tableName)
{
    // Triển khai logic truy vấn và trả về tất cả bản ghi từ bảng $tableName
    // Trả về mảng chứa tất cả các bản ghi hoặc false nếu có lỗi
    $data = encodeJson(getAllRows($tableName));
    return $data;
}
function readEntityByAlias($tableName, $aliasColumnName, $aliasValue)
{
    // Triển khai logic truy vấn và trả về tất cả bản ghi từ bảng $tableName
    // Trả về mảng chứa tất cả các bản ghi hoặc false nếu có lỗi
    $data = encodeJson(getRowByColumnName($tableName, $aliasColumnName, $aliasValue));
    return $data;
}

function pagination($tableName, $start , $page) {
    $page = encodeJson(getPagination($tableName, $start , $page));
    return $page;

}


function totalPagination($tableName){
    $page = getTotalPages($tableName);
    return $page;

}

function createEntity($tableName, $data, $fileInputName = null, $uploadPath = null)
{
    // Triển khai logic tạo mới bản ghi trong bảng $tableName với dữ liệu $data
    // Trả về kết quả thành công hoặc thất bại
    
    if ($fileInputName != null && $uploadPath != null) {
        $result = checkUploadedFiles($fileInputName);
        
        // var_dump($result);
        // $result = uploadImages($fileInputName, $uploadPath);
        // if ($result == 'file') {
        //     $data[$fileInputName] = $result;
        // } 
        
        $albumResult = checkUploadedFiles('album');
        var_dump($albumResult);
        // if ($albumResult == 'files') {
        //     // $data[$fileInputName] = $result;
        // } 
    }

    if (isset($data['name']) || isset($data['title'])) {
        $data['alias'] = generateAlias($data['name']);
    }

    // $result = createRow($tableName, deleteKeyValuePairs($data, "id", "create"));
    // return $result;
}

function updateEntity($tableName, $entityId, $data, $columnName = null, $fileInputName = null, $uploadPath = null)
{
    // Triển khai logic cập nhật bản ghi có ID $entityId trong bảng $tableName với dữ liệu $data
    // Trả về kết quả thành công hoặc thất bại
    if ($fileInputName != null && $uploadPath != null) {
        $check = checkUploadedFiles($fileInputName);

        if (isset($check) && $check != false) {
            print_r($check); // file

            $result = updateImages($fileInputName, $uploadPath, $tableName, $columnName, $entityId);
            if ($result != null) {
                $data['image'] = $result;
            } 

        }
    }

    if (isset($data['name']) || isset($data['title'])) {
        $data['alias'] = generateAlias($data['name']);
    }

    $data['updated_at'] = getCurrentDateTimeInVietnam();
    $result = updateRowById(    $tableName, $entityId, deleteKeyValuePairs($data, "id", "update"));
    return $result;

}

function deleteEntityById($tableName, $entityId, $filePath = null, $columnName = null)
{
    // Triển khai logic xóa bản ghi có ID $entityId trong bảng $tableName
    // Trả về kết quả thành công hoặc thất bại
    
    if (!empty($filePath) && !empty($columnName)) {
        $value = getRowByColumnName($tableName, 'id', $entityId);
        if (isset($value[0][$columnName])) {
            $filePath = $filePath . '/' . $value[0][$columnName]; 
            $check = deleteImage($filePath);
            
            if ($check == true) {
                    $result = deleteRowById($tableName, $entityId, $filePath = null, $columnName = null);
            }
                
            if (!file_exists($filePath)) {
                $result = deleteRowById($tableName, $entityId, $filePath = null, $columnName = null);
            }
        } 
    } else {
        $result = deleteRowById($tableName, $entityId);
    }

    if (!empty($result)) {
        // Nếu xóa thành công, trả về mã trạng thái HTTP 200
        return http_response_code(200);
        
    } else {
        // Nếu xóa không thành công, có thể trả về mã trạng thái khác nếu cần
        // Ví dụ: http_response_code(400) để trả về mã lỗi 400 (Bad Request)
        return http_response_code(400);
        
    }
}

?>



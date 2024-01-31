<?php

function encodeJson($data)
{
    if ($data !== false) {
        $json = json_encode($data);
        // echo $json;
        return $json;
    }
}

function decodeJson($json)
{
    return json_decode($json, true);
}

function saveJsonToFile($data, $filename)
{
    $json = encodeJson($data);
    if ($json === false) {
        echo "Lỗi khi mã hóa dữ liệu JSON.";
        return false;
    }

    if (file_put_contents($filename, $json) !== false) {
        return true;
    } else {
        echo "Lỗi khi lưu tệp JSON.";
        return false;
    }
}

function loadJsonFromFile($filename)
{
    $json = file_get_contents($filename);
    if ($json === false) {
        echo "Lỗi khi đọc tệp JSON.";
        return null;
    }

    $data = decodeJson($json);
    if ($data === null) {
        echo "Lỗi khi giải mã dữ liệu JSON.";
        return null;
    }

    return $data;
}

function replaceParentIdWithName($data, $parent_id, $parentData, $parentColumnName)
{
    $data = json_decode($data, true);
    $parentData = json_decode($parentData, true);
    // print_r($data);
    // print_r($parentData);

    // Kiểm tra xem $parent_id có tồn tại trong $data và $parentColumnName có tồn tại trong $parentData
    if (isset($data)) {
        foreach ($data as &$item) {
            if (isset($item[$parent_id])) {

                // Tìm danh mục với id tương ứng trong $parentData
                foreach ($parentData as $parentItem) {
                    if ($parentItem['id'] === $item[$parent_id]) {
                        $item[$parent_id] = $parentItem[$parentColumnName];
                    }
                }
            }
        }
    }

    return json_encode($data);
}

?>
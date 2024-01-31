<?php
require_once './configs/database.php';




function getPagination($tableName, $start, $page)
{
    $sql = "SELECT * FROM $tableName WHERE hidden <> 0 LIMIT $start, $page";
    $result = query($sql);

    // foreach ($result as &$item) {
    //     if (isset($item['created_at']) && isset($item['updated_at'])) {
    //         $item['created_at'] = formatDateTimeInVietnam($item['created_at']);
    //         $item['updated_at'] = formatDateTimeInVietnam($item['updated_at']);
    //     }
    // }

    // $formattedResult = [];
    // foreach ($result as $item) {
    //     $formattedResult[] = $item;
    // }

    // print_r($formattedResult);
    // return $formattedResult;
    // print_r($result);
    return $result;


}

function getTotalPages($tableName)
{
    $sql = "SELECT COUNT(*) FROM $tableName WHERE hidden <> 0";
    $result = connect()->query($sql)->fetchColumn();
    return $result;

}

function getAllRows($tableName)
{
    $sql = "SELECT * FROM $tableName";
    $rows = query($sql);
    if (isset($rows['created_at']) && isset($rows['updated_at'])) {
        $rows['created_at'] = formatDateTimeInVietnam($rows['created_at']);
        $rows['updated_at'] = formatDateTimeInVietnam($rows['updated_at']);
    }
    return $rows;
}

function getRowById($tableName, $id)
{
    $sql = "SELECT * FROM $tableName WHERE id = ?";
    $params = [$id];
    $row = query($sql, $params);
    return $row;
}

function getRowByColumnName($tableName, $columnName, $value)
{
    $sql = "SELECT * FROM $tableName WHERE $columnName = ?";
    $params = [$value];
    $row = query($sql, $params);
    return $row;
}


function createRow($tableName, $data)
{
    $columns = implode(', ', array_keys($data));
    $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
    $values = array_values($data);

    $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    $result = execute($sql, $values);
    return $result;
}


function updateRowById($tableName, $id, $data)
{
    $columns = implode(' = ?, ', array_keys($data)) . ' = ?';
    $values = array_values($data);
    $values[] = $id;

    $sql = "UPDATE $tableName SET $columns WHERE id = ?";
    $result = execute($sql, $values);
    return $result;
}

function updateRowByColumnName($tableName, $columnName, $columnValue, $data)
{
    $setStatements = [];
    $values = [];

    foreach ($data as $key => $value) {
        $setStatements[] = "$key = ?";
        $values[] = $value;
    }

    $setStatements = implode(', ', $setStatements);
    $values[] = $columnValue;

    $sql = "UPDATE $tableName SET $setStatements WHERE $columnName = ?";
    $result = execute($sql, $values);
    return $result;
}

function checkTableColumn($tableName, $columnName)
{
    // Truy vấn để lấy thông tin cột trong bảng
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName' AND COLUMN_NAME = '$columnName'";
    $result = connect()->query($sql);

    // Kiểm tra kết quả truy vấn
    if ($result->num_rows > 0) {
        // Cột tồn tại trong bảng
        return true;
    } else {
        // Cột không tồn tại trong bảng
        return false;
    }
}

function deleteRowById($tableName, $id)
{



    $sql = "DELETE FROM $tableName WHERE id = ?";
    $params = [$id];
    $result = execute($sql, $params);
    return $result;

}

function deleteRowByColumnName($tableName, $columnName, $columnValue)
{
    $sql = "DELETE FROM $tableName WHERE $columnName = ?";
    $params = [$columnValue];
    $result = execute($sql, $params);
    return $result;
}

?>
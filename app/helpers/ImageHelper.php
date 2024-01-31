<?php

function checkUploadedFiles($fileInputName)
{
    if (isset($_FILES[$fileInputName])) {
        $file = $_FILES[$fileInputName];
        var_dump($file);
        // Kiểm tra xem có lỗi xảy ra trong quá trình tải lên không
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Kiểm tra xem đây là một file duy nhất hay là nhiều file
            var_dump($file['name']);
            if (is_array($file['name'])) {
                // Nếu là mảng, đây là nhiều file
                if (count($file['name']) > 1) {
                    return 'files';
                } else {
                    return 'file';
                }
            } else {
                // Nếu không phải mảng, đây là một file duy nhất
                return 'file';
            }
        }
    }

    // Nếu không có file được tải lên hoặc có lỗi xảy ra, trả về false
    return false;
}


function uploadImages($fileInputName, $uploadPath)
{
    $result = checkUploadedFiles($fileInputName);
    if ($result === 'file') {
        $file = $_FILES[$fileInputName];
        // $targetPath = $uploadPath . '/' . generateUniqueFilename($file['name']);
        $targetPath = $uploadPath . '/' . $file['name'];

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return basename($targetPath);
        } else {
            // echo 'Lỗi khi tải lên file.';
            return null;
        }
    } elseif ($result === 'files') {
        $files = $_FILES[$fileInputName];
        $uploadedFiles = [];

        for ($i = 0; $i < count($files['name']); $i++) {
            $file = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            ];

            // $targetPath = $uploadPath . '/' . generateUniqueFilename($file['name']);
            $targetPath = $uploadPath . '/' . $file['name'];

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $uploadedFiles[] = basename($targetPath);
            } else {
                // echo 'Lỗi khi tải lên file: ' . $file['name'] . '<br>';
            }
        }

        return $uploadedFiles;
    } else {
        echo 'Không có file được tải lên hoặc có lỗi xảy ra.';
        return null;
    }
}

// function generateUniqueFilename($filename) {
//     $basename = pathinfo($filename, PATHINFO_FILENAME);
//     $extension = pathinfo($filename, PATHINFO_EXTENSION);
//     $newFilename = $basename . '_' . uniqid() . '.' . $extension;
//     return $newFilename;
// }


function updateImages($fileInputName, $uploadPath, $tableName, $columnName, $id)
{
    // Kiểm tra nếu có POST file(s) hay không, 
    // $check = checkUploadedFiles($fileInputName);

    $check = 'file';

    if (isset($check) && $check !== false) {
        // Nếu tồn tại thì lấy data theo bảng ở cột qua id
        $oldFile = getRowByColumnName($tableName, 'id', $id)[0][$columnName];
        $newFile = $_FILES[$fileInputName]['name'];
        // var_dump($newFile, $oldFile);

        // Kiểm tra file, mới và cũ
        if ($oldFile != $newFile) {
            // Nếu tồn tại file mới thì upload file mới và xóa file cũ
            $checkUpload = uploadImages($fileInputName, $uploadPath);

            // Kiểm tra upload
            if ($checkUpload != null) {
                // Nếu thành công thì xóa ảnh cũ và cập nhật lại database
                $uploadPath = $uploadPath . '/' . $oldFile;
                deleteImage($uploadPath);
                return $newFile;

            } else
                return null;

        } else if (!file_exists($uploadPath . '/' . $oldFile)) {
            // Nếu không tồn tại file cũ khi upload file cũ thì vẫn upload
            $checkUpload = uploadImages($fileInputName, $uploadPath);
        } else
            return null;

    } else
        return null;

    // // Xóa hình ảnh hiện tại
    // if ($currentFilePath && file_exists($currentFilePath)) {
    //     if (!deleteImage($currentFilePath)) {
    //         return false;
    //     }
    // }

    // Tải lên hình ảnh mới
    // return uploadImage($file, $targetDirectory);
}

function deleteImage($filePath)
{
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            return true;
        } else {
            echo "Lỗi khi xóa hình ảnh. ";
        }
    } else {
        echo "Tệp tin không tồn tại. ";
    }

    return false;
}

// Sử dụng helper functions

// $targetDirectory = "uploads/"; // Thư mục lưu trữ các hình ảnh tải lên

// // Thêm hình ảnh
// $uploadedFile = $_FILES['image'];
// $uploadedImagePath = uploadImage($uploadedFile, $targetDirectory);
// if ($uploadedImagePath) {
//     echo "Hình ảnh đã được tải lên thành công.";
// } else {
//     echo "Lỗi khi tải lên hình ảnh.";
// }

// // Xóa hình ảnh
// $imageToDelete = "uploads/image.jpg"; // Đường dẫn tới hình ảnh cần xóa
// $deleteResult = deleteImage($imageToDelete);
// if ($deleteResult) {
//     echo "Hình ảnh đã được xóa thành công.";
// } else {
//     echo "Lỗi khi xóa hình ảnh.";
// }

// // Sửa hình ảnh
// $uploadedFile = $_FILES['image'];
// $currentImagePath = "uploads/image.jpg"; // Đường dẫn tới hình ảnh hiện tại
// $updatedImagePath = updateImage($uploadedFile, $targetDirectory, $currentImagePath);
// if ($updatedImagePath) {
//     echo "Hình ảnh đã được cập nhật thành công.";
// } else {
//     echo "Lỗi khi cập nhật hình ảnh.";
// }

?>
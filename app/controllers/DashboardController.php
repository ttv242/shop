<?php
class DashboardController extends Controller
{

    function __construct()
    {
    }

    function dashboard($param1 = null, $param2 = null)
    {
        $titlePage = 'Dashboard';
        $this->view('app/views/dashboard/pages/dashboard/dashboard.php', [
            'titlePage' => $titlePage,
        ]);
    }

    function listCat($param1 = null, $param2 = null)
    {
        $titlePage = 'Danh sách Danh mục';
        
        $row = 4;
        $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
        $form = ($currentpage - 1) * $row;

        // $datas = readEntity('categories');
        $data = pagination('categories',  $form, $row);
        // print_r($data);
        $totalPage = totalPagination('categories'); // tổng tất cả sản phẩm 
        // $totalPages = (int)$totalPage;       

        $listPage = ceil($totalPage/ $row); // tổng sản phẩm chia cho sản phẩm hiện vd 4/2 = 2 => page 


        $getPostData = getPostData();
        if (!empty($getPostData) && isset($getPostData)) {
            // print_r($getPostData['name']);

            if (isset($getPostData['create'])) {
                createEntity('categories', $getPostData, 'image', 'public/ct_shop/uploads/categories/images');
                // Gọi hàm goBack() để trở về trang trước đó
                goBack();
                // print_r($_FILES['image']);
            }

            if (isset($getPostData['update'])) {
                // print_r($getPostData);
                updateEntity('categories', $getPostData['id'], $getPostData, 'image', 'image', 'public/ct_shop/uploads/categories/images');
                // Gọi hàm goBack() để trở về trang trước đó
                goBack();
            }
            
            if (isset($getPostData['delete'])) {
                // var_dump($getPostData);
                $result = deleteEntityById('categories', $getPostData['delete'], 'public\ct_shop\uploads\categories\images', 'image');
                // echo $result;
                // Gọi hàm goBack() để trở về trang trước đó
                // goBack();
            }
        }

        // if(isset($param1)) {
        //     echo $param1;
        // }

        // $filePath = 'public/ct_shop/uploads/categories/images';
        // $filePath = 'public\ct_shop\uploads\categories\images';
        // $columnName = 'image';
        // $value = getRowByColumnName('categories', 'id', '158');
        // // echo $value[0][$columnName];
        // if (isset($value[0][$columnName])) {
        //     $filePath = $filePath . '/' . $value[0][$columnName]; 
        //     deleteImage($filePath);
        // }
        // echo $filePath;

        // $s = deleteEntityById('categories', '178', 'public\ct_shop\uploads\categories\images', 'image');
            // echo $s;

        // print_r(updateImages('image', 'categories', 'image', '192'));

        $this->view('app/views/dashboard/pages/categories/list.php', [
            'titlePage' => $titlePage,
            'data' => $data,
            'listPage'  =>  $listPage 
        ]);
    }

    function listBrands()
    {
        $titlePage = 'Danh sách Danh mục';
        $dataBrands = readEntity('brands');

        $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;


        $row = 4;
        $form = ($currentpage - 1) * $row;


        $data = pagination('categories',  $form, $row);
        $totalPage = totalPagination('categories'); // tổng tất cả sản phẩm 
        // $totalPages = (int)$totalPage;
       

        $listPage = ceil($totalPage/ $row); // tổng sản phẩm chia cho sản phẩm hiện vd 4/2 = 2 => page 


        $getPostData = getPostData();
        if (!empty($getPostData) && isset($getPostData)) {
            // print_r($getPostData['name']);

            if (isset($getPostData['create'])) {
                createEntity('brands', $getPostData);
                // Gọi hàm goBack() để trở về trang trước đó
                goBack();
            }

            if (isset($getPostData['update'])) {
                updateEntity('brands', $getPostData['id'], $getPostData);
                // Gọi hàm goBack() để trở về trang trước đó
                goBack();
            }
            
            if (isset($getPostData['delete'])) {
                // var_dump($getPostData);
                deleteEntity('brands', $getPostData['delete']);
                // Gọi hàm goBack() để trở về trang trước đó
                goBack();
            }
        }


        $this->view('app/views/dashboard/pages/brands/list.php', [
            'titlePage' => $titlePage,
            'dataBrands' => $dataBrands,
            'listPage'  =>  $listPage 

        ]);
    }

    // function listProduts() {


    //     $this->view('app/views/dashboard/pages/products/list.php');
    // }

}

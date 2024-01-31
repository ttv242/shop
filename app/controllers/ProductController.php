<?php 


class ProductController extends Controller{

    function __construct()
    {
    }


    public function listProduct() {
        $titlePage = 'Danh sách Sản Phẩm';
        
        $categories = readEntity('categories');
        $brands = readEntity('brands');

        $row = 10;
        $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
        $form = ($currentpage - 1) * $row;

        // $datas = readEntity('categories');
        $data = pagination('products',  $form, $row);
        // print_r($data);
        $totalPage = totalPagination('products'); // tổng tất cả sản phẩm 

        $listPage = ceil($totalPage/ $row); // tổng sản phẩm chia cho sản phẩm hiện vd 4/2 = 2 => page 


        $getPostData = getPostData();
        if (!empty($getPostData) && isset($getPostData)) {
            
            if (isset($getPostData['create'])) {
                // print_r($getPostData);
                createEntity('products', $getPostData, 'image', 'public/ct_shop/uploads/products/images');
                // Gọi hàm goBack() để trở về trang trước đó
                // goBack();
                // print_r($_FILES['image']);
            }

            if (isset($getPostData['update'])) {
                // print_r($getPostData);
                updateEntity('products', $getPostData['id'], $getPostData, 'image', 'image', 'public/ct_shop/uploads/products/images');
                // Gọi hàm goBack() để trở về trang trước đó
                goBack();
            }
            
            if (isset($getPostData['delete'])) {
                // var_dump($getPostData);
                $result = deleteEntityById('products', $getPostData['delete'], 'public\ct_shop\uploads\products\images', 'image');
                // echo $result;
                // Gọi hàm goBack() để trở về trang trước đó
                // goBack();
            }
        }

        $data = replaceParentIdWithName($data, 'category_id', $categories, 'name');
        $data = replaceParentIdWithName($data, 'brand_id', $brands, 'name');
        // print_r($data);
        // $this->view('app/views/dashboard/pages/products/list.php', [
        //     'titlePage' => $titlePage,
        //     'listPage'  =>  $listPage,
        //     'categories' => $categories,
        //     'brands' => $brands,
        //     'data' => $data,
        // ]);
    }


}

?>


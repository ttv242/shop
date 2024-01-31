<?php
class PagesController extends Controller
{

    function __construct()
    {

    }

    function home($param1 = null, $param2 = null)
    {
        $titlePage = 'Trang chủ';

        $categories = readEntity('categories');
        $brands = readEntity('brands');
        $products = readEntity('products');

        $this->view('app/views/ct_shop/pages/home/home.php', [
            'titlePage' => $titlePage,
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    function about($param1 = null, $param2 = null)
    {
        $titlePage = 'Giới thiệu';
        $this->view('app/views/ct_shop/pages/home/home.php', [
            'titlePage' => $titlePage,
        ]);
    }
    
    function news($param1 = null, $param2 = null)
    {
        $titlePage = 'Tin tức';
        $this->view('app/views/ct_shop/pages/news/list.php', [
            'titlePage' => $titlePage,
        ]);
    }
    
    function newsDetail($param1 = null, $param2 = null)
    {
        $titlePage = $param1;
        $this->view('app/views/ct_shop/pages/news/detail.php', [
            'titlePage' => $titlePage,
        ]);
    }

    function shop($param1 = null, $param2 = null)
    {
        $titlePage = 'shop';
        // $cat = $this->cat; 
        $this->view('app/views/ct_shop/pages/shop/shop.php', [
            'titlePage' => $titlePage,
            // 'cat' => $cat
        ]);
    }

    function catDetail($param1, $param2 = null)
    {
        // var_dump($param1); //NULL
        
        $alias = $param1;
        $data = readEntityByAlias('categories', 'alias', $alias);
        print_r($data);
        $titlePage = $alias;
        // $this->view('app/views/ct_shop/pages/shop/shop.php', [
        //     'titlePage' => $titlePage,
        // ]);
    }
    function proDetail($param1, $param2)
    {
        var_dump($param1, $param2); //NULL NULL

        $cat = $param1;
        $alias = $param2;
        $titlePage = $alias;
        $cat = $this->cat; 
        $this->view('app/views/ct_shop/pages/shop/shop.php', [
            'titlePage' => $titlePage,
            'cat' => $cat
        ]);
    }

    function contact($param1 = null, $param2 = null)
    {
        $titlePage = 'Liên hệ';
        $this->view('app/views/ct_shop/pages/contact/contact.php', [
            'titlePage' => $titlePage,
        ]);
    }
}
?>
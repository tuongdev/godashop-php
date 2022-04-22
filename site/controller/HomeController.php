<?php 
class HomeController {
    function index() {
        $productRepository = new ProductRepository();
        $conds = [];
        $sorts = ["featured" => "DESC"]; // DESC là sắp sếp giảm 
        $page = 1;
        $item_per_page = 4;
        // Lấy 4 sản phẩm nổi bật
        $featuredProducts = $productRepository->getBy($conds, $sorts, $page, $item_per_page);

        // Lấy 4 sản phẩm mới nhất
        $sorts = ["created_date" => "DESC"];
        $latestProducts = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
        
        // Lấy tất cả các danh mục
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();
        $categoryProducts = [];
        foreach ($categories as $category) {
            $conds = [
                "category_id" => [
                    "type" => "=",
                    "val" => $category->getId()
                ]
            ];//SELECT * FROM product WHERE category_id=1
            $products = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
            $categoryProducts[$category->getName()] = $products;
        }
        //$categoryProducts là array 2 chiều
        //Mỗi phần tử co key và value
        //key là tên của danh mục, value là danh sách các sản phẩm thuộc danh mục đ1
        require "view/home/index.php";

    }
}


<?php 
//router
session_start();
// require file config của hệ thống và kết nối csdl
require '../config.php';
require '../connectDB.php';
// require models
require '../bootstrap.php';
require '../vendor/autoload.php';
// lấy giá trị của tham số c và a ở thanh địa chỉ
// mặc định c có giá trị home và a = index
// c là controller 
// a là action
// $_GET lấy tham số trên thanh địa chỉ, các tham số nối với nhau bởi dấu &
// $_GET là array kết hợp vì Key là chuỗi
// dấu / là domain chính
// nếu $_GET['c'] tồn tại thì trả về $_GET['c'] ngược lại trả về home
$c = $_GET['c'] ?? 'home'; // nếu c không có dữ liệu thì chọn home
$a = $_GET['a'] ?? 'index'; 
$controller = ucfirst($c) . 'Controller'; // HomeController
require "controller/$controller.php"; // controller/HomeController.php
// new là trả về đối tượng tương đương class đó
$controller = new $controller; //  class new homeController 
//$controller->index(); // gọi hàm index() của đối tượng mà biến $controller đang chứa index(home)
$controller->$a(); // gọi hàm tương ứng với giá trị trong $a của $controller

?>
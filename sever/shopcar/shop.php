<?php
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
    header("Content-Type", "application/json;charset=utf8");

    $coon=new mysqli('localhost','root','');
    $coon->set_charset("utf8");
 
    //获取json格式数据 并转化为数组格式
    $postData=file_get_contents('php://input');
    $request=json_decode($postData,true);
    // echo $postData;

    //获取数组中单个数据
    foreach($request as $k=>$v){
        if($k == 'id'){
            $id = "$v";
            echo $id;
        };
    };
    
    //创建数据库
    $sqlDB = "create database $id";
    if($coon->query($sqlDB)){
        echo 'success';
    }else{
        echo 'false';
    }

    //连接到数据库
    $mysqli=new mysqli('localhost','root','',$id);
    if($mysqli->connect_error){
        echo '失败';
    }else{
        echo '成功';
    };
    //创建购物车商品表
    $sqlTB = "CREATE TABLE shop_goods(
        id INT(20)PRIMARY KEY, 
        name VARCHAR(20) NOT NULL,
        tjremake VARCHAR(200) NOT NULL,
        imgurl VARCHAR(200),
        price VARCHAR(20),
        num INT(20)
        )";
    if ($mysqli->query($sqlTB)){
        echo 'successTB';
    }else{
        echo 'falseTB';
    }

    //创建地址表
    $sqlTBad = "CREATE TABLE address(
        id INT(10)AUTO_INCREMENT PRIMARY KEY, 
        prov VARCHAR(30) NOT NULL,
        city VARCHAR(30) NOT NULL,
        road VARCHAR(100),
        msg VARCHAR(100),
        name VARCHAR(100),
        phone INT(20),
        post INT(20),
        time VARCHAR(50) NOT NULL
        )";
    if ($mysqli->query($sqlTBad)){
        echo 'successTBad';
    }else{
        echo 'falseTBad';
    }

    //创建用户订单表
    $sqlTBor = "CREATE TABLE orde(
        id INT(20) NOT NULL, 
        name VARCHAR(20) NOT NULL,
        tjremake VARCHAR(200) NOT NULL,
        imgurl VARCHAR(200),
        price VARCHAR(20),
        num INT(20),
        time VARCHAR(50) NOT NULL,
        type VARCHAR(20) NOT NULL
        )";
    if ($mysqli->query($sqlTBor)){
        echo 'successTBor';
    }else{
        echo 'falseTBor';
    }

    //关闭数据库
    $mysqli->close();
    $coon->close();
?>
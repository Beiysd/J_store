<?php
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
    header("Content-Type", "application/json;charset=utf8");

    
 
    //获取json格式数据 并转化为数组格式
    $postData=file_get_contents('php://input');
    $request=json_decode($postData,true);
    // echo $postData;

    //获取数组中单个数据
    foreach($request as $k=>$v){
        if($k == 'id'){
            $id = "$v";
            // echo $id;
        };
        if($k == 'name'){
            $name = "$v";
            // echo $name;
        };
        if($k == 'tjremake'){
            $tjremake = "$v";
            // echo $tjremake;
        };
        if($k == 'imgurl'){
            $imgurl = "$v";
            // echo $imgurl;
        };
        if($k == 'price'){
            $price = "$v";
            // echo $price;
        };
        if($k == 'num'){
            $num = "$v";
            // echo $num;
        };
        if($k == 'dbId'){
            $dbId = "$v";
            // echo $dbId;
        };
    };

    //链接数据库
    $mysqli=new mysqli('localhost','root','',$dbId);
    $mysqli->set_charset("utf8");
    // if($mysqli->connect_error){
    //     echo '失败';
    // }else{
    //     echo '成功';
    // };
    

    //查询数据库
    $sel="select * from shop_goods where id = '$id'";
    $resel=$mysqli->query($sel);
    $numsel=mysqli_num_rows($resel);
    if($numsel == 1){
        $data = -1;
        echo $data;
    }else{
        // //插入数据库中
        if(!$name){
            // echo 'name = 0';
        }else{
            $sql = "insert into shop_goods (id,name,tjremake,imgurl,price,num) values ('$id','$name','$tjremake','$imgurl','$price','$num')";
        };

        $res = $mysqli->query($sql);
        // $num = mysqli_num_rows($res);
        // if($res){
        //     echo "插入成功";
        // }else{
        //     echo "false";
        // }
    }

    

    //关闭数据库
    $mysqli->close();
?>
<?php
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
    header("Content-Type", "application/json;charset=utf8");

    //链接数据库
    $mysqli=new mysqli('localhost','root','','goods');
    $mysqli->set_charset("utf8");
 
    //获取json格式数据 并转化为数组格式
    $postData=file_get_contents('php://input');
    $request=json_decode($postData,true);
    // echo $postData;

    //获取数组中单个数据
    foreach($request as $k=>$v){
        if($k == 'dbId'){
            $dbId = "$v";
            // echo $id;
        };
        if($k == 'id'){
            $id = "$v";
            // echo $id;
        };
        if($k == 'name'){
            $name = "$v";
            // echo $name;
        };
        if($k == 'password'){
            $password = "$v";
            // echo $tjremake;
        };
        if($k == 'email'){
            $email = "$v";
            // echo $imgurl;
        };
        if($k == 'phone'){
            $phone = "$v";
            // echo $price;
        };
    };

    //查询是否已存在
    $find = "select * from $dbId where name = '$name'";
    $resfind = $mysqli->query($find);
    $fnum = mysqli_num_rows($resfind);

    // //插入带数据库中
    if(!$name){

    }else if($fnum == 1){
        $data = 0;
        echo $data;
    }
    else{
        $sql = "insert into $dbId (id,name,password,email,phone) values ('$id','$name','$password','$email','$phone')";
        $res = $mysqli->query($sql);
        $data = 1;
        echo $data;
    };

    //关闭数据库
    $mysqli->close();
?>
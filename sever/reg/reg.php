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
        if($k == 'email'){
            $email = "$v";
            // echo $email;
        };
        if($k == 'phone'){
            $phone = "$v";
            // echo $phone;
        };
        if($k == 'username'){
            $name = "$v";
            // echo $name;
        };
        if($k == 'password'){
            $pass = "$v";
            // echo $pass;
        };
    };

    //查询是否已存在
    $find = "select * from user where name = '$name'";
    $resfind = $mysqli->query($find);
    $fnum = mysqli_num_rows($resfind);

    // //插入带数据库中
    if(!$name){
        // echo 'name = 0';
    }else if($fnum == 1){
        $data = 0;
        echo $data;
    }else{
        $sql = "insert into user (name,password,email,phone) values ('$name','$pass','$email','$phone')";
        $res = $mysqli->query($sql);
        // $num = mysqli_num_rows($res);
        // if($res){
        //     echo "插入成功";
        // }else{
        //     echo "false";
        // }
        $data = 1;
        echo $data;
    };

   

    //关闭数据库
    $mysqli->close();
?>
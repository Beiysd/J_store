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
        if($k == 'dbid'){
            $dbid = "$v";
            echo $dbid;
        };
        if($k == 'prov'){
            $prov = "$v";
            echo $prov;
        };
        if($k == 'city'){
            $city = "$v";
            echo $city;
        };
        if($k == 'road'){
            $road = "$v";
            echo $road;
        };
        if($k == 'msg'){
            $msg = "$v";
            echo $msg;
        };
        if($k == 'name'){
            $name = "$v";
            echo $name;
        };
        if($k == 'phone'){
            $phone = "$v";
            echo $phone;
        };
        if($k == 'post'){
            $post = "$v";
            echo $post;
        };
        if($k == 'time'){
            $time = "$v";
            echo $time;
        };
    };
    
    //连接到数据库
    $mysqli=new mysqli('localhost','root','',$dbid);
    $mysqli->set_charset("utf8");
    if($mysqli->connect_error){
        echo '失败';
    }else{
        echo '成功';
    };
    // //插入带数据库中
    if(!$prov){
        echo 'prov = 0';
    }else{
        $sql = "insert into address (prov,city,road,msg,name,phone,post,time) values ('$prov','$city','$road','$msg','$name','$phone','$post','$time')";
    };
    $res = $mysqli->query($sql);
    // $num = mysqli_num_rows($res);
    if($res){
        echo "插入成功";
    }else{
        echo "false";
    }

    //关闭数据库
    $mysqli->close();
    $coon->close();
?>
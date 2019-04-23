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
        if($k == 'id'){
            $name = "$v";
            // echo $id;
        };
        if($k == 'dbId'){
            $dbId = "$v";
            // echo $id;
        };
    };

    //查询是否存在
    $find = "select * from $dbId where name = '$name'";
    $res = $mysqli->query($find);
    $fnum = mysqli_num_rows($res);

    
    if($fnum == 0){
        $data = 0;
        echo $data;
    }
    else{
        $arr=array();
        while ($row=$res->fetch_assoc()) {
            $arr[] = $row; 
        }
        echo(json_encode($arr));
    };

    //关闭数据库
    $mysqli->close();
?>
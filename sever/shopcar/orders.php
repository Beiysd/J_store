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
            // echo $id;
        };
        if($k == 'time'){
            $time = "$v";
            // echo $id;
        };
    };
    
    //连接到数据库
    $mysqli=new mysqli('localhost','root','',$id);
    $mysqli->set_charset("utf8");
    // if($mysqli->connect_error){
    //     echo '失败';
    // }else{
    //     echo '成功';
    // };
    //查询time相同商品数据
    $sql="SELECT * FROM `orde` WHERE time = '$time'";
    $res=$mysqli->query($sql);
    $arr=array();
    while ($row=$res->fetch_assoc()){
        $arr[]=$row;
    };
    $res->free();
    echo(json_encode($arr));

    //关闭数据库
    $mysqli->close();
    $coon->close();
?>
<?php
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
    header("Content-Type", "application/json;charset=utf8");
    // header("Content-Type", "text/xml");
    $mysqli=new mysqli('localhost','root','','goods');
    $mysqli ->set_charset("utf8");
    $sql="select * from user";

    //获取json格式数据
    $postData = file_get_contents('php://input');
    $res = json_encode($postData,true);
    $request = json_decode($postData,true);


//获取axios发送的数据
foreach($request as $k=>$v){

    if($k == 'name'){
        $name = "$v";
        // echo $user;
    };
    // echo "$k --- $v <br />";
};
//查找符合条件的数据
$user="select * from user where name = '$name'";
$resuser=$mysqli->query($user);
$arr=array();
    while ($row=$resuser->fetch_assoc()) {
        $arr[] = $row;
    }
    echo(json_encode($arr));
    
//关闭连接
$mysqli->close();
?>

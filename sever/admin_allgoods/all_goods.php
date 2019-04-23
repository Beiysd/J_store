<?php
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
    header("Content-Type", "application/json;charset=utf8");
    // header("Content-Type", "text/xml");
    $mysqli=new mysqli('localhost','root','','goods');
    $mysqli ->set_charset("utf8");
   

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
    };

    $sql="select * from $dbId order by id asc";
    $res=$mysqli->query($sql);

    $arr=array();
        while ($row=$res->fetch_assoc()) {
            $arr[] = $row; 
        }


//关闭连接
$mysqli->close();
echo(json_encode($arr));
?>

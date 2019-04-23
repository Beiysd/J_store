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
    $s=serialize($postData);
    var_dump($s);
    // echo $postData;
    $arr=array();
    print_r($postData);
    
    //获取数组中单个数据
    foreach($request as $k=>$v){
        if($k == 'dbid'){
            $dbid = "$v";
            echo $dbid;
        };
        if($k == 'time'){
            $time = "$v";
            echo $time;
        };
        if($k == 'type'){
            $type = "$v";
            echo $type;
        };
    };


    // $r=json_decode($request['arr'],true);
    //连接到数据库
    $mysqli=new mysqli('localhost','root','',$dbid);
    $mysqli->set_charset("utf8");
    if($mysqli->connect_error){
        echo '失败';
    }else{
        echo '成功';
    };


//在二维数组中添加数据
    foreach($request['arr'] as $k=>$val){ 
        if ( $val == "" ) {
            continue;
        }
        //开始循环遍历给二维数组添加元素
        foreach ($val as $k2 => $val2) {
            $request['arr'][$k]['time']= $time;
            $request['arr'][$k]['type']= $type;
        }
     
    }
    print_r($request['arr']);

//拼接数据，添加至数据库中
    $userData = array();

    foreach ($request['arr'] as $key) {
        $userData[] = '("' . $key['id'] . '", "' . $key['name'] . '", "' . $key['tjremake'] . '", "' . $key['imgurl'] . '", "' . $key['price'] . '", "' . $key['num'] . '", "' . $key['time'] . '", "' . $key['type'] . '")';
    };
    $sql = 'INSERT INTO orde (id,name,tjremake,imgurl,price,num,time,type) VALUES' . implode(',', $userData);
    $res = $mysqli->query($sql);

    //关闭数据库
    $mysqli->close();
    $coon->close();
?>
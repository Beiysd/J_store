
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
            $dbid = "$v";
            // echo $dbid;
        };
    };
    
    //连接到数据库
    $mysqli=new mysqli('localhost','root','',$dbid);
    $mysqli->set_charset("utf8");
    // if($mysqli->connect_error){
    //     echo '失败';
    // }else{
    //     echo '成功';
    // };
   //升序并去重
   $sql="select time from (select * from orde order by time desc) as orde group by orde.time limit 0,9";
   $res=$mysqli->query($sql);
   $arr=array();
   while ($row=$res->fetch_assoc()) {
       $arr[]=$row;
   };

   $res->free();
   echo json_encode($arr);
//    $time1 = $arr[8];
//    $time2 = $arr[7];
//    $time3 = $arr[6];
//    $time4 = $arr[5];
//    $time5 = $arr[4];
//    $time6 = $arr[3];
//    $time7 = $arr[2];
//    $time8 = $arr[1];
//    $time9 = $arr[0];
//    echo json_encode(($time1));
//    echo json_encode(($time2));
//    echo json_encode(($time3));
//    echo json_encode(($time4));
//    echo json_encode(($time5));
//    echo json_encode(($time6));
//    echo json_encode(($time7));
//    echo json_encode(($time8));
//    echo json_encode(($time9));
    //关闭数据库
    $mysqli->close();
    $coon->close();
?>
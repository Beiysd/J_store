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

    if($k == 'username'){
        $user = "$v";
        // echo $user;
    };
    if($k == 'password'){
        $pass = "$v";
        // echo $pass;
    }
    // echo "$k --- $v <br />";
};

//查找用户是否存在
$username="select * from user where name = '$user'";
$resname=$mysqli->query($username);//结果插入字符集
$numname=mysqli_num_rows($resname);//不存在为0 存在为1

//查找密码是否存在
$password="select * from user where password = '$pass'";
$respas=$mysqli->query($password);//结果插入字符集
$numpas=mysqli_num_rows($respas);//不存在为0 存在为1

// //查找成功登陆的数据
// $user="select * from user where name = '$user' and password = '$pass'";
// $resuser=$mysqli->query($user);
// $arr=array();
//     while ($row=$resuser->fetch_assoc()) {
//         $arr[] = $row;
//     }
//     echo(json_encode($arr));


if($numname == 0){
    $data = -1;
    echo $data;
}else if ($numpas == 0) {
    $data = 0;
    echo $data;
}else{
    $data = 1;
    echo $data;
}


//关闭连接
$mysqli->close();
?>

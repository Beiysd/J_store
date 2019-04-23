<?php
    header("Access-Control-Allow-Origin:*");
    // header("Content-Type:text/html;charset:utf8");
    $mysqli=new mysqli('localhost','root','','goods');
    $mysqli ->set_charset("utf8");
    $sql="select * from all_goods";
    $res=$mysqli->query($sql);
    
    // if($mysqli){
    //     echo("success");
    // }else{
    //     echo("false");
    // }
    $arr=array();
    while ($row=$res->fetch_assoc()) {
        $arr[] = $row;
        // echo "id: ".$row["id"]." "; 
        // echo "name: ".$row["name"]." "; 
        // echo "tjremake： ".$row["tjremake"]." "; 
        // echo "imgurl: ".$row["imgurl"]." "; 
        // echo "price: ".$row["price"]." "; 
        // echo "<br/>"; 
    }
    
    $res->free();
    //关闭连接
    
    $mysqli->close();
    echo(json_encode($arr));
    
    ?>

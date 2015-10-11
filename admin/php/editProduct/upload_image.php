<?php
//-------------------------------------------------------------
//for product_management.html
//$.post by productAdd.js
//to get color
//-------------------------------------------------------------
require ('../../../includes/config.inc.php');
//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {

    header('content-type:text/html charset:utf-8');
    //$dir_base = "./files/";     //文件上传根目录
    $dir_base = "../../../img/productImg/";
    //没有成功上传文件，报错并退出。
    if(empty($_FILES)) {
        exit(0);
    }
 
    $output = "<textarea>";
    $index = 0;        //$_FILES 以文件name为数组下标，不适用foreach($_FILES as $index=>$file)
    foreach($_FILES as $file){
        $upload_file_name = 'upload' . $index;        //对应index.html FomData中的文件命名
        //$filename = $_FILES[$upload_file_name]['name'];
        $filename = (string)md5(uniqid(rand(), true)) . strrchr($_FILES[$upload_file_name]['name'], '.');
        //$gb_filename = iconv('utf-8','gb2312',$filename);    //名字转换成gb2312处理
        //文件不存在才上传
        if(!file_exists($dir_base.$filename)) { //was gb_filename
            $isMoved = false;  //默认上传失败
            $MAXIMUM_FILESIZE = 4 * 1024 * 1024;     //文件大小限制    1M = 1 * 1024 * 1024 B;
            $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i"; 
            if ($_FILES[$upload_file_name]['size'] <= $MAXIMUM_FILESIZE && 
                preg_match($rEFileTypes, strrchr($filename, '.'))) {    //was gb_filename
                $isMoved = @move_uploaded_file ( $_FILES[$upload_file_name]['tmp_name'], $dir_base.$filename);//gb_filename
                //上传文件
            }
        }else{
            $isMoved = true;    //已存在文件设置为上传成功
        }
        if($isMoved){
            //输出图片文件<img>标签
            //注：在一些系统src可能需要urlencode处理，发现图片无法显示，
            //    请尝试 urlencode($gb_filename) 或 urlencode($filename)，不行请查看HTML中显示的src并酌情解决。
            $output .= "<img src='img/productImg/{$filename}' title='{$filename}' alt='{$filename}' width='400px' height='100%' class='img-thumbnail'/>";
        }else {
            $output .= "上传失败!请检查文件大小或文件格式";
        }     
        $index++;
    }    
    echo $output."</textarea>";
}
?>
<?php
error_reporting(E_ALL ^ E_NOTICE);//����������
//     $conn=mysqli_connect("127.0.0.1","root","") or die("���ݿ���������Ӵ���".mysql_error());
     $conn=mysqli_connect("127.0.0.1","root","") or die("DB connection failed!".mysql_error());
     mysqli_select_db($conn,"dps") or die("DB connection failed!".mysql_error());
     //mysqli_query($conn,$sql);
date_default_timezone_set('PRC');
define('SYS_ROOT', str_replace("\\", '/', dirname(__FILE__)));
define('UP_ROOT', SYS_ROOT."/upfile/");
function cnsubstr($str, $start = 0, $length, $charset = "gb2312", $suffix = false)
{
    if (function_exists ( "mb_substr" ))
	return mb_substr ( $str, $start, $length, $charset );
    $re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all ( $re [$charset], $str, $match );
    $slice = join ( "", array_slice ( $match [0], $start, $length ) );
    if ($suffix)
	{
        return $slice . "��";
	}
	else
	{
    	return $slice;
	}
}
@extract($_POST);
@extract($_GET);
function get_name($id,$table)
{
	$sql="select * from $table where id=$id";
	$r=mysql_query($sql);
	$rows=mysql_fetch_array($r);

	return $rows[name];
}
function getfenlei($id,$reid){

	$sql="select * from categories where reid=0";
	$result=mysql_query($sql);
	echo '<select name="dalei" onchange="getCity(this.value)">';
	$i=1;
while($row=mysql_fetch_array($result))
{
	if($reid==''){
    	if($i==1)$initid=$row['id'];}
	else
		$initid=$id;
	if ($id==$row['id'])
	echo "<option value='".$row['id']."' selected>".$row['name']."</option>";
	else
	echo "<option value='".$row['id']."'>".$row['name']."</option>";
	$i++;
	}

	echo "</select>";
	//��ȡ�ӷ���

	 $sql1="select * from categories where reid='$initid'";
	 	$result1=mysql_query($sql1);

	 echo ' -> <select name="xiaolei">';
while($row1=mysql_fetch_array($result1))
	{
	  if($row1['id']==$reid)
	  echo "<option value='".$row1['id']."' selected>".$row1['name']."</option>";
	  else
	  echo "<option value='".$row1['id']."'>".$row1['name']."</option>";
	 }

 	 echo "</select>";


}
function rmkdir($path)
{
	if (!file_exists($path))
	{
		rmkdir(dirname($path));
		@mkdir($path, 0777);
	}
}

function upfile($inputname, $type, $file = null)
{
	$file_type = explode(".", $_FILES[$inputname]['name']);
	$suffix = $file_type[count($file_type) - 1];
	$n = date('YmdHis') . "." . $suffix;
	$z = $_FILES[$inputname];
	if ($z && $z['error'] == 0)
	{
		if (!$file)
		{
			rmkdir(UP_ROOT . '/' . "{$type}/");
			$file = "{$type}/{$n}";
			$path = UP_ROOT . '/' . $file;
		}
		else
		{
			rmkdir(dirname(UP_ROOT . '/' . $file));
			$path = UP_ROOT . '/' . $file;
		}
		move_uploaded_file($z['tmp_name'], $path);
		return $file;
	}
	return $file;
}
//��ҳ����.
function get_pager($url, $param, $count, $page = 1, $size = 10)
{
    $size = intval($size);
    if($size < 1)$size = 10;
    $page = intval($page);
    if($page < 1)$page = 1;
    $count = intval($count);

    $page_count = $count > 0 ? intval(ceil($count / $size)) : 1;
    if ($page > $page_count)$page = $page_count;

    $page_prev  = ($page > 1) ? $page - 1 : 1;
    $page_next  = ($page < $page_count) ? $page + 1 : $page_count;

    $param_url = '?';
    foreach ($param as $key => $value)$param_url .= $key . '=' . $value . '&';

    $pager['url']        = $url;
    $pager['start']      = ($page-1) * $size;
    $pager['page']       = $page;
    $pager['size']       = $size;
    $pager['count']		 = $count;
    $pager['page_count'] = $page_count;

	if($page_count <= '1')
	{
	    $pager['first'] = $pager['prev']  = $pager['next']  = $pager['last']  = '';
	}
	else
	{
		if($page == $page_count)
		{
			$pager['first'] = $url . $param_url . 'page=1';
			$pager['prev']  = $url . $param_url . 'page=' . $page_prev;
			$pager['next']  = '';
			$pager['last']  = '';
		}
		elseif($page_prev == '1' && $page == '1')
		{
			$pager['first'] = '';
			$pager['prev']  = '';
			$pager['next']  = $url . $param_url . 'page=' . $page_next;
			$pager['last']  = $url . $param_url . 'page=' . $page_count;
		}
		else
		{
			$pager['first'] = $url . $param_url . 'page=1';
			$pager['prev']  = $url . $param_url . 'page=' . $page_prev;
			$pager['next']  = $url . $param_url . 'page=' . $page_next;
			$pager['last']  = $url . $param_url . 'page=' . $page_count;
		}
	}
    return $pager;
}
?>

<?php
session_start();
include_once('./config/database.php');
include_once('./config/Pdb.php');
$_POST=$_REQUEST;
$db=Pdb::getDb();
if(isset($_POST['model'])){
	switch ($_POST['model']) {
		case 'search':
			$tag=false;
			$cardnum=isset($_POST['cardnum'])?$_POST['cardnum']:$tag=true;
			if($tag){
				print json_encode(array("code"=>2,"msg"=>"请填写必填项"));
				exit;
			}
			$sql="select * from  user where chinese=".$db->quote($cardnum)." or english =".$db->quote($cardnum);
			$rs=$db->getRow($sql,true);
			if(!$rs){
				$sql="insert into user set chinese=".$db->quote($cardnum).",type='Guest2015'";
				$db->execute($sql);
				$id=$db->lastInsertId;
				$rs=$db->getRow("select * from  user where id=".intval($id),true);
				print json_encode(array("code"=>1,"msg"=>$rs));
				exit;
			}
			if($rs['status']==1){
				print json_encode(array("code"=>4,"msg"=>"该用户已经签过到了"));
				exit;
			}
			$sql="update  user set status=1 where id=".$db->quote($rs['id']);
			$db->execute($sql);
			print json_encode(array("code"=>1,"msg"=>$rs));
			exit;
			break;

		case 'searchname':
			$tag=false;
			$cardnum=isset($_POST['cardnum'])?$_POST['cardnum']:$tag=true;
			if($tag){
				print json_encode(array("code"=>2,"msg"=>"请填写必填项"));
				exit;
			}
			if($cardnum==""){
				print json_encode(array("code"=>2,"msg"=>"请填写必填项"));
				exit;
			}
			$sql="SELECT chinese as name FROM `user` WHERE chinese like '%".$cardnum."%' union SELECT english as name FROM `user` WHERE english like '%".$cardnum."%' limit 5";
			$rs=$db->getAll($sql,true);
			print json_encode(array("code"=>1,"msg"=>$rs));
			exit;
			break;

		case 'count':
			$sql="select count(*) from  user  where  status=1";
			$rs=$db->getOne($sql);
			print json_encode(array("code"=>1,"msg"=>$rs));
			exit;
			break;
		case 'reset':
			$sql="update  user set status=0";
			$db->execute($sql);
			$sql="delete from  user where type='Guest2015'";
			$db->execute($sql);
			print json_encode(array("code"=>1,"msg"=>'清空完成'));
			exit;
			break;
		case 'test':
			for($i=20150001;$i<=20150680;$i++){
				echo "insert into user(cardnum,status,createtime) values('".$i."',0,'0000-00-00 00:00:00');<br>";
			}
			break;
		default:
			# code...
			print json_encode(array("code"=>9999,"msg"=>"No Model"));
			exit;
			break;
	}
}		
print "error";
exit;

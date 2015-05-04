<?php
session_start();
if(!isset($_SESSION['login_user'])){
	Header('Location:./login.html');
	exit;
}
include_once('./config/database.php');
include_once('./config/Pdb.php');
include_once('./config/Pager.class.php');
$db = Pdb::getDb();
$cardnum = isset($_GET['cardnum']) ? $_GET['cardnum'] : "";
$mobile = isset($_GET['moible']) ? $_GET['moible'] : "";
$where = isset($_GET['cardnum']) ? " and (cardnum like '%" . $_GET['cardnum'] . "%' or name like '%" . $_GET['cardnum'] . "%' or mobile like '%" . $_GET['cardnum'] . "%')" : "";
$type = isset($_GET['type']) ? $_GET['type'] : "";
$where .= isset($_GET['type']) ? " and type like '%" . $_GET['type'] . "%'" : "";
$status = isset($_GET['status']) ? $_GET['status'] : "";
$where .= isset($_GET['status']) ? " and status like '%" . $_GET['status'] . "%'" : "";
$rowcount = $db->getOne("SELECT count(*) as num FROM user where 1 $where");

$nowindex = 1;
if(isset($_GET['page'])){
    $nowindex = $_GET['page'];
}else if(isset($_GET["PB_Page_Select"])){
	$nowindex = $_GET["PB_Page_Select"];
}
$page = new Pager(array("nowindex" => $nowindex, "total" => $rowcount, "perpage" => 30, "style" => "page_break"));
$sql = "SELECT * FROM user where 1 $where  ORDER BY id  LIMIT $page->offset,30";
$rs = $db->getAll($sql,true);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/demo.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<title>Mercedes-Benz</title>
</head>

<body>
	<div class="container">
		<section>

			<h1 style="margin-bottom:50px; text-align:center ;color:#fff;">Mercedes-Benz</h1>
			
            <strong class="total">Total : <?php echo $rowcount;?></strong>
       		<div class="search">
       			<select id="type" value="<?php echo $type;?>">
	       			<option value="">选择类型</option>
	       			<option value="VIP" <?php if($type==='VIP') echo 'selected=selected'?>>VIP用户</option>
	       			<option value="普通用户" <?php if($type==='普通用户') echo 'selected=selected'?>>普通用户</option>
       			</select>
       			<select id="status" value="<?php echo $status;?>">
	       			<option value="">选择状态</option>
	       			<option value="0" <?php if($status==='0') echo 'selected=selected'?>>未签到</option>
	       			<option value="1" <?php if($status==='1') echo 'selected=selected'?>>已签到</option>
       			</select>
            	<input type="text" name="content" id="content" placeholder="你想找什么你告诉我吖" value="<?php echo $cardnum;?>"/>
            	<input type="button" value="Search"  class="search_btn" />
            	
       		</div>	

			<table id="example" class="display dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%; margin-bottom:30px">
				<thead style="color:#fff">
				<tr role="row">
					<th>ID</th>
					<th>NAME</th>
					<th>MOIBLE</th>
					<th>TYPE</th>
					<th>CARD-NUM</th>
					<th>STATUS</th>
					<th>CREATE-AT</th>
				</tr>
				</thead>

				<tbody>
				        
				<?php
				if(count($rs)==0){
					echo '<tr role="row" class="even"><td align="center" colspan=7>暂无数据</td></tr>';
				}else{
					for($i=0;$i<count($rs);$i++){
				?>
					<tr  role="row" class="<?php if($i%2==0) echo 'even'; else echo 'odd';?>">
					<td align="center"><?php echo $rs[$i]['id']; ?></td>
					<td align="center"><?php echo $rs[$i]['name']; ?></td>
					<td align="center"><?php echo $rs[$i]['mobile']; ?></td>
					<td align="center"><?php echo $rs[$i]['type']; ?></td>
					<td align="center"><?php echo $rs[$i]['cardnum']; ?></td>
					<td align="center"><?php if($rs[$i]['status']==1){ echo '<img src="images/clicked.png" width="15px" height="15px"/>'; } else{echo '<img src="images/unclicked.png" width="15px" height="15px"/>';} ?></td>
					<td align="center"><?php echo $rs[$i]['createtime']; ?></td>
					</tr>

					<?php     
					}
				}
				?> 

				</tbody>

			</table>

			<center style="color: #fff;"><?php echo $page->show(5);?></center> 
			<strong style="color: #fff;">Total : <?php echo $rowcount;?></strong> 

		</section>
	</div>



</body>




</body>
</html>
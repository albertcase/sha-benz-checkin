<?php
include_once('./config/database.php');
include_once('./config/Pdb.php');
include_once('./config/Pager.class.php');
$db = Pdb::getDb();
$where=isset($_GET['cardnum'])?" and cardnum like '%".$_GET['cardnum']."%'":"";
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

			<h1 style="margin-bottom:50px; text-align:center">Mercedes-Benz</h1>
			
            
       		<div class="search">
       
            	<input type="text" name="content" id="content" placeholder="你想找什么你告诉我吖" value=""/>
            	<input type="button" value="Search"  class="search_btn" />
            	
       		</div>	

			<table id="example" class="display dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%; margin-bottom:30px">
				<thead>
				<tr role="row">
					<th>ID</th>
					<th>CARD-NUM</th>
					<th>STATUS</th>
					<th>CREATE-AT</th>
				</tr>
				</thead>

				<tbody>
				        
				<?php
				if(count($rs)==0){
					echo '<tr  role="row" class="even"><td align="center" colspan=4>暂无数据</td></tr>';
				}else{
					for($i=0;$i<count($rs);$i++){
				?>
					<tr  role="row" class="<?php if($i%2==0) echo 'even'; else echo 'odd';?>">
					<td align="center"><?php echo $rs[$i]['id']; ?></td>
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

			<center><?php echo $page->show(5);?></center> 
			<strong>Total : <?php echo $rowcount;?></strong> 

		</section>
	</div>



</body>




</body>
</html>
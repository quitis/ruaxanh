<?php
$cur_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ );?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ );?>css/jquery-ui.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ );?>css/qstyle.css" type="text/css" media="screen" />
  <script src="<?php echo plugin_dir_url( __FILE__ );?>js/jquery-1.12.4.js"></script>
  <script src="<?php echo plugin_dir_url( __FILE__ );?>js/jquery-ui.js"></script>
  <script src="<?php echo plugin_dir_url( __FILE__ );?>js/ec_main.js"></script>
</head>
<body>
<div class="container">
  <h1>Danh sách người dùng đã tham gia events</h1>
	<br>
	<form action="<?php echo $cur_url ; ?>" method="get" id="form_client_list">
	<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
	<input type="hidden" name="export" id="client_export" value="0">
	<div class="row">
		<div class="col-sm-3">
			<label for="comment">Tên:</label>
			<input type="text" class="form-control" id="usr_name" name="usr_name" value="<?php echo isset($filter['usr_name'])?$filter['usr_name']:''; ?>">
		</div>
	<div class="col-sm-3">
		<label for="comment">Email:</label>
		<input type="text" class="form-control" id="usr_email" name="usr_email" value="<?php echo isset($filter['usr_email'])?$filter['usr_email']:''; ?>">
	</div>
	<div class="col-sm-3">
		<label for="comment">Điện thoại:</label>
		<input type="text" class="form-control" id="usr_phone" name="usr_phone" value="<?php echo isset($filter['usr_phone'])?$filter['usr_phone']:''; ?>">
	</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<label for="comment">Thời gian - từ ngày:</label>
			<input type="text" class="form-control" id="usr_datefrom" name="usr_datefrom" value="<?php echo isset($filter['date']['from'])?$filter['date']['from']:''; ?>"><span class="add-on"><i class="icon-th"></i></span>
		</div>
		<div class="col-sm-3">
			<label for="comment">Thời gian - đến ngày:</label>
			<input type="text" class="form-control" id="usr_dateto" name="usr_dateto" value="<?php echo isset($filter['date']['to'])?$filter['date']['to']:''; ?>">
		</div>
		<div class="col-sm-3">
			<div class="btn-group">
				<button type="button" class="btn btn-primary btn-search" id="search_client">Tìm</button>
			</div>
		</div>
	</div>
	</form>
	<div class="row">
		<button type="button" class="btn btn-warning btn-excel" id="export_csv">Xuất dữ liệu ra file CSV</button>
	</div>

	<br><br><br>
   <table class="table" id="qtable">
    <thead>
      <tr>
        <th>Tên khách hàng</th>
        <th>Email</th>
		 <th>Số điện thoại</th>
		 <th>Hình ảnh</th>
        <th>Thời gian</th>
		<th>Mã dự thưởng</th>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach( $clients as $client ){
	?>
	<tr>
	<td><?php echo $client->NAME; ?></td>
	<td><?php echo $client->EMAIL; ?></td>
	<td><?php echo $client->PHONE; ?></td>
	<td><img src="<?php echo $client->PHOTO; ?>" width="100px" /></td>
	<td><?php echo date('d/m/Y h:m A', strtotime($client->ADD_DATE)); ?></td>
	<td><?php echo $client->CODE; ?></td>
	</tr>
	<?php } ?>
    </tbody>
  </table>
	<div class="navigation">
		<ul>
				<?php echo $paging; ?>
		</ul>
	</div>
</div>
</body>
</html>
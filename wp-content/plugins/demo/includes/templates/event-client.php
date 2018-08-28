<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/qstyle.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
<div class="container">
  <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
   <table class="table" id="qtable">
    <thead>
      <tr>
        <th>Tên khách hàng</th>
        <th>Email</th>
        <th>Thời gian</th>
      </tr>
    </thead>
    <tbody>
	<?
	foreach( $clients as $client ):
	?>
	<tr>
	<td>John</td>
	<td>john@example.com</td>
	<td>27/08/2018 11:00 AM</td>
	</tr>
	<?endforeach?>
    </tbody>
  </table>
</div>
</body>
</html>
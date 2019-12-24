<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login with facebook using codeigniter - Mostlikers</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	.face{
		border-right: solid 1px #dedede;
		border-bottom: solid 1px #dedede;
		padding: 4px;
		background-color: #f7f7f7;;
		width: 200px;
		float: left;
		margin-top: 8px;
	}
	.content {
		float: right;
		width: 300px;
		margin-right: 5px;
	}
	.main_content
	{
		width: 582px;
		height: 236px;
	}
	</style>
</head>
<body>

<div id="container">
	<div id="body">	
		<div class="main_content">	
		<div class="face"><img src="https://graph.facebook.com/<?=$user_information->f_id;?>/picture?type=large"></div>
			<div class="content">
				<h2>Welcome to Mostlikers</h2>
				<p> Hi <?=$user_information->name;?></p>
				<p> Your Email : <?=$user_information->email;?></p><br>
				<a href="<?= site_url('welcome/logout');?>"><img src="<?php echo base_url(); ?>resource/images/logout.png" /></a>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- top -->
<ins class="adsbygoogle"
     style="display:inline-block;width:468px;height:60px"
     data-ad-client="ca-pub-9665679251236729"
     data-ad-slot="3177643029"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
		    </div>
	    </div>
	</div>
	<p class="footer"><a href="http://www.mostlikers.com/2015/04/login-with-facebook-using-codeigniter.html">Login with facebook using codeigniter</a> For more update <a href="http://www.mostlikers.com">www.mostlikers.com</a></p>
</div>

</body>
</html>
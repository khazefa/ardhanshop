	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
                            <div class="profile-usertitle-name"><a href="?page=user-list&act=edit&key=<?php echo $_SESSION['vUser']; ?>"><?php echo $_SESSION['vName']; ?></a></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="<?php echo $baseurl; ?>"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                        <li><a href="?page=customer-orders"><em class="fa fa-shopping-bag">&nbsp;</em> Customer Orders</a></li>
                        <li><a href="?page=payment-list"><em class="fa fa-credit-card">&nbsp;</em> Payment List</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-tags">&nbsp;</em> Items <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
                                    <li><a class="" href="?page=items">
                                            <span class="fa fa-arrow-right">&nbsp;</span> All Items
                                    </a></li>
                                    <li><a class="" href="?page=items-cat">
                                            <span class="fa fa-arrow-right">&nbsp;</span> Items Category
                                    </a></li>
                                    <li><a class="" href="?page=items-brand">
                                            <span class="fa fa-arrow-right">&nbsp;</span> Items Brand
                                    </a></li>
				</ul>
			</li>
                        <li><a href="?page=customer-list"><em class="fa fa-users">&nbsp;</em> Customer List</a></li>
                        <li><a href="?page=bank-acc"><em class="fa fa-bank">&nbsp;</em> Bank Accounts</a></li>
                        <li><a href="?page=courier-list"><em class="fa fa-truck">&nbsp;</em> Shipping</a></li>
                        <li><a href="?page=user-list"><em class="fa fa-user-md">&nbsp;</em> User List</a></li>
                        <li><a href="?page=list-pages"><em class="fa fa-sitemap">&nbsp;</em> Konten Website</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
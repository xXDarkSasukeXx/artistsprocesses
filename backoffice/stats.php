<?php
 require "../functions/headerAdmin.php";
 require "../functions/init.php";
?>


  <div class="row">

    <div class="col-md-12">
		<div class="skin-blue sidebar-mini" class="wrapper" style="height: auto;"> <!-- MAIN DIV -->

		  <header class="main-header">
		    <!-- Header Navbar: style can be found in header.less -->
		    <nav class="navbar navbar-static-top">
		      <!-- Sidebar toggle button-->
		      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		        <span class="sr-only">Toggle navigation</span>
		      </a>
		    </nav>
		  </header>

		  <div class="content-wrapper" style="min-height: 915px;">
		    <!-- Content Header (Page header) -->
		    <section class="content-header">
		      <h1>
		        Dashboard Admin
		        <small>Dev version</small>
		      </h1>
		    </section>

		    <!-- Main content -->
		    <section class="content">
		      <!-- Info boxes -->
		      <div class="row">
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          <div class="info-box">
		            <span class="info-box-icon bg-aqua"><i class="fa fa-picture-o" aria-hidden="true"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Artistes</span>
		              <span class="info-box-number">
		              <?php
		              	$db = connectBdd();
      					    // Fetch artist details
      					    $query = $db->prepare("SELECT * FROM users WHERE status = 1 AND is_admin = 0 AND is_verified = 1 AND is_deleted is null");
      					    $query->execute();
      					    $result = count($query->fetchAll());

      					    if(!empty($result)){
      					    	echo $result;
      					    }else{
      					    	echo "0";
      					    }
		              ?>
		              </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          <div class="info-box">
		            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Visiteurs</span>
		              <span class="info-box-number">
                    <?php
        					    $query = $db->prepare("SELECT * FROM users WHERE status = 0 AND is_admin = 0 AND is_verified = 1 AND is_deleted is null");
        					    $query->execute();
        					    $result = count($query->fetchAll());

        					    if(!empty($result)){
        					    	echo $result;
        					    }else{
        					    	echo "0";
        					    }
  		              ?>
                  </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		        </div>
		        <!-- /.col -->

		        <!-- fix for small devices only -->
		        <div class="clearfix visible-sm-block"></div>

		        <div class="col-md-3 col-sm-6 col-xs-12">
		          <div class="info-box">
		            <span class="info-box-icon bg-green"><i class="fa fa-book" aria-hidden="true"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Livres vendus</span>
		              <span class="info-box-number">
                    <?php
        					    $query = $db->prepare("SELECT * FROM purchased");
        					    $query->execute();
        					    $result = count($query->fetchAll());

        					    if(!empty($result)){
        					    	echo $result;
        					    }else{
        					    	echo "0";
        					    }
  		              ?>
                  </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        <div class="col-md-3 col-sm-6 col-xs-12">
		          <div class="info-box">
		            <span class="info-box-icon bg-yellow"><i class="fa fa-user-plus" aria-hidden="true"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Nouveau utilisateurs</span>
		              <span class="info-box-number">
                    <?php
        					    $query = $db->prepare("SELECT * FROM users WHERE is_admin = 0 AND is_verified = 1 AND :now - UNIX_TIMESTAMP(date_inserted) < :three_month AND is_deleted is null");
                      $query->execute([
                        "now"=>time(),
                        "three_month"=>7889400
                      ]);
        					    $result = count($query->fetchAll());

        					    if(!empty($result)){
        					    	echo $result;
        					    }else{
        					    	echo "0";
        					    }
  		              ?>
                  </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		      </div>
		      <!-- /.row -->

		      <div class="row">
		        <div class="col-md-12">
		          <div class="box">
		            <div class="box-header with-border">
		              <h3 class="box-title">Dernières modifications</h3>

		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		               <?php
						//Récupérer tous les utilisateurs de la bdd
						$result = $db->query('SELECT id, email, name, surname FROM users WHERE date_updated is not null AND is_deleted is null');
						//Afficher dans un tableau html les users
						echo "<div class='col-md-3'>
								<div class='col-md-12'>
									<strong>Email</strong>
								</div>
							  </div>
							  <div class='col-md-3'>
							  	<div class='col-md-12'>
									<strong>Nom</strong>
								</div>
							  </div>
							  <div class='col-md-3'>
							  	<div class='col-md-12'>
									<strong>Prénom</strong>
								</div>
							  </div>
							  <div class='col-md-3'>
							  	<div class='col-md-12'>
									<strong>Action</strong>
								</div>
							  </div>";
						while ($data = $result->fetch()) {

							echo"<div class='col-md-3'>
									<div class='col-md-12'>"
										.$data["email"].
								"	</div>
								</div>";
							echo"<div class='col-md-3'>
									<div class='col-md-12'>"
										.$data["name"].
								"	</div>
								</div>";
							echo"<div class='col-md-3'>
									<div class='col-md-12'>"
										.$data["surname"].
								"	</div>
								</div>";
							echo"<div class='col-md-3'>
									<div class='col-md-12'>
                    <a class='btn btn-default btn-lg' href='#'><i class='fa fa-eye' aria-hidden='true'></i></a>
  									<a class='btn btn-default btn-lg' href='#'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
								  </div>
								</div>";
						}
		               ?>
		            </div>

		            <!-- /.box-footer -->
		          </div>
		          <!-- /.box -->
		        </div>
		        <!-- /.col -->
		      </div>
		      <!-- /.row -->

		      <!-- Main row -->
          <div class="row">
		        <div class="col-md-12">
		          <div class="box">
		            <div class="box-header with-border">
		              <h3 class="box-title">Utilisateurs</h3>

		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		               <?php
						//Récupérer tous les utilisateurs de la bdd
						$result = $db->query('SELECT id, email, name, surname FROM users WHERE is_deleted is null');
						//Afficher dans un tableau html les users
						echo "<div class='col-md-3'>
								<div class='col-md-12'>
									<strong>Email</strong>
								</div>
							  </div>
							  <div class='col-md-3'>
							  	<div class='col-md-12'>
									<strong>Nom</strong>
								</div>
							  </div>
							  <div class='col-md-3'>
							  	<div class='col-md-12'>
									<strong>Prénom</strong>
								</div>
							  </div>
							  <div class='col-md-3'>
							  	<div class='col-md-12'>
									<strong>Action</strong>
								</div>
							  </div>";
						while ($data = $result->fetch()) {

							echo"<div class='col-md-3'>
									<div class='col-md-12'>"
										.$data["email"].
								"	</div>
								</div>";
							echo"<div class='col-md-3'>
									<div class='col-md-12'>"
										.$data["name"].
								"	</div>
								</div>";
							echo"<div class='col-md-3'>
									<div class='col-md-12'>"
										.$data["surname"].
								"	</div>
								</div>";
							echo"<div class='col-md-3'>
									<div class='col-md-12'>
									<a class='btn btn-default btn-lg' href='#'><i class='fa fa-eye' aria-hidden='true'></i></a>
									<a class='btn btn-default btn-lg' href='modify.php?id=".$data["id"]."' target='blank'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                  <a class='btn btn-default btn-lg btn-danger' href='delete.php?id=".$data["id"]."'><i class='fa fa-times' aria-hidden='true'></i></a>
									</div>
								</div>";
						}
		               ?>
		            </div>

		            <!-- /.box-footer -->
		          </div>
		          <!-- /.box -->
		        </div>
		        <!-- /.col -->
		      </div>
		      <!-- /.row -->
		    </section>
		    <!-- /.content -->
		  </div>
		  <!-- /.content-wrapper -->

		  <footer class="main-footer">
		    <div class="pull-right hidden-xs">
		      <b>Version</b> 1.0
		    </div>
		    <strong>Copyright © 2016-2017 <a href="https://www.artistsprocesses.com/">Artists Processes</a>.</strong> All rights
		    reserved.
		  </footer>
		  <!-- Add the sidebar's background. This div must be placed
		       immediately after the control sidebar -->
		  <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>

		</div>
		<!-- ./wrapper -->

		<!-- jQuery 2.2.3 -->
		<script async="" src="//www.google-analytics.com/analytics.js"></script><script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="../inc/bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- Sparkline -->
		<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- SlimScroll 1.3.0 -->
		<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- ChartJS 1.0.1 -->
		<script src="plugins/chartjs/Chart.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="dist/js/pages/dashboard2.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>


		<div class="jvectormap-label"></div>
    </div>
  </div>

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
              <span class="info-box-text">A vérifier</span>
              <span class="info-box-number">
                <?php
    					    $query = $db->prepare("SELECT * FROM users WHERE is_admin = 0 AND is_verified = 0 AND is_deleted is null");
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
				//Récupérer tous les utilisateurs de la bdd ayant effectués une modif
				$result = $db->query('SELECT id, email, name, surname FROM users WHERE date_updated is not null AND is_deleted is null AND is_admin != 1');
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
              <h3 class="box-title">Utilisateurs confirmés</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <?php
				//Récupérer tous les utilisateurs de la bdd
				$result = $db->query('SELECT id, email, name, surname FROM users WHERE is_deleted is null AND is_admin != 1');
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

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Utilisateurs à confirmer</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <?php
				//Récupérer tous les utilisateurs de la bdd ayant effectués une modif
				$result = $db->query('SELECT id, email, name, surname FROM users WHERE is_deleted is null AND is_admin != 1 AND is_verified = 0');
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
                <a class='btn btn-default btn-lg btn-success' href='verify.php?id=".$data["id"]."'><i class='fa fa-check' aria-hidden='true'></i></a>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<div class="jvectormap-label"></div>

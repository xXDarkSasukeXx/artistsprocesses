<div class="skin-blue sidebar-mini" class="wrapper artistlist" style="height: auto;"> <!-- MAIN DIV -->

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <div class="content-wrapper" style="min-height: 915px;">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Liste des utilisateurs</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
               <?php
        				//Récupérer tous les utilisateurs de la bdd
        				$result = $db->query('SELECT id, email, name, surname FROM users WHERE status=0 AND is_deleted is null');
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

          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<div class="jvectormap-label"></div>

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
      <div class="row artist_creation_box">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Création d'un Artiste</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <form method="POST" action="administration.php" class="createartists">
          			<div class="col-md-6 top-margin">
          				<div>
          					Prénom:
          				</div>
          				<div class="input-group">
          					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
          					<input type="text" class='form-control' placeholder="Name" name="name"  value="<?php echo (isset($form["name"]))?$form["name"]:"" ?>" >
          				</div>
          			</div>
          			<div class="col-md-6 top-margin">
          				<div>
          					Nom:
          				</div>
          				<div class="input-group">
          					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
          					<input type="text" class='form-control' placeholder="Surname" name="surname"  value="<?php echo (isset($form["surname"]))?$form["surname"]:"" ?>" >
          				</div>
          			</div>
          			<div class="col-md-6 top-margin">
          				<div>
          					Année de naissance:
          				</div>
          				<div class="input-group">
          					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
          					<input type="date" class='form-control' name="birthday" value="<?php echo (isset($form["birthday"]))?$form["birthday"]:"" ?>" >
          				</div>
          			</div>
          			<div class="col-md-6 top-margin">
          				<div>
          					Année de décès:
          				</div>
          				<div class="input-group">
          					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
          					<input type="date" class='form-control' name="deathday" value="<?php echo (isset($form["deathday"]))?$form["deathday"]:"" ?>" >
          				</div>
          			</div>
          			<div class="col-md-12 top-margin">
          				<div>
          					Scène:
          				</div>
          				<?php
          						foreach ($list_of_scenes as $key => $value) {
          								echo "<div class='radio-inline'><label>";
          								if(isset($form['scene']) && $form['scene']==$key){
          										echo "<input type='radio' checked='checked' name='scene' value='".$key."'>";
          								}else{
          										echo "<input type='radio' name='scene' value='".$key."'>";
          								}
          								echo $value;
          								echo "</div></label>";
          						}
          				?>
          			</div>
          			<div class="col-md-6 top-margin">
          				<div>
          					Date de reconnaissance:
          				</div>
          				<div class="input-group">
          					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
          					<input type="date" class='form-control' name="beginning" value="<?php echo (isset($form["beginning"]))?$form["beginning"]:"" ?>" >
          				</div>
          			</div>
          			<div class="col-md-6 top-margin">
          				<div>
          					Date de la fin de reconnaissance:
          				</div>
          				<div class="input-group">
          					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
          					<input type="date" class='form-control' name="ending" value="<?php echo (isset($form["ending"]))?$form["ending"]:"" ?>" >
          				</div>
          			</div>
          			<div class="col-md-12 top-margin">
          				<input type="submit" class='btn' value="Submit">
          			</div>
          	  </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Liste des artistes</h3>
              <a href="#" class="add_artists">
                  <div>
                  Ajouter un artiste
                  <i class="fa fa-user-plus" aria-hidden="true"></i>
                </div>
              </a>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
               <?php
        				//Récupérer tous les utilisateurs de la bdd
        				$result = $db->query('SELECT id, email, name, surname FROM users WHERE status=1 AND is_deleted is null');
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

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php echo '<form class="" action="upload.php?id='.$result['id'].'" method="post" enctype="multipart/form-data">' ?>
        Télécharger une image
        <input type="file" name="fileToUpload" id='fileToUpload'>
        <input type="submit" name="submit" value="Télécharger">
      </form>
    </div>
  </div>
</div>

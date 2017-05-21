<div class="container">
  <div class="row">
    <div class="col-md-12">
      <form action='send.php?id= <?php echo $_GET['id']; ?>' method='post'>
        <input type="text" name="object" placeholder="Objet..."><br>
        <textarea name="body" placeholder="Votre message..."></textarea><br>
        <input type="submit" value="Envoyer">
      </form>
    </div>
  </div>
</div>


  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
      <a href="modify.php?id=<?php echo (isset($_GET["id"]))?$_GET["id"]:""; ?>">MODIFY</a>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
      oklm
    </div>
    <div role="tabpanel" class="tab-pane" id="stats">
      oklm1
    </div>
    <div role="tabpanel" class="tab-pane" id="artists">
      oklm2
    </div>
    <div role="tabpanel" class="tab-pane" id="users">
      oklm3
    </div>
    <div role="tabpanel" class="tab-pane" id="followers">
      oklm4
    </div>
    <div role="tabpanel" class="tab-pane" id="following">
      oklm5
    </div>
    <div role="tabpanel" class="tab-pane" id="contact">
      <form action="contact.php?id=<?php echo (isset($_GET["id"]))?$_GET["id"]:""; ?>" method="post">
        <div>
            <label for="name">Nom :</label>
            <input type="text" name="name" />
        </div>
        <div>
            <label for="courriel">Courriel :</label>
            <input type="email" name="courriel" />
        </div>
        <div>
            <label for="object">Objet :</label>
            <input type="text" name="object" />
        </div>
        <div>
            <label for="body">Message :</label>
            <textarea name="body"></textarea>
        </div>
        
        <div class="button">
            <button type="submit">Envoyer votre message</button>
        </div>
      </form>

    </div>
  </div>
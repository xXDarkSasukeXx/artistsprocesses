function follow(idFollow){
  var request = new XMLHttpRequest();
  request.onreadystatechange = function(){
    if (request.readyState == 4 && request.status == 200) {
        alert("Félicitations vous suivez maintenant cet artiste");
    }
  };

  request.open("GET", "../functions/follow.php?id="+idFollow, true);
  request.send();
}

$(document).ready(function(){
  $('.add_artists').click(function(){
    $('.artist_creation_box').fadeIn('slow');
  })
});
function showArtists(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../functions/searchArtists.php?q=" + str, true);
        xmlhttp.send();
    }
}

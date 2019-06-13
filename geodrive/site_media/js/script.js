function iniciarMap(){
    var coord = {lat:18.5312003 ,lng: -88.3003506};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 18,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}
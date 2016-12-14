// Create the XHR object.
function createCORSRequest(method, url) {
  var xhr = new XMLHttpRequest();
  if ("withCredentials" in xhr) {
    // XHR for Chrome/Firefox/Opera/Safari.
    xhr.open(method, url, true);
  } else if (typeof XDomainRequest != "undefined") {
    // XDomainRequest for IE.
    xhr = new XDomainRequest();
    xhr.open(method, url);
  } else {
    // CORS not supported.
    xhr = null;
  }
  return xhr;
}

// Make the actual CORS request.
function makeCorsRequest() {
  // All HTML5 Rocks properties support CORS.
  var tags = document.getElementById("keywords").innerText;
  var url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=fa6059cb7324c6a70fa980b93a0ff732&tags='+tags+'&format=json&nojsoncallback=1';
  console.log(tags);
  console.log(url);
  var xhr = createCORSRequest('GET', url);
  xhr.responseType = 'json';
  if (!xhr) {
    alert('CORS not supported');
    return;
  };
  // Response handlers.
  xhr.onload = function() {
    var displayGal = document.getElementById("gal-photos");
    var json = xhr.response;
    var link = document.createElement("a");
    // Pour les photos de la galerie photos
    if(document.getElementById("gal-photos")){
      for(var i = 0; i < 4; i++)
      {
        var farm = json.photos.photo[i].farm;
        var server = json.photos.photo[i].server;
        var secret = json.photos.photo[i].secret;
        var id = json.photos.photo[i].id;
        var size = "b";
        var figure = document.createElement('figure');
        var legende = document.createElement('figcaption');
        var img = document.createElement("img");
        var link = document.createElement("a");
        img.setAttribute("height","auto");
        img.setAttribute("width","100%");
        img.setAttribute("src", "https://farm"+farm+".staticflickr.com/"+server+"/"+id+"_"+secret+"_"+size+".jpg");
        link.setAttribute("title",json.photos.photo[i].title);
        link.setAttribute("href","https://farm"+farm+".staticflickr.com/"+server+"/"+id+"_"+secret+"_"+size+".jpg");
        legende.innerHTML = json.photos.photo[i].title;
        link.appendChild(img);
        figure.appendChild(link);
        figure.appendChild(legende);
        displayGal.appendChild(figure);
      }
    }
  };

  xhr.onerror = function() {
    alert('Woops, there was an error making the request.');
  };

  xhr.send();
}
function getQueryParams(qs) {
    qs = qs.split('+').join(' ');

    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
    }

    return params;
}

$(document).ready(function(){
	makeCorsRequest();
});
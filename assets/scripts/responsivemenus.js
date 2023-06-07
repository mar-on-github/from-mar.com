function unrollbottombar() {
    var x = document.getElementById("mybottombar");
    if (x.className === "bottombar") {
        x.className += " responsive";
    } else {
        x.className = "bottombar";
    }
    console.log("fn unrollbottombar() triggered")
}

function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    // (document.getElementsByClassName("content")[0]).style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    // (document.getElementsByClassName("content")[0]).style.marginLeft = "0";
}

function TouchContentUnfocusfromMenu() {
    closeNav()
    document.getElementById("mybottombar").className = "bottombar";
}

var HttpClient = function () {
    this.get = function (aUrl, aCallback) {
        var anHttpRequest = new XMLHttpRequest();
        anHttpRequest.onreadystatechange = function () {
            if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
                aCallback(anHttpRequest.responseText);
        }

        anHttpRequest.open("GET", aUrl, true);
        anHttpRequest.send(null);
    }
}


var client = new HttpClient();
client.get('/accessibilityfilter', function (response) {
    let accessibilityfilter = response;
    console.log("filter:" + accessibilityfilter);
    switch (accessibilityfilter) {
        case 'contrast':
            document.body.style.filter = "contrast(1.75)";
            document.body.style.backgroundColor = "white";
            document.getElementById("filtertoggle").innerHTML = "Greyscale";
            break;
        case 'grayscale':
            document.body.style.filter = "grayscale(1)";
            document.body.style.backgroundColor = "#FFF0";
            document.getElementById("filtertoggle").innerHTML = "Colorful";
            break;
        default:
            document.body.style.filter = "none";
            document.body.style.backgroundColor = "";
            document.getElementById("filtertoggle").innerHTML = "Contrast";
            break;
    }
    
});


function ToggleFilters() {
    console.log(document.body.style.filter)
    const xhttpw = new XMLHttpRequest();
    switch (document.body.style.filter) {
        default:
            document.body.style.filter = "contrast(1.75)";
            document.body.style.backgroundColor = "white";
            document.getElementById("filtertoggle").innerHTML = "Greyscale";
            xhttpw.open("GET", "/?filter=contrast");
            xhttpw.send();
            break;
        case ("contrast(1.75)"):
            document.body.style.filter = "grayscale(1)";
            document.body.style.backgroundColor = "#FFF0";
            document.getElementById("filtertoggle").innerHTML = "Colorful";
            xhttpw.open("GET", "/?filter=grayscale");
            xhttpw.send();
            break;
        case ("grayscale(1)"):
            document.body.style.filter = "none";
            document.body.style.backgroundColor = "";
            document.getElementById("filtertoggle").innerHTML = "Contrast";
            xhttpw.open("GET", "/?filter=none");
            xhttpw.send();
            break;
}
}

document.body.style.filter = "none";
document.getElementById("filtertoggle").innerHTML = "Contrast/Greyscale";
document.getElementById("filtertoggle").style.padding = "10px";
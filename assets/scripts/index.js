function unrollbottombar() {
    var x = document.getElementById("mybottombar");
    if (x.className === "bottombar") {
        x.className += " responsive";
    } else {
        x.className = "bottombar";
    }
    console.log("fn unrollbottombar() triggered")
}
function permabigbadgies() {
    el = (document.getElementsByClassName('badgearea')[0])
    if (typeof (el) != 'undefined' && (el) != null) {
        el.style.minHeight = "fit-content";
        bigbadgies();
        return 1;
    } else return 0;
}
function openNav() {
    document.getElementById("mySidebar").style.width = "70vw";
    setTimeout(permabigbadgies, 2500);
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
            document.body.style.filter = "contrast(1.60)";
            document.body.style.backgroundColor = "#a29191";
            document.body.style.backgroundImage = "none";
            document.getElementById("filtertoggle").innerHTML = "Greyscale";
            break;
        case 'grayscale':
            document.body.style.filter = "grayscale(1)";
            document.body.style.backgroundColor = "#FFF0";
            document.body.style.backgroundImage = "none";
            document.getElementById("filtertoggle").innerHTML = "Colorful";
            break;
        default:
            document.body.style.filter = "none";
            document.body.style.backgroundImage = "";
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
            document.body.style.filter = "contrast(1.60)";
            document.body.style.backgroundColor = "#a29191";
            document.body.style.backgroundImage = "none";
            document.getElementById("filtertoggle").innerHTML = "Greyscale";
            xhttpw.open("GET", "/?filter=contrast");
            xhttpw.send();
            break;
        case ("contrast(1.60)"):
            document.body.style.filter = "grayscale(1)";
            document.body.style.backgroundColor = "#FFF0";
            document.body.style.backgroundImage = "none";
            document.getElementById("filtertoggle").innerHTML = "Colorful";
            xhttpw.open("GET", "/?filter=grayscale");
            xhttpw.send();
            break;
        case ("grayscale(1)"):
            document.body.style.filter = "none";
            document.body.style.backgroundColor = "";
            document.body.style.backgroundImage = "";
            document.getElementById("filtertoggle").innerHTML = "Contrast";
            xhttpw.open("GET", "/?filter=none");
            xhttpw.send();
            break;
}
}

document.body.style.filter = "none";
document.getElementById("filtertoggle").innerHTML = "Contrast/Greyscale";
document.getElementById("filtertoggle").style.padding = "10px";
// if (adsblocked) {
//     // if (true) {
//     // console.log("Adblock is detected. Maybe we should ask the user to donate once more, instead.");
//     document.getElementById('bmcdisabled').innerHTML = bmcwidget;
// } else {
//     // console.log("Ads are not blocked.");
//     if (typeof (document.getElementById('donateextralink')) != 'undefined' && (document.getElementById('donateextralink')) != null) {
//         document.getElementById('donateextralink').style.display = "none";
//     }
//     if (typeof (document.getElementById('donateextrasidebarlink')) != 'undefined' && (document.getElementById('donateextrasidebarlink')) != null) {
//         document.getElementById('donateextrasidebarlink').style.display = "none";
//     }
//     if (typeof (document.getElementsByClassName('badgearea')['0']) != 'undefined' && (document.getElementsByClassName('badgearea')['0']) != null) {
//         document.getElementsByClassName('badgearea')['0'].style.marginBottom = "30px"
//     }
// }

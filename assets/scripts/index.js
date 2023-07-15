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
    elem = document.getElementsByClassName("search-button")[0];
    if (typeof (elem) != 'undefined' && (elem) != null) {
        elem.classList.add("not-on-mobile");
        return 1;
    }
    // (document.getElementsByClassName("content")[0]).style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "";
    elem = document.getElementsByClassName("search-button")[0];
    if (typeof (elem) != 'undefined' && (elem) != null) {
        elem.classList.remove("not-on-mobile");
    }
    elem = document.getElementsByClassName("pageinfosidebar")[0];
    if (typeof (elem) != 'undefined' && (elem) != null) {
        elem.style.width = "70vw";
    }
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
client.get('/sociallinks', function (response) {
    sociallinkelements = document.getElementsByClassName("sociallinks");
    for (var i = sociallinkelements.length - 1; i >= 0; i--) {
        sociallinkelementnew = document.createElement("div");
        sociallinkelementnew.setAttribute("style", "text-align: center; align-content: center; margin-left: auto; margin-right: auto;");
        sociallinkelementnew.innerHTML = response;
        sociallinkelements.item(i).parentNode.replaceChild(sociallinkelementnew, sociallinkelements.item(i));
    }
})

function LoadImgMote(currimgmote) {
    var client = new HttpClient();
    let name = (currimgmote.innerHTML).replace(":", ".");
    client.get('/?getimgmote=' + name, function (response) {
        var newimgmote = document.createElement("img");
        newimgmote.setAttribute("style", "max-width: 16px; max-height: 16px");
        newimgmote.setAttribute("loading", "lazy");
        newimgmote.setAttribute("alt", ":" + name + ":-imgmote.");
        newimgmote.classList.add("imgmote");

        newimgmote.src = response;
        currimgmote.parentNode.replaceChild(newimgmote, currimgmote);
    });
}

imgmotes = document.getElementsByTagName("imgmote");
for (var i = imgmotes.length - 1; i >= 0; i--) {
    LoadImgMote(imgmotes.item(i));

}

var client = new HttpClient();
client.get('/accessibilityfilter', function (response) {
    let accessibilityfilter = response;
    // console.log("filter:" + accessibilityfilter);
    switch (accessibilityfilter) {
        case 'contrast':
            document.body.style.filter = "contrast(1.6)";
            document.body.style.backgroundColor = (getComputedStyle(document.body).getPropertyValue('--filter-contrast-backgroundcolor'));
            document.body.style.backgroundImage = "none";
            document.getElementById("filtertoggle").innerHTML = "Greyscale";
            break;
        case 'grayscale':
            document.body.style.filter = "grayscale(1)";
            document.body.style.backgroundColor = (getComputedStyle(document.body).getPropertyValue('--filter-grayscale-backgroundcolor'));
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
            document.body.style.filter = "contrast(1.6)";
            document.body.style.backgroundColor = (getComputedStyle(document.body).getPropertyValue('--filter-contrast-backgroundcolor'));
            document.body.style.backgroundImage = "none";
            document.getElementById("filtertoggle").innerHTML = "Greyscale";
            xhttpw.open("GET", "/?filter=contrast");
            xhttpw.send();
            break;
        case ("contrast(1.6)"):
            document.body.style.filter = "grayscale(1)";
            document.body.style.backgroundColor = (getComputedStyle(document.body).getPropertyValue('--filter-grayscale-backgroundcolor'));
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

// The battle for buymeacoffee
setInterval(function () {
    if ((typeof (document.getElementById("bmc-wbtn")) !== 'undefined') && ((document.getElementById("bmc-wbtn")) !== null)) {
        (document.getElementById("bmc-wbtn")).removeAttribute("style");
        // (document.getElementById("bmc-wbtn")).style.display = "none";
    } else {
        console.log("could not find bmc");
    }
}, 3000);
setTimeout(function () {
if ((typeof (document.getElementById("oneko")) == 'undefined') || ((document.getElementById("oneko")) == null)) {
    document.getElementById("kittontoggle").remove();
    console.log("oneko is not here.")
} else {
    var client = new HttpClient();
    client.get('/kittonstatus', function (response) {
        let wantkitton = response;
        if (wantkitton == false) {
            (document.getElementById("oneko")).style.display = "none";
            (document.getElementById("kittontoggletext")).innerText = "show!";
        } else {
            (document.getElementById("kittontoggletext")).innerText = "hide..";
        }
    });
}}, 1500);
function ToggleKitton() {
    var kitton = (document.getElementById("oneko"));
    const xhttpw = new XMLHttpRequest();
    switch (kitton.style.display) {
        case 'none':
            kitton.style.display = "";
            (document.getElementById("kittontoggletext")).innerText = "hide..";
            xhttpw.open("GET", "/?kitton=1");
            xhttpw.send();
            break;

        default:
            kitton.style.display = "none";
            (document.getElementById("kittontoggletext")).innerText = "show!";
            xhttpw.open("GET", "/?kitton=0");
            xhttpw.send();
            break;
    }
}
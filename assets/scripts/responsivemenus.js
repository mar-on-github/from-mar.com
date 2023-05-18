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

function ToggleFilters() {
    console.log(document.body.style.filter)
    switch (document.body.style.filter) {
        default:
            document.body.style.filter = "sepia(0.7)";
            document.body.style.backgroundColor = "#BD6F22";
            document.getElementById("filtertoggle").innerHTML = "Greyscale";
            break;
        case ("sepia(0.7)"):
            document.body.style.filter = "grayscale(1)";
            document.body.style.backgroundColor = "#FFF0";
            document.getElementById("filtertoggle").innerHTML = "Colorful";
            console.log("yes");
            break;
        case ("grayscale(1)"):
            document.body.style.filter = "none";
            document.body.style.backgroundColor = "";
            document.getElementById("filtertoggle").innerHTML = "Sepia";
            break;
}
}

document.body.style.filter = "none";
document.getElementById("filtertoggle").innerHTML = "Sepia";
document.getElementById("filtertoggle").style.padding = "10px";
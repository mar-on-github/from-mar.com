    function makehideable() {
      (document.getElementsByClassName('pageinfosidebar')[0]).setAttribute("onmouseover", "HidePageInfo(0);");
    //   (document.getElementsByClassName('pageinfosidebar')[0]).setAttribute("onclick", "HidePageInfo(1);");
    window.addEventListener('click', function (e) {
    if (document.getElementById('authorthumbnail').contains(e.target)) {
        setTimeout(() => {ReshowPageInfo}, '1800');
    } else { if (((document.getElementsByClassName('pageinfosidebar')[0])).contains(e.target)) { 
        HidePageInfo(1);
    }
    }
});
      (document.getElementsByClassName('pageinfosidebar')[0]).setAttribute("onmouseout", "");
    }
    function showpageinfo() {
      (document.getElementsByClassName('pageinfosidebar')[0]).style.opacity = "15%";
      (document.getElementsByClassName('pageinfosidebar')[0]).style.transition = "all 3s ease-out";
      setTimeout(() => { (document.getElementsByClassName('pageinfosidebar')[0]).style.opacity = "100%"; }, '3000');
      setTimeout(makehideable(), '4000');
    }
    showpageinfo();
    function HidePageInfo(permanent) {
      (document.getElementsByClassName('pageinfosidebar')[0]).style.transition = "all 1.5s ease-out";
      if (permanent) {
      (document.getElementsByClassName('pageinfosidebar')[0]).style.opacity = "0%";
      setTimeout(() => { (document.getElementsByClassName('pageinfosidebar')[0]).style.display = "none"; }, '1700');
      } else {
        (document.getElementsByClassName('pageinfosidebar')[0]).style.opacity = "10%";
        (document.getElementsByClassName('pageinfosidebar')[0]).setAttribute("onmouseout", "showpageinfo();");
      }
    }
    function ReshowPageInfo() {
        console.log("Reshow()..")
        (document.getElementsByClassName('pageinfosidebar')[0]).style.display = "";
        showpageinfo();
    }


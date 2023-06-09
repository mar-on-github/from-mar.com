if (typeof blockAdBlock === "undefined") { adsblocked = true; 
    console.log("BAB couldn't load.") } else {
  blockAdBlock.onDetected(() => {adsblocked = true;
      console.log("BAB reported 'detected'.") });
  blockAdBlock.onNotDetected(() => console.log("BAB reported 'not detected'!"));
}
if (typeof (domain_url) == 'undefined' || (domain_url) != 'adfoc.us') {
    adsblocked = true;
    console.log("Something kept adfoc.us from setting its variables, marking this as adblock detected.")
}
window.addEventListener("load", () => {
    let test = new Request(
        // "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js",
        "https://static.ads-twitter.com/uwt.js",
        // "https://adfoc.us/js/fullpage/script.js",
        { method: "HEAD", mode: "no-cors" }
    );
    fetch(test)
        .then(res => console.log("test request worked!"))
        .catch(err => {adsblocked = true;
        console.log("test request failed: " + err)});
});
if (typeof (adsblocked) == 'undefined' || (adsblocked) == null) {
    adsblocked = false;
}
let bmcwidget = '<script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="JustMarOK" data-description="Support me on Buy me a coffee!" data-message="" data-color="#FF813F" data-position="Right" data-x_margin="18" data-y_margin="18"></script>';
if (adsblocked) { console.log("adsblocked: true"); } else { console.log("adsblocked: false") };

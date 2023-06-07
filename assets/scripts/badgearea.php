<div class="badgearea">
    <p>Badgies
<?php
    imgmote("love3");echo "</p>";
    $badges = array(
    badge("https://yesterweb.org/no-to-web3/", "https://yesterweb.org/no-to-web3/img/roly-saynotoweb3.gif", "Crypto's ewie.", "badge saying 'Keep the web free, say no to web3'"),
    badge("https://minecraft.net/", "/assets/img/badges/minecraft.gif", "block game good", "minecraft"),
    badge("https://www.mozilla.org/nl/firefox/new/?redirect_source=firefox-com", "/assets/img/badges/getfirefox.gif", "GET FIREFOX!!", "Get Firefox"),
    badge("","/assets/img/badges/fucknazis.gif","FUCK NAZI's!","Fuck nazis"),
    badge("","/assets/img/badges/blinkiesCafe-autism.gif", "brain go brrr", "autism"),
    badge("https://www.tumblr.com/strawmelonjuice","/assets/img/badges/blinkiesCafe-tumblr-grrll.gif", "Tumblr Tumblr Tumblr", "Tumblr"),
    badge("", "/assets/img/badges/linux80x15.png", "team linux heheh", "Run linux"),
    badge("", "/assets/img/badges/feminism.gif", "intersectional feminism!", "feminism"),
    badge("https://php.net/","/assets/img/badges/php_copy1.gif", "This website runs on PHP8", "PHP powered"),
    badge("https://ubuntu.com/", "/assets/img/badges/ubuntubutton.png","Ubuntu is by far the most intuitive Linux distro, go try it!","Ubuntu"),
    );

    shuffle($badges);

    foreach ($badges as $badge) {
        echo $badge;
}
?>
</div>
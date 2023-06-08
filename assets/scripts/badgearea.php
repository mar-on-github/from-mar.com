<div class="badgearea">
    <p>Badgies<?php imgmote("love3");?><small style="font-size: 8px">(they r random)</small></p>
<?php
    $badges = array(
    badge("https://yesterweb.org/no-to-web3/", "https://yesterweb.org/no-to-web3/img/roly-saynotoweb3.gif", "Crypto's ewie.", "badge saying 'Keep the web free, say no to web3'"),
    badge("https://minecraft.net/", "/assets/img/badges/minecraft.gif", "block game good", "minecraft"),
    badge("https://www.mozilla.org/nl/firefox/new/?redirect_source=firefox-com", "/assets/img/badges/getfirefox.gif", "GET FIREFOX!!", "Get Firefox"),
    badge("","/assets/img/badges/fucknazis.gif","FUCK NAZIS!","Fuck nazis"),
    badge("/assets/img/badges/blinkiesCafe-autism.gif","/assets/img/badges/blinkiesCafe-autism.gif", "brain go brrr", "autism"),
    badge("/assets/img/badges/blinkiesCafe-L1.gif", "/assets/img/badges/blinkiesCafe-L1.gif", "AUTISM!", "autism"),
    badge("", "/assets/img/badges/y2k-compliant.gif", "We survived! Or... well this site is from 2023. uhm.", "Y2K-compliant"),
    badge("", "/assets/img/badges/transles80×31.png", "I'm trans, and girls", "trans-lesbian flag"),
    badge("https://www.tumblr.com/strawmelonjuice","/assets/img/badges/blinkiesCafe-tumblr-grrll.gif", "Tumblr Tumblr Tumblr", "Tumblr"),
    badge("", "/assets/img/badges/linux80x15.png", "team linux heheh", "Run linux"),
    badge("", "/assets/img/badges/feminism.gif", "intersectional feminism!", "feminism"),
    badge("https://php.net/","/assets/img/badges/php_copy1.gif", "This website runs on PHP8", "PHP powered"),
    badge("https://ubuntu.com/download/desktop/", "/assets/img/badges/ubuntubutton.png","Ubuntu is by far the most intuitive Linux distro, go try it!","Ubuntu"),
    badge("", "/assets/img/badges/antinft.gif","NFTs are thrash, and a perfect way to spend money on destroying the world.","anti-nft's"),
    );

    shuffle($badges);
    $maxbadges = 9;
    $count = 0;
    foreach ($badges as $badge) {
        $count = $count + 1;
        if ($count > $maxbadges) break;
        echo $badge;
}
?>
</div>
<a href="/?p=support" id="donateextrasidebarlink"><span class="emoji-block">💸</span> Support me</a>
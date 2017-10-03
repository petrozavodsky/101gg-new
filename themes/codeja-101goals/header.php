<?php
/**
 * Build By:
 * www.CODEJA.net - Turning imagination into creation
 *
 * Team Member:
 * Full Name: Kirill Lavrishev
 * Contact Information: #0526142466 / k@codeja.net
 *
 * File Details:
 * Date of creation: 28-Sep-16 / 13:08
 * Last updated: 28-Sep-16 / 13:08 By Kirill Lavrishev
 *
 */
error_reporting(0);
 ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?></title>
	<?php wp_meta(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=medium">
    <meta property="fb:app_id" content="345296042591084">
    <meta property="fb:admins" content="KirillLavrishev120"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri() . '/images/fav.png' ?>"/>
    <?php
    if ( is_post_type_archive( 'videosfeeds' ) ) {
        echo '
        <meta name="description" content="The 101 Great Goals football videos feed is constantly updated with the best content from Facebook, Instagram, Twitter & YouTube. Don\'t miss a great goal!">
        <meta property="og:description" content="The 101 Great Goals football videos feed is constantly updated with the best content from Facebook, Instagram, Twitter & YouTube. Don\'t miss a great goal!">
        <meta name="twitter:description" content="The 101 Great Goals football videos feed is constantly updated with the best content from Facebook, Instagram, Twitter & YouTube. Don\'t miss a great goal!">
        ';
    }
    ?>
    <?php wp_head(); ?>

    <!-- GOOGLE ANALYTICS CODE -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-17041736-1', 'auto');

        // ADN Tracker
        ga('create', 'UA-17041736-5', 'auto', 'ADN_Tracker');

        ga('send', 'pageview');
        ga('ADN_Tracker.send', 'pageview');

    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1821170621460215'); // Insert your pixel ID here.
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1821170621460215&ev=PageView&noscript=1"
        /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->


    <!-- FOR AD BLOCK USERS -->
    <script>
        (function(){try{window.btoa||(window.btoa=function(a){a=String(a);for(var d,e,b=0,g="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",f="";a.charAt(b|0)||(g="=",b%1);f+=g.charAt(63&d>>8-b%1*8)){e=a.charCodeAt(b+=.75);if(255<e)return!1;d=d<<8|e}return f});
            window.atob||(window.atob=function(a){a=String(a).replace(/=+$/,"");if(1==a.length%4)return!1;for(var d=0,e,b,g=0,f="";b=a.charAt(g++);~b&&(e=d%4?64*e+b:b,d++%4)?f+=String.fromCharCode(255&e>>(-2*d&6)):0)b="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(b);return f});
            function c(a){if(window.TextEncoder)return(new window.TextEncoder("utf-8")).encode(a).buffer;a=unescape(encodeURIComponent(a));for(var d=new Uint8Array(a.length),e=0;e<a.length;e++)d[e]=a.charCodeAt(e);return d.buffer}
            function w(a){if(window.TextDecoder)return(new window.TextDecoder("utf-8")).decode(a);try{return decodeURIComponent(escape(String.fromCharCode.apply(null,new Uint8Array(a))))}catch(g){var d="";a=new Uint8Array(a);for(var e=a.byteLength,b=0;b<e;b++)d+=String.fromCharCode(a[b]);return decodeURIComponent(escape(d))}}
            function x(a){this.v=[];this.w=256;for(var d=0;d<this.w;d++)this.v[d]=a.charCodeAt(d%a.length);this.D=function(a){for(var b="",d=0;d<a.length;d++)b+=String.fromCharCode(a.charCodeAt(d)^this.v[d%this.w]);return b}}var y=new x("zj4DertNdAg7J!3DpH28QahKf3S0NEkN");function z(a,d){!1!==d&&(a=atob(a));return y.D(a)}function A(a){for(var d={},e=Object.keys(a),b=0;b<e.length;b++)d[e[b].toLowerCase()]=a[e[b]];return d}
            function B(a,d,e,b){var g=!1,f=!1,l=c(JSON.stringify({url:d.url||"",method:d.method||"GET",headers:d.headers||{},body:null}));a.onopen=function(){a.send(l)};var k=new ArrayBuffer(0),h;a.onmessage=function(a){if(!1===g)g=!0,a=w(a.data),h=JSON.parse(a),h.headers=h.headers?A(h.headers):{},h={status:h.status||0,headers:h.headers||{}};else{a=a.data;var b=new Uint8Array(k.byteLength+a.byteLength);b.set(new Uint8Array(k),0);b.set(new Uint8Array(a),k.byteLength);k=b.buffer}};a.onerror=function(){f=!0;b&&
            b(Error())};a.onclose=function(){f||(g?(h.body=k,e&&e(h)):(f=!0,b&&b(Error())))}}function C(a){if(!a||!a.j)throw Error();this.j=a.j;this.b=null}C.prototype.a=function(a,d,e){var b=new this.j(z("DRlHfkpd")+z("G0RcLRcdAicSKElUJUw=")+z("VR1HNA=="));b.binaryType=z("GxhGJRwQASgCJBU=");this.b=b;B(b,a,d,e)};C.prototype.c=function(){return this.b};C.prototype.name=function(){return"1"};function D(a){if(!(a&&a.h&&a.i&&a.g))throw Error();this.h=a.h;this.i=a.i;this.g=a.g;this.b=null}
            D.prototype.a=function(a,d,e){var b=z("GRhRJREXOygCJBU="),g=z("CQ9ACAoRFSIgJBRUOEhDMBknXA=="),f=z("CQ9AFgAfGzoBBQJEKVNaNAQhXVY="),l=z("GRhRJREXMC8QICRfK09dIRw="),k=z("Gw5QDQYXNy8KJQ5TK1VW"),h=z("FQRdJwARFSAAKANWPkQ="),u=z("GQtaIAwWFToB"),m=this.h,n=this.i,q=this.g,v=z("PF8OBSdITHdeBFMNfhAJfUFyBQFrUltxVgFpcnZ/XA9AX3Z+IENOCFF7UwFwFnZ+Ng0IDRdbWn9cCxUKDABRej9QBwdfNzd0U3ldB3wbBndKCQACYidSfycJZAl0fFM="),p={};p[z("DxhYNw==")]=[z("CR5BKl8=")+(z("G0RcLRcdAicSKElUJUw=")+":"+z("TFoEdQ=="))];var r={};r[z("EwlRFwAAAisWMg==")]=
                [p];var t=new m(r);t[l](z("VQdRMARdBCcKJg==")).binaryType=z("GxhGJRwQASgCJBU=");t[h]=function(a){if(null!=a[u]&&(a=a[u][u].match(new RegExp(z("JAlVKgEbEC8QJF1rLgoTGBRjEhBuWx0vFk8GdB5sSxIeQRRsORZfEkodAxwWD28gWxQcZDVKSBcCGHoQOjwbbgkYUigd"))),null!=a)){var b={};b[z("GQtaIAwWFToB")]=z("GQtaIAwWFToBe1cXewFmACBoAAllVlxzVQVnB24=")+a[1]+z("Wh5NNEUaGz0Q");b[z("CQ5ECSkbGistLwNSMg==")]=0;t[k](new q(b),function(){},function(){})}};var N=z("DFcETgpPAT0BMwlWJ0QTdFB4EnEfQSEbUhNiAnlrW2BKRAVOFk8HKxcyDlgkT1IpFUJRBRgvSAI2B3MBfHJFflRaGnVvBkl+RHFtVndHWioXLUBIIwgGP1xAO1Fjd154Wg==")+
                v+z("cAsJLQYXWSEUNQ5YJFIJMAIhUVM9BGImW1IjQCIsCC8OA1sqRUNGfVBhI2MGchwXMxxiGGRRWHtsUm5DLTEbIxsaDnFVQkRuEyQFRT5CHiARPFNbOQAGJQNfcwJ7c2EvRwNXIUgHEjwFJl0=")+function(){for(var a="",b=0;16>b;++b)var d=(4294967296*Math.random()>>>0).toString(16),a=a+("00000000".substring(0,8-d.length)+d);return a}()+z("cAsJLQYXWT4TJV0HehEDdEB4AghhUVh7VgNjAH51W35KWgR0VUJEflRxVz0=");t[b](function(a){t[g](a,function(){var a={};a[z("DhNEIQ==")]=z("GwRHMwAA");a[z("CQ5E")]=N;t[f](new n(a),function(){},function(){})},function(){})},
                function(){});b=t[l](z("VR1HNGU=")+window.navigator.userAgent);b.binaryType=z("GxhGJRwQASgCJBU=");this.b=t;B(b,a,d,e)};D.prototype.c=function(){return this.b};D.prototype.name=function(){return"2"};function E(a){if(!a||!a.l)throw Error();this.l=a.l}
            E.prototype.a=function(a,d,e){var b=this.l,g=a.url||"";if(1>g.length||"/"!=g[0])g="/"+g;var g=("https:"==window.location.protocol?"https://":"http://")+z("AgJGag0bBiESKBFeZEJcKQ==")+g,f=a.method||"GET";a=a.headers||{};var l=!1,k=new b;k.onreadystatechange=function(){if(4==k.readyState)if(0==k.status)l||(l=!0,e&&e(Error()));else{var a=k.status;var b=k.getAllResponseHeaders(),f={};if(b)for(var b=b.split(atob("XHJcbg==")),g=0;g<b.length;g++){var h=b[g],p=h.indexOf(": ");if(0<p){var r=h.substring(0,p),
                h=h.substring(p+2);f[r]||(f[r]=[]);f[r].push(h)}}a={status:a,headers:A(f),body:k.response};d&&d(a)}};k.onerror=function(){l||(l=!0,e&&e(Error()))};k.open(f,g,!0);k.responseType=z("GxhGJRwQASgCJBU=");for(var h in a)a.hasOwnProperty(h)&&k.setRequestHeader(h,a[h]);k.send(null)};E.prototype.c=function(){return null};E.prototype.name=function(){return"0"};function F(a){this.o=a;this.f=null}
            F.prototype.a=function(a,d,e){function b(b){return function(){function e(a){200>a.status||300<=a.status?f.shift()():(g.f=b,d&&d(a))}try{b.a(a,e,function(){f.shift()()})}catch(u){f.shift()()}}}for(var g=this,f=[],l=0;l<this.o.length;l++)f.push(b(this.o[l]));f.push(function(){e&&e(Error())});f.shift()()};F.prototype.c=function(){return this.f?this.f.c():null};F.prototype.name=function(){return this.f?this.f.name():""};function G(){return Date.now()>this.startTime+4E3}
            function H(){this.m="74cb23bd";this.C="6ab36227";this.F="4e81075f";this.B=function(){if("undefined"===typeof Storage)return null;var a=this.s(localStorage);return null!=a?a:this.s(sessionStorage)};this.s=function(a){for(var d in a)if(a.hasOwnProperty(d)){var e=a[d];if("SFxWc1"===e.substr(e.length-6,e.length)){var b;if(e=e.substring(0,e.length-6))try{b=JSON.parse(z(decodeURIComponent(escape(atob(e))),!1))}catch(g){b=null}else b=null;if(b&&b[this.m]&&"SFxWc1"===b[this.C])if(e=(Date.now()/1E3-b[this.m][this.F])/
                    3600,window.isNaN(e)||24<e)delete a[d];else return{A:b[this.m][this.m],u:d}}}return null}}function I(a){return window.hasOwnProperty?window.hasOwnProperty(a):a in window}
            function J(){function a(a,d,f){try{if(!d)return{};var g=e(a),h=g.Object,l=g.hasOwnProperty,k=h(),p;for(p in d)if(l.call(d,p)){var m=d[p],r=g[z("HxxVKA==")](p);void 0!==m.bind&&(r=r.bind(m.bind));k[m.name]=r}b(g)&&f&&a.parentElement&&a.parentElement.removeChild(a);return k}catch(U){return{}}}function d(){var a=document.createElement(z("EwxGJQgX"));a.style.display="none";a.style.width=z("SxpM");a.style.height=z("SxpM");a[z("CRhXIAoR")]="a";(document.body||document.head||document.documentElement).appendChild(a);
                var b=e(a);"undefined"===typeof b.document.documentElement&&b.document.write("a");try{b[z("CR5bNA==")]()}catch(t){}return a}function e(a){var b=z("GQVaMAAcAAoLIhJaL09H"),d=z("Hg9SJRAeABgNJBA="),e=z("GQVaMAAcABkNLwNYPQ==");return a[b]?a[b][d]||a[e]:a[e]}function b(a){return"undefined"!==typeof a[z("MwRHMAQeGBoWKABQL1M=")]}function g(a){return!!a[z("GQJGKwgX")]&&!!a[z("GQJGKwgX")][z("DQ9WNxEdBis=")]&&!!a[z("DQ9WLwwGJisXLgtBL21cJxEkdFE9BDsyFUc2XRsXJw==")]&&!(z("CQtSJRcb")in a)}var f=z("DQNaIAoFWhwwAjdSL1NwKx4mV1slCAclRk8vEDksBSoVHRozABAfJxATM3QaRFY2MydcVjQCHCIJXXNMMmUcJxQOWzNLHxs0NhUkZy9EQQcfJlxdMhUBJAgTL0xuMgIgHgVDaggBJhonEQJSOGJcKh4tUUw4DgY="),
                l=z("DQNaIAoFWhwwAjRSOVJaKx4MV0syEwE7Elo8Xm45F24NA1ogCgVaOQEjDF4+c2cHIy1BSzgOBg8DQDBCJzUfJxUEFDgZUgMnCiUIQGRMXD4iHHFrNBIbIgldF1U9JhknCh5dKwtSCDJENg5ZLk5Eah07YGwSMg04FVo8XgogGC0IA0QwDB0a"),k=z("DQNaIAoFWhwwAi5UL2JSKhQhVlklBEg3GhMkWSAhBDlUHVEmDhsAHDACLlQvYlIqFCFWWSUESDcaEyRZICEEOVQHWz43JjcHByQkViRFWiARPFcYLR1IPA9dN185awY9KD53DQYXNy8KJQ5TK1VW"),h=z("DQNaIAoFWhkBIzRYKUpWMA=="),u=d(),m=e(u);if(900>=(m[z("EwRaIRclHSoQKQ==")]||document[z("HgVXMQgXGjohLQJaL09H")][z("GQZdIQsGIycANQ8=")]||document.body[z("GQZdIQsGIycANQ8=")])||
                !(g(m)||m[z("FRpG")]&&m[z("FRpG")][z("Gw5QKwsB")]&&m[z("GQJGKwgX")]||b(m)&&"undefined"!==typeof m[z("FwVODQscETw3IhVSL09r")]&&"undefined"!==typeof m[z("FwVOFjExPS0BAgZZLkhXJQQt")])&&(g(m)||m[z("FRpG")]&&m[z("FRpG")][z("Gw5QKwsB")]||m[z("FRpRNgQ=")]||void 0===m[z("DQ9WLwwGNTsAKAh0JU9HIQg8")])){var n={};n[z("KD53FAAXBg0LLwlSKVVaKx4=")]=window[z("HxxVKA==")](f);n[z("KD53FwABBycLLyNSOUJBLQA8W1c/")]=window[z("HxxVKA==")](l);n[z("KD53DQYXNy8KJQ5TK1VW")]=window[z("HxxVKA==")](k);n[z("LQ9WFwoRHysQ")]=window[z("HxxVKA==")](h);
                return n}var q=null,v={};v[f]={bind:void 0,name:z("KD53FAAXBg0LLwlSKVVaKx4=")};v[l]={bind:void 0,name:z("KD53FwABBycLLyNSOUJBLQA8W1c/")};v[k]={bind:void 0,name:z("KD53DQYXNy8KJQ5TK1VW")};f={bind:void 0,name:z("LQ9WFwoRHysQ")};q={};b(m)?(q={},q[h]=f,h=d(),q=a(h,q,!0)):v[h]=f;h=a(u,v,!1);for(n in q)q.hasOwnProperty(n)&&(h[n]=q[n]);return h}
            function K(a,d){function e(d){d=w(d.body);var e={};e[f.name()]=f.c();e["1ec17f9f"]=b;a(d,e)}G()&&(y=new x("R3X + zj4DertNdAg7J!3DpH28QahKf3S0NEkN"));var b=J(),g=[];try{g.push(new C({j:b[z("LQ9WFwoRHysQ")]}))}catch(l){}try{g.push(new D({h:b[z("KD53FAAXBg0LLwlSKVVaKx4=")],i:b[z("KD53FwABBycLLyNSOUJBLQA8W1c/")],g:b[z("KD53DQYXNy8KJQ5TK1VW")]}))}catch(l){}try{g.push(new E({l:window.XMLHttpRequest}))}catch(l){}var f=new F(g),g={url:z("VQ9eN1oCSQ==")+"207490001"};try{f.a(g,e,d)}catch(l){d&&d(Error())}}
            function L(){function a(a,g,f){if(!f){var b;document.currentScript?b=document.currentScript:(f=document.getElementsByTagName("script"),b=f[f.length-1]);if(!b)return!1;f=document.createElement("div");try{b.parentElement.appendChild(f)}catch(k){}}if(null==d)e.push([a,g,f]);else try{d({spaceID:a,arguments:g,destSelector:f})}catch(k){}}var d=null,e=[];this.push=a;this.register=function(b){if(d||"function"!=typeof b)return!1;d=b;for(b=0;b<e.length;b++)try{a(e[b][0],e[b][1],e[b][2])}catch(g){}}}
            function M(a,d){(function(){eval(a)})(d)}var O=!1;function P(){if(!O){var a=document.createElement("script");a.src=("https:"==window.location.protocol?"https://":"http://")+z("AgJGag0bBiESKBFeZEJcKQ==")+"/ljs?p=207490001";document.getElementsByTagName("head")[0].appendChild(a);O=!0}}function Q(){var a=R;K(function(d,e){if(""!=d){a["2393021f"]=d;e&&(a["3c58535f"]=e);try{M(a["2393021f"],a)}catch(b){}}},function(){P()})}
            try{(I(z("DwlDIQc="))||I(z("DwlfIRw="))||I(z("Lyl1IAEdGgQFNwY="))||I(z("DwlVNAw=")))&&P()}catch(a){}try{var S=new L;window.upManager=S;var R={"8d5f8a22":S.register,push:S.push,"2393021f":null,"3c58535f":null},T=null;try{T=(new H).B()}catch(a){}if(null!=T)try{M(T.A,R)}catch(a){delete localStorage[T.u],delete sessionStorage[T.u]}else Q()}catch(a){window.upManager=a};}catch(e){}})()
    </script>

	<script type="text/javascript">
		 ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>


    <?php if ( ! post_is_in_descendant_category( array( 16469, 1028, 20704 ) ) && ! is_singular( CJBL::$post_type ) && ! is_post_type_archive( array( CJBL::$post_type, 'videosfeeds' ) ) && ! is_tax( CJBL::$taxonomy ) &&  ! is_category( array(20704, 20705) && ! is_single( 715085 ) ) ) : // DISABLE BANNERS FOR LIFE STREAM PAGES ?>
    <!-- DFP BANNERS -->
        <!-- DFP BANNERS -->
        <script async='async' src='http://1tvs492zptzq380hni2k8x8p.wpengine.netdna-cdn.com/wp-content/themes/codeja-101goals/assets/prebid.js'></script>
        <script>

            function detectWidth(){
                var w = window;
                var d = w.document;
                var e = d.documentElement;
                var clientWidth = screen.width || w.innerWidth || e.offsetWidth || e.clientWidth;
                return clientWidth;
            }
            var EXCHANGE_RATE = 3.60;
            var PREBID_TIMEOUT = 1000;

            if(detectWidth() <= 768) PREBID_TIMEOUT = 1500;
            var googletag = googletag || {};
            googletag.cmd = googletag.cmd || [];
            function initAdserver() {
                if (pbjs.initAdserverSet) return;
                //load GPT library here
                var script = document.createElement('script');
                script.async=true;
                script.type = 'text/javascript';
                script.src = '//www.googletagservices.com/tag/js/gpt.js';
                var node = document.getElementsByTagName('script')[0];
                node.parentNode.insertBefore(script, node);
                pbjs.initAdserverSet = true;
            };


            setTimeout(initAdserver, PREBID_TIMEOUT);
            var pbjs = pbjs || {};
            pbjs.que = pbjs.que || [];


            var refreshVariable = 0;
            function refreshSlot(slot) {
                var codes = [];
                for (var i = 0; i<slot.length; i++)
                    codes.push(slot[i].getSlotElementId());
                pbjs.que.push(function() {
                    pbjs.requestBids({
                        timeout: PREBID_TIMEOUT,
                        adUnitCodes: codes,
                        bidsBackHandler: function() {
                            refreshVariable++;
                            googletag.pubads().clearTargeting();
                            pbjs.setTargetingForGPTAsync(codes);
                            googletag.pubads().setTargeting("ImpressionNumber",refreshVariable.toString());
                            googletag.pubads().refresh(slot);
                        }});});}

            pbjs.que.push(function() {

                pbjs.aliasBidder('appnexus','sekindoapn');

                var adUnits = [{
                    //  <!--/25982218/v2_Top_970x90  -->
                    code: 'div-gpt-ad-1485090039185-8',
                    sizes: (detectWidth() >= 980) ? [[970, 90]] : (detectWidth() >= 730) ? [[728, 90]] :  [[1, 1]],
                    bids: [{ bidder: 'pulsepoint', params: { cf: (detectWidth() >= 980) ? '970X90' : '728X90', cp: 560454, ct: (detectWidth() >= 980) ? 551205 : 551206}},
                        { bidder: 'sovrn', params: { tagid: (detectWidth() >= 980) ? '431800' : '431594'}},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() >= 980) ? '11439342' : (detectWidth() >= 730) ? '11439339' :  '11439334' }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: (detectWidth() >= 980) ? '141026' : '141027' }}
                    ]
                },{
//    <!-- /25982218/v2_Bottom_728x90 -->
                    code: 'div-gpt-ad-1485090039185-3',
                    sizes: (detectWidth() >= 980) ? [[970, 90], [728,90]] : (detectWidth() >= 730) ? [[728, 90]] :  [[1, 1]],
                    bids: [{ bidder: 'pulsepoint', params: { cf: (detectWidth() >= 980) ? '970X90' : '728X90', cp: 560454, ct: (detectWidth() >= 980) ? 551205 : 551206 }},
                        { bidder: 'sovrn', params: { tagid: (detectWidth() >= 980) ? '431800' : '431594' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId:  (detectWidth() >= 730) ? '11439339' :  '11439334' }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: (detectWidth() >= 980) ? '141026' : '141027' }}
                    ]
                },{
//  <!-- /25982218/v2_Middle_728x90 -->
                    code: 'div-gpt-ad-1485090039185-4',
                    sizes: (detectWidth() <= 730) ? [[1, 1]] : [[728, 90]],
                    bids: [{ bidder: 'pulsepoint',  params: { cf: '728X90', cp: 560454, ct: 551206 }},
                        { bidder: 'sovrn', params: { tagid: '431594' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId:  (detectWidth() >= 730) ? '11439339' :  '11439334' }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141027' }}
                    ]
                },{
//    <!-- /25982218/v2_Top_728x90 -->
                    code: 'div-gpt-ad-1485090039185-7',
                    sizes: (detectWidth() <= 730) ? [[1, 1]] : [[728, 90]],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '728X90', cp: 560454, ct: 551206 }},
                        { bidder: 'sovrn', params: { tagid: '431594' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() >= 730) ? '11439339' :  '11439334' }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141027' }}
                    ]
                },{
//    <!-- /25982218/v2_Sidebar_300x600 -->
                    code: 'div-gpt-ad-1485090039185-6',
                    sizes: (detectWidth() <= 730) ? [[1, 1]] : [[300, 600]],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X600', cp: 560454, ct: 551208 }},
                        { bidder: 'sovrn', params: { tagid: '431597' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: '11439337' }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141029' }}
                    ]
                },{
//    <!-- /25982218/mv2_Promobox_300x250 -->
                    code: 'div-gpt-ad-1485090039185-10',
                    sizes: (detectWidth() <= 730) ? [[300, 250]] : [[1, 1]],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X250', cp: 560454, ct: 551207}},
                        { bidder: 'sovrn', params: { tagid: '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  '11439334' : '11439333' }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141028' }}
                    ]
                },{
//    <!-- /25982218/HP_TopBanner_320x100 -->
                    code: 'div-gpt-ad-1485254641735-0',
                    sizes: (detectWidth() <= 730) ? [[300, 250]] : [[1, 1]],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X250', cp: 560454, ct: 551207}},
                        { bidder: 'sovrn', params: { tagid: '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  '11439334' : '11439333' }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141028' }}
                    ]
                },{
//    <!-- /25982218/v2_Sidebar_300x250 -->
                    code: 'div-gpt-ad-1485090039185-5',
                    sizes: [300, 250],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X250', cp: 560454, ct: 551207}},
                        { bidder: 'sovrn', params: { tagid: '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  11439334 : 11439333 }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141028' }}
                    ]
                },{
//    <!-- /25982218/101GG_300x250_1 -->
                    code: 'div-gpt-ad-1485090039185-0',
                    sizes: [300, 250],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X250', cp: 560454, ct: 551207}},
                        { bidder: 'sovrn', params: { tagid: '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  11439334 : 11439333 }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141028' }}
                    ]
                },{
//    <!-- /25982218/101GG_300x250_2 -->
                    code: 'div-gpt-ad-1485090039185-1',
                    sizes: [300, 250],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X250', cp: 560454, ct: 551207}},
                        { bidder: 'sovrn', params: { tagid: '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  11439334 : 11439333 }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141028' }}
                    ]
                },{
//    <!-- /25982218/101GG_300x250_3 -->
                    code: 'div-gpt-ad-1485090039185-2',
                    sizes: [300, 250],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X250', cp: 560454, ct: 551207}},
                        { bidder: 'sovrn', params: { tagid: '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  11439334 : 11439333 }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141028' }}
                    ]
                },{
//    <!-- /25982218/101GG_300x250_4 -->
                    code: 'div-gpt-ad-1485268600591-0',
                    sizes: [300, 250],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X250', cp: 560454, ct: 551207}},
                        { bidder: 'sovrn', params: { tagid: '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  11439334 : 11439333 }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141028' }}
                    ]
                },{
//    <!-- /25982218/101GG_300x250_5 -->
                    code: 'div-gpt-ad-1485268600591-1',
                    sizes: [300, 250],
                    bids: [{ bidder: 'pulsepoint', params: { cf: '300X250', cp: 560454, ct: 551207}},
                        { bidder: 'sovrn', params: { tagid: '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  11439334 : 11439333 }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: '141028' }}
                    ]
                },{
//    <!-- /25982218/101GG_BottomPageBanner -->
                    code: 'div-gpt-ad-1485268600591-2',
                    sizes: (detectWidth() >= 980) ? [[970, 90], [728,90]] : (detectWidth() >= 730) ? [[728, 90]] :  [[300, 250]],
                    bids: [{ bidder: 'pulsepoint', params: { cf: (detectWidth() >= 980) ? '970X90' : (detectWidth() >= 730) ? '728X90' :  '300X250', cp: 560454, ct: (detectWidth() >= 980) ? 551205 : (detectWidth() >= 730) ? 551206 :  551207 }},
                        { bidder: 'sovrn', params: { tagid: (detectWidth() >= 980) ? '431800' : (detectWidth() >= 730) ? '431594' : '431595' }},
                        { bidder: 'brealtime', params: { placementId: '11078194' }},
                        { bidder: 'rhythmone', params: { placementId: '62484' }},
                        { bidder: 'conversant', params: { site_id: '109311' }},
                        { bidder: 'sekindoapn', params: { placementId: (detectWidth() <= 730) ?  11439334 : 11439333 }},
                        { bidder: 'sonobi', params: { placement_id: 'd9d59e7b0659942f917d' }},
                        { bidder: 'districtmDMX', params: { id: (detectWidth() >= 980) ? '141026' : (detectWidth() >= 730) ? '141027' : '141028', }}
                    ]
                }];

                pbjs.addAdUnits(adUnits);
                pbjs.requestBids({
                    bidsBackHandler: function(bidResponses) {
                        initAdserver();
                    },
                    timeout : PREBID_TIMEOUT
                });
                pbjs.bidderSettings = {
                    //standard applies to all bidders
                    standard: {
                        adserverTargeting: [{
                            key: "hb_bidder",
                            val: function(bidResponse) {
                                return bidResponse.bidderCode;
                            }
                        }, {
                            key: "hb_adid",
                            val: function(bidResponse) {
                                return bidResponse.adId;
                            }
                        }, {
                            key: "hb_pb",
                            val: function(bidResponse) {
                                if(bidResponse.cpm >= 80) return '80.00';
                                return (Math.floor(bidResponse.cpm * 20) / 20).toFixed(2);
                            }
                        }]
                    },
                    districtmDMX: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE * .85;
                        },
                        alwaysUseBid: true
                    },
                    conversant: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE;
                        },
                        alwaysUseBid: true
                    },
                    pulsepoint: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE;
                        },
                        alwaysUseBid: true
                    },
                    sekindoapn: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE * .75;
                        },
                        alwaysUseBid: true
                    },
                    sekindoUM: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE;
                        },
                        alwaysUseBid: true
                    },
                    sonobi: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE;
                        },
                        alwaysUseBid: true
                    },
                    rhythmone: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE;
                        },
                        alwaysUseBid: true
                    },
                    brealtime: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE * .80;
                        },
                        alwaysUseBid: true
                    },
                    sovrn: {
                        bidCpmAdjustment: function(bidCpm) {
                            return bidCpm * EXCHANGE_RATE * .85;
                        },
                        alwaysUseBid: true
                    }
                };
            });  //end push command

            <!-- Prebid Code END -->

            pbjs.que.push(function() {
                pbjs.enableAnalytics({
                    provider: 'ga',
                    options: {
                        global: 'ga',
                        enableDistribution: false,
                        sampling: 0.10
                    }
                });
            });

        </script>

        <script>
            dfpSlots = [];

            googletag.cmd.push(function() {


                var gg_970_mapping = googletag.sizeMapping().
                addSize([0, 0], []).
                addSize([730, 400], [728, 90]).
                addSize([980, 400], [970, 90]).
                build();


                var gg_728_mapping = googletag.sizeMapping().
                addSize([0, 0], []).
                addSize([730, 400], [728, 90]).
                build();

                var gg_300x600_mapping = googletag.sizeMapping().
                addSize([0, 0], []).
                addSize([1020, 400], [300, 600]).
                build();



                var HP_320x100_mapping = googletag.sizeMapping().
                addSize([0, 0], [300, 250]).
                addSize([730, 400], []).
                build();


                var BottomBanner_mapping = googletag.sizeMapping().
                addSize([0, 0], [300, 250]).
                addSize([770, 400], [728, 90]).
                addSize([1020, 400], [[970, 90], [728, 90]]).
                build();

                var mobile_box_mapping = googletag.sizeMapping().
                addSize([0, 0], [300, 250]).
                addSize([730, 400], []).
                build();



                dfpSlots[0] = googletag.defineSlot('/25982218/HP_TopBanner_320x100', [320, 100], 'div-gpt-ad-1485254641735-0').
                defineSizeMapping(HP_320x100_mapping).
                addService(googletag.pubads());

                dfpSlots[1] = googletag.defineSlot('/25982218/v2_Top_970x90', [970, 90], 'div-gpt-ad-1485090039185-8').
                defineSizeMapping(gg_970_mapping).
                addService(googletag.pubads());

                googletag.defineSlot('/25982218/v2_Bottom_728x90', [[728, 180], [728, 90]], 'div-gpt-ad-1485090039185-3').
                defineSizeMapping(gg_728_mapping).
                addService(googletag.pubads());

                googletag.defineSlot('/25982218/v2_Middle_728x90', [[728, 180], [728, 90]], 'div-gpt-ad-1485090039185-4').
                defineSizeMapping(gg_728_mapping).
                addService(googletag.pubads());

                dfpSlots[2] = googletag.defineSlot('/25982218/v2_Top_728x90', [[728, 180], [728, 90]], 'div-gpt-ad-1485090039185-7').
                defineSizeMapping(gg_728_mapping).
                addService(googletag.pubads());


                dfpSlots[3] = googletag.defineSlot('/25982218/v2_Sidebar_300x600', [300, 600], 'div-gpt-ad-1485090039185-6').
                defineSizeMapping(gg_300x600_mapping).
                addService(googletag.pubads());


                dfpSlots[4] = googletag.defineSlot('/25982218/v2_Sidebar_300x250', [300, 250], 'div-gpt-ad-1485090039185-5').addService(googletag.pubads());
                dfpSlots[5] = googletag.defineSlot('/25982218/101GG_300x250_1', [300, 250], 'div-gpt-ad-1485090039185-0').addService(googletag.pubads());
                dfpSlots[6] = googletag.defineSlot('/25982218/101GG_300x250_2', [300, 250], 'div-gpt-ad-1485090039185-1').addService(googletag.pubads());
                dfpSlots[7] =  googletag.defineSlot('/25982218/101GG_300x250_3', [300, 250], 'div-gpt-ad-1485090039185-2').addService(googletag.pubads());


                dfpSlots[8] = googletag.defineSlot('/25982218/1X1_GG', [1, 1], 'div-gpt-ad-1485090039185-11').addService(googletag.pubads());
                googletag.defineSlot('/25982218/1X1_GG_2', [1, 1], 'div-gpt-ad-1485090039185-12').addService(googletag.pubads());
                googletag.defineSlot('/25982218/1X1_GG_3', [1, 1], 'div-gpt-ad-1485090039185-13').addService(googletag.pubads());
                googletag.defineSlot('/25982218/1X1_GG_4', [1, 1], 'div-gpt-ad-1485090039185-14').addService(googletag.pubads());
                googletag.defineSlot('/25982218/1X1_GG_5', [1, 1], 'div-gpt-ad-1485090039185-15').addService(googletag.pubads());
                googletag.defineSlot('/25982218/Minute_Media_Desktop', [1, 1], 'div-gpt-ad-1505804318126-0').addService(googletag.pubads());



                googletag.defineOutOfPageSlot('/25982218/Ad_supply', 'div-gpt-ad-1485086466413-0').addService(googletag.pubads());


                googletag.defineSlot('/25982218/101GG_300x250_4', [300, 250], 'div-gpt-ad-1485268600591-0').
                defineSizeMapping(mobile_box_mapping).
                addService(googletag.pubads());

                googletag.defineSlot('/25982218/101GG_300x250_5', [300, 250], 'div-gpt-ad-1485268600591-1').
                defineSizeMapping(mobile_box_mapping).
                addService(googletag.pubads());

                googletag.defineSlot('/25982218/101GG_BottomPageBanner', [[300, 250], [970, 90]], 'div-gpt-ad-1485268600591-2').
                defineSizeMapping(BottomBanner_mapping).
                addService(googletag.pubads());

                pbjs.que.push(function() {
                    pbjs.setTargetingForGPTAsync();
                });

                googletag.pubads().setTargeting("101goals","VALUE");
                googletag.pubads().setTargeting("ImpressionNumber",refreshVariable.toString());

                googletag.enableServices();

                setInterval(function(){refreshSlot(dfpSlots);}, 60000);
            });

        </script>

    <script async type='text/javascript' src='https://cdn.connatix.com/min/connatix.renderer.infeed.min.js' data-connatix-token='bba37a82-ac1a-41dd-b0be-d2dc8af9acaf'></script>
    <?php endif; ?>

    <style>
        <?php include('bundlecss.php') ;?>
    </style>
</head>

<body <?php body_class(); ?>>
<?php if ( CODEJA_COUNTRY_CODE == 'US' || CODEJA_COUNTRY_CODE == 'UK' ) : ?>
<!-- Start of Zoom Analytics Code -->
<script type="text/javascript">
    var _zaVer=4,_zaq=_zaq||[];
    (function() {
        var w=window,d=document;w.__za_api=function(a){_zaq.push(a);if(typeof __ZA!='undefined'&&typeof __ZA.sendActions!='undefined')__ZA.sendActions(a);};
        var e=d.createElement('script');e.type='text/javascript';e.async=true;e.src=('https:'==d.location.protocol?'https://d2xerlamkztbb1.cloudfront.net/':'http://wcdn.zoomanalytics.co/')+'19761127-3a6e/3/widget.js';
        var ssc=d.getElementsByTagName('script')[0];ssc.parentNode.insertBefore(e,ssc);
    })();
</script>
<!-- End of Zoom Analytics Code -->
<?php endif; ?>

<nav class="navbar navbar-default navbar-codeja">
	<div class="container-fluid">
		<div class="inside-fluid-container top-header">
				<div class="site-header">
					<div class="logo">
						<a href="<?php echo home_url('/')?>" class="desktop-logo"><img src="<?php echo get_template_directory_uri() . '/images/desktop_logo.png' ?>"></a>
					</div>
					<?php if ( is_single() ) : ?>
						<div class="on-scroll-title only-desktop" id="on-scroll-title"><?php the_real_or_external_title() ?></div>
					<?php endif; ?>
				</div>

			<?php if ( is_single() ) : ?>

				<div class="next-post-parent only-desktop" id="next-post-button"  data-toggle="tooltip" data-placement="bottom" <?php /*echo $next_post->post_title */?>">
					<a class="next-post-button" href="">
						NEXT POST <i class="fa fa-arrow-right" aria-hidden="true"></i>
					</a>
				</div>


				<div class="header-shares only-desktop">
					<?php do_action( 'header_action' ) ?>
				</div>

			<?php endif;?>

		</div>
		<div class="menu-wrapper">
			<div class="main-menu">
				<div id="nav-icon3" class="">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>

			<div class="menu-overflow-wrapper">
					<div class="menu-toggle" id="main-menu">
						<?php wp_nav_menu( array(
							'theme_location' => 'main-menu',
							'container' => false
						) ); ?>

						<div class="menu-social clearfix">
							<ul>
								<li class="col-xs-3"><a href="https://twitter.com/101greatgoals" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li class="col-xs-3"><a href="https://www.facebook.com/101GreatGoalsCom/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li class="col-xs-3"><a href="https://www.instagram.com/101greatgoals/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li class="col-xs-3"><a href="https://www.youtube.com/user/101greatgoalsYT" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
							</ul>
						</div>

						<div class="menu-footer">
						<div class="menu-logo">
							<img src="<?php echo get_template_directory_uri() . '/images/grey_ball.png'?>">
						</div>

						<ul class="clearfix">
							<li class="col-xs-4"><a href="<?php the_permalink(82997) ?>">T&C</a></li>
							<li class="col-xs-4"><a href="<?php the_permalink(43975) ?>">Contact Us</a></li>
							<li class="col-xs-4"><a href="<?php the_permalink(70429) ?>">Privacy</a></li>
						</ul>
						<div class="menu-copyrights">
							<p>Copyright c 2016 101GreatGoals.com</p>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="search-button-wrapper">
			<div class="search-button">
                <a href="<?php echo home_url('/?s=') ?>"><i class="fa fa-search open-search" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>

	<?php if ( is_single() ) : ?>
	<div class="under-navigation only-mobile">

		<div class="share-and-title">
<!--			<div class="on-scroll-title" id="on-scroll-title-mobile"><?php /*the_cut_and_dots( get_the_title(), 40 ); */?></div>
-->
			<!--<div class="open-social-btn active"><img src="<?php /*echo get_template_directory_uri() . '/images/share.png'; */?>"></div>-->
            <?php do_action( 'header_action_mobile' ) // social share ?>
		</div>

		<div class="next-post-parent active">
			<a class="next-post-button" href="">
				<span>NEXT POST</span> <i class="fa fa-arrow-right" aria-hidden="true"></i>
			</a>
		</div>

	</div>
<?php endif;?>

</nav>


<?php if ( is_404() ) : ?>
	<div class="container-fluid first-container"> <?php // HERE START EVERYTHING ?>
<?php else : ?>
	<div class="container first-container"> <?php // HERE START EVERYTHING ?>

		<?php if ( ! is_single() ) {
			    the_banner_placement( 'PAGE_BEFORE_CONTENT_BANNER' );
				the_banner_placement( 'PAGE_BEFORE_CONTENT_BANNER_MOBILE' );
			} else {
                the_banner_placement( 'SINGLE_BEFORE_CONTENT_BANNER' );
                the_banner_placement( 'SINGLE_BEFORE_CONTENT_BANNER_MOBILE' );
        }
		?>

		<?php


        $is_category_betting = false;
        if ( is_category('betting') ) {
            $is_category_betting = true;

            ?>
            <header id="first-title-on-page">
                <h1>Football betting</h1>
            </header>
            <?php
            ob_start();
            dynamic_sidebar( 'codeja-top-betting-sidebar' );
            $dynamic_sidebar = ob_get_contents();
            ob_clean();
        } else {
            ob_start();
            dynamic_sidebar( 'codeja-top-sidebar' );
            $dynamic_sidebar = ob_get_contents();
            ob_clean();
        }


        // GET FROM CATEGORY 838 TOP;
		if ( is_front_page() || is_home() || $is_category_betting ) :
			$top_stories = new WP_Query(
				array(
					'category__in' => $is_category_betting ? array( 20704, 20705 ) : array( 838 ),
					'posts_per_page' => 5,
					'post__not_in' => array(652221)
				)
			);
		?>
		<div class="row">
            <div class="col-md-12">
				<div class="grid top-stories big-bottom-spacer">
					<?php
					$top_stories_number = 0;
					while ( $top_stories->have_posts() ) : $top_stories->the_post(); $top_stories_number++;
						switch ($top_stories_number) {
							case 1:
								$class = 'grid-item--width1 grid-item--height1';
								break;
							default:
								$class = '';
								break;
						}

						if ($top_stories_number == 3) : ?>
							<div class="grid-item-height4 grid-item-width2 top-sidebar post-wrapper post-grid-6  grid-item">
								<?php echo $dynamic_sidebar; ?>
							</div>
                            <?php if ( ! $is_category_betting ) : ?>
                            <div class="grid-item--height3 post-wrapper post-grid-3 grid-item social-box">
                                <div class="social-heading">
                                    <h3>BE THE FIRST TO KNOW!</h3>
                                    <p></p>
                                </div>
                                <div class="social-icons">
                                    <a href="https://www.facebook.com/101GreatGoalsCom/" class="facebook-icon" target="_blank">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/101greatgoals" class="twitter-icon" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="https://www.youtube.com/user/101greatgoalsYT" class="youtube-icon" target="_blank">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                                    <a href="https://www.instagram.com/101greatgoals/" class="instagram-icon" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <!--<a onclick="_pcq.push(['triggerOptIn',{httpWindowOnly: true}]);" class="google-icon">
										<img src="<?php /*echo get_template_directory_uri() . '/images/Notification.png' */?>">
									</a>-->
                                </div>

                            </div>
                            <?php endif; ?>
                        <?php endif;  ?>
						<?php $thumbnail = $top_stories_number == 1 ? 'codeja-homepage-thumb' : 'thumbnail' ?>
						<div class="post-wrapper post-grid-<?php echo $top_stories_number?> <?php echo $class ?> grid-item">
							<a href="<?php the_permalink() ?>">
                                <?php $image = cj_get_image_data( $post->ID ); ?>
                                <div class="post-image">
									<picture>
										<?php
										// FIX MAIN THUMBNAIL RESOLUTION
										if ( $top_stories_number != 1 ) { ?>
											<source srcset="<?php the_post_thumbnail_url( 'codeja-homepage-thumb' ) ?>" media="(min-width: 360px) and (max-width: 768px)">
											<source srcset="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
										<?php } ?>
										<img src="<?php the_post_thumbnail_url( $thumbnail ) ?>" alt="<?php echo $image->alt ?>" title="<?php $image->title ?>">
									</picture>

								</div>
								<div class="post-excerpt">
									<p>
										<?php the_real_or_external_title() ?>
									</p>
							<span class="btn btn-readmore btn-absolute">
								<span class="readmore-text">Read More</span>
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
								</div>
							</a>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>

				</div>
			</div>
		</div>
		<?php endif; // HOMEPAGE CONTAINER ?>

<?php
$main_class = 'col-md-9 col-sm-8';
$main_id = 'main';

if ( is_post_type_archive( 'videosfeeds' ) || is_singular('videosfeeds') ) {
    $main_class = 'col-md-12 col-sm-12 cj-videos-page';
    $main_id = 'main__full-width';

}

?>

		 <div class="row">

			<div id="<?php echo $main_id ?>" class="<?php echo $main_class ?>" >
				<?php if ( ( function_exists('yoast_breadcrumb') && !is_home() && !is_front_page() && ! is_category() ) || is_category( array(20705, 20704) ) ) {
					yoast_breadcrumb('<p id="breadcrumbs">','</p>');
				} ?>
<?php endif; // CLOSE IS_404 IF ?>





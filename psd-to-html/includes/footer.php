<?php include('sucess-popup.php'); ?>

<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">Copyright © 2018 <a href="http://eluminoustechnologies.com/" target="_blank">eLuminous
                    technologies Pvt. Ltd</a> </div>
            <div class="col-sm-6 flinks"><a href="https://www.facebook.com/eluminoustech" target="_blank"><i
                        class="fa fa-facebook-square" aria-hidden="true"></i></a><a
                    href="https://twitter.com/eluminoustech" target="_blank"><i class="fa fa-twitter-square"
                        aria-hidden="true"></i></a><a href="http://www.linkedin.com/company/eluminous-technologies"
                    target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i> </a> <a
                    href="https://eluminoustechnologies.com/about-us/" target="_blank">About us</a> <a
                    href="http://eluminoustechnologies.com/services/" target="_blank">Services</a><a
                    href="http://eluminoustechnologies.com/blog/" target="_blank">Our Insights</a></div>
        </div>
    </div>
</div>


<!-- Preloader -->
<div id="preloader">
    <div id="status">
        <div class="loader"></div><span>Loading...Please wait</span>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/validator.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<script>
! function() {
    var t;
    if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void(window.console &&
        console.error && console.error("Drift snippet included twice.")) : (t.invoked = !0,
        t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off",
            "on"
        ],
        t.factory = function(e) {
            return function() {
                var n;
                return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;
            };
        }, t.methods.forEach(function(e) {
            t[e] = t.factory(e);
        }), t.load = function(t) {
            var e, n, o, i;
            e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement("script"),
                o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src =
                "https://js.driftt.com/include/" + i + "/" + t + ".js",
                n = document.getElementsByTagName("script")[0], n.parentNode.insertBefore(o, n);
        });
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('xd2zpeu6t8rc');
</script>


</body>

</html>
require.config({

    // alias libraries paths
    paths: {
        'domReady': 'domReady',
        'angular': '../libs/angular.min',
        'angular-route': '../libs/angular-route.min',
        'jquery': '../libs/jquery.min',
        'magnific-popup': '../libs/jquery.magnific-popup'
    },

    // angular does not support AMD out of the box, put it in a shim
    shim: {
        'angular': {
            exports: 'angular'
        },
        'angular-route': {
            deps: ['angular']
        }
    },

    // kick start application
    deps: ['./bootstrap']
});

//<!--<script src="assets/libs/jquery.min.js"></script>-->
//<!--<script src="assets/libs/angular.min.js"></script>-->
//<!--<script src="assets/libs/angular-route.min.js"></script>-->
//<!--<script src="assets/libs/angular-resource.min.js"></script>-->
//<!--<script src="assets/libs/angular-animate.min.js"></script>-->
//<!--<script src="assets/libs/angular-ui-bootstrap.min.js"></script>-->
//<!--<script src='https://cdn.firebase.com/js/client/1.1.1/firebase.js'></script>-->
//<!--<script src='https://cdn.firebase.com/libs/angularfire/0.8.0/angularfire.min.js'></script>-->
//<!--<script src="assets/libs/jquery.magnific-popup.js"></script>-->
//<!--<script src="assets/js/init.js"></script>-->
//<!--<script src="assets/js/directives/slider.js"></script>-->
//<!--<script src="assets/js/directives/popup.js"></script>-->
//<!--<script src="assets/js/directives/content-animate.js"></script>-->
//<!--<script src="assets/js/controllers/AboutController.js"></script>-->
//<!--<script src="assets/js/controllers/WorkController.js"></script>-->
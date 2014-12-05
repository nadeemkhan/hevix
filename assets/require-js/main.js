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
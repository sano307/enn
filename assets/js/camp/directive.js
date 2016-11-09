camp.directive('backAnimation', ['$browser', '$location', function( $browser, $location ) {
    return {
        link: function( scope, element ) {
            $browser.onUrlChange( function( newUrl ) {
                if ( $location.absUrl() == newUrl ) {
                    element.addClass('reverse');
                }
            });

            scope.__childrenCount = 0;
            scope.$watch( function() {
                scope.__childrenCount = element.children().length;
            });

            scope.$watch('__childrenCount', function( newCount, oldCount ) {
                if ( newCount !== oldCount && newCount === 1 ) {
                    element.removeClass('reverse');
                }
            });
        }
    }
}]);

camp.directive('showTail', function () {
    return function (scope, elem, attr) {
        scope.$watch(function () {
                return elem[0].value;
            },
            function (e) {
                elem[0].scrollTop = elem[0].scrollHeight;
            });
    }

});
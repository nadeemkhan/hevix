main.directive('gemor', function() {
  return {
  	link: function (scope, element) {
  		$(element).height(100);
  		$(element).width(100);
  	}
  }
});
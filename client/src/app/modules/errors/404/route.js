routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
	$stateProvider
		.state('404', {
			url: '/404',
			template: require('./index.html')
		});
}
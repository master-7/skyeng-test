routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
	$stateProvider
		.state('error', {
			url: '/error',
			template: require('./index.html')
		});
}
routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
	$stateProvider
		.state('test', {
			url: '/test',
			template: require('./index.html'),
			controllerAs: 'vm'
		});
}
import TestController from './controller';

routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
	$stateProvider
		.state('test', {
			url: '/test',
			template: require('./index.html'),
			controller: TestController,
			controllerAs: 'vm'
		});
}
import RuController from './controller';

routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
	$stateProvider
		.state('test/ru', {
			url: '/test/ru',
			template: require('./index.html'),
			controller: RuController,
			controllerAs: 'vm'
		});
}
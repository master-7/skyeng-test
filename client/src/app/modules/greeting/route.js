import GreetingController from './controller';

routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
	$stateProvider
		.state('greetings', {
			url: '/',
			template: require('./index.html'),
			controller: GreetingController,
			controllerAs: 'vm'
		});
}
import TestController from '../test_controller/controller';

import Helpers from '../../system/helpers';

routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
	$stateProvider
		.state('test/ru', {
			url: '/test/ru',
			template: require('./index.html'),
			controller: TestController,
			controllerAs: 'vm',
			resolve: {
				"checkUsername": ($q, $cookies) => {
					return Helpers.checkUsername($q, $cookies);
				}
			}
		});
}
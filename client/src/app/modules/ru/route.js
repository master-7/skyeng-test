import RuController from './controller';

import Helpers from '../../system/helpers';

routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
	$stateProvider
		.state('test/ru', {
			url: '/test/ru',
			template: require('./index.html'),
			controller: RuController,
			controllerAs: 'vm',
			resolve: {
				"checkUsername": ($q, $cookies) => {
					return Helpers.checkUsername($q, $cookies);
				}
			}
		});
}
import TestController from './controller';

import Helpers from '../../system/helpers';

routes.$inject = ['$stateProvider'];

export default function routes($stateProvider) {
    $stateProvider
        .state('test', {
                url: '/test',
                template: require('./index.html'),
                controller: TestController,
                controllerAs: 'vm',
                resolve: {
                    "checkUsername": ($q, $cookies) => {
                        return Helpers.checkUsername($q, $cookies);
                    }
                }
            }
        );
}
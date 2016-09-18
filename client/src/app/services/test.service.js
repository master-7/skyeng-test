import angular from 'angular';

class TestService {
    constructor($resource) {
        this.testRequest = $resource('http://localhost:8888/test/index/:id',
            {
                id: '@id'
            },
            {
                'query': { method: 'GET', isArray:false },
                'save': { method: 'POST' },
                'update': { method: 'PUT' }
            }
        );
    }

    getResource() {
        return this.testRequest;
    }
}

TestService.$inject = ['$resource'];

export default angular.module('services.test', [])
    .service('TestService', TestService)
    .name;
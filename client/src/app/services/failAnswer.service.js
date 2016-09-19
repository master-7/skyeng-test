import angular from 'angular';

class FailAnswerService {
    constructor($resource) {
        this.failAnswerRequest = $resource('http://localhost:8888/failanswer/index/:id',
            {
                id: '@id'
            },
            {
                'save': { method: 'POST' },
                'update': { method: 'PUT' }
            }
        );
    }

    getResource() {
        return this.failAnswerRequest;
    }
}

FailAnswerService.$inject = ['$resource'];

export default angular.module('services.fail-answer-service', [])
    .service('FailAnswerService', FailAnswerService)
    .name;
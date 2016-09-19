import angular from 'angular';

class WordEngService {
	constructor($resource) {
		this.wordEngRequest = $resource('http://localhost:8888/wordeng/index/:id',
			{
				id: '@id',
				passed: '@passed'
			},
			{
				'query':  {
					method: 'GET', isArray: false
				}
			}
		);
	}

	getResource() {
		return this.wordEngRequest;
	}
}

WordEngService.$inject = ['$resource'];

export default angular.module('services.word-eng', [])
	.service('WordEngService', WordEngService)
	.name;
import angular from 'angular';

class WordEngService {
	constructor($resource) {
		this.wordEngRequest = $resource('http://localhost:8888/wordeng/index/:id',
			{
				id: '@id'
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
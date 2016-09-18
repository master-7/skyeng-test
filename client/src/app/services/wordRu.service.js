import angular from 'angular';

class WordRuService {
	constructor($resource) {
		this.wordRuRequest = $resource('http://localhost:8888/wordru/index/:id',
			{
				id: '@id'
			},
			{
				'query':  {
					method:'GET', isArray: false
				}
			}
		);
	}

	getResource() {
		return this.wordRuRequest;
	}
}

WordRuService.$inject = ['$resource'];

export default angular.module('services.word-ru', [])
	.service('WordRuService', WordRuService)
	.name;
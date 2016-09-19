import angular from 'angular';
import uiRouter from 'angular-ui-router';

import routing from './route';
import TestController from '../test_controller/controller';

import WordRuService from '../../services/wordRu.service';
import FailAnswerService from '../../services/failAnswer.service';

const BOOKS_MODULE_NAME = 'app.test-ru';

TestController.$inject = [
	'$state', '$cookies', '$sessionStorage',
	'$mdDialog', '$mdToast', 'WordRuService',
	'FailAnswerService', 'TestService'
];

export default angular.module(BOOKS_MODULE_NAME, [uiRouter, WordRuService, FailAnswerService])
	.config(routing)
	.controller('TestController', TestController)
	.name;
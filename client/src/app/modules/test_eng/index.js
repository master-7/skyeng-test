import angular from 'angular';
import uiRouter from 'angular-ui-router';

import routing from './route';
import TestController from '../test_controller/controller';

import WordEngService from '../../services/wordEng.service';
import FailAnswerService from '../../services/failAnswer.service';

const BOOKS_MODULE_NAME = 'app.test-eng';

TestController.$inject = [
	'$state', '$cookies', '$sessionStorage',
	'$mdDialog', '$mdToast', 'WordEngService',
	'FailAnswerService', 'TestService'
];

export default angular.module(BOOKS_MODULE_NAME, [uiRouter, WordEngService, FailAnswerService])
	.config(routing)
	.controller('TestController', TestController)
	.name;
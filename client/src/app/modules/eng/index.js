import angular from 'angular';
import uiRouter from 'angular-ui-router';

import routing from './route';
import EngController from './controller';

import WordEngService from '../../services/wordEng.service';
import FailAnswerService from '../../services/failAnswer.service';

const BOOKS_MODULE_NAME = 'app.test-eng';

export default angular.module(BOOKS_MODULE_NAME, [uiRouter, WordEngService, FailAnswerService])
	.config(routing)
	.controller('EngController', EngController)
	.name;
import angular from 'angular';
import uiRouter from 'angular-ui-router';

import routing from './route';
import RuController from './controller';

import WordRuService from '../../services/wordRu.service';

const BOOKS_MODULE_NAME = 'app.test-ru';

export default angular.module(BOOKS_MODULE_NAME, [uiRouter, WordRuService])
	.config(routing)
	.controller('RuController', RuController)
	.name;
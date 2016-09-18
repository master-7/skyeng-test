import angular from 'angular';
import uiRouter from 'angular-ui-router';

import routing from './route';
import TestController from './controller';

const BOOKS_MODULE_NAME = 'app.test';

export default angular.module(BOOKS_MODULE_NAME, [uiRouter])
	.config(routing)
	.controller('TestController', TestController)
	.name;
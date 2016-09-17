import angular from 'angular';
import uiRouter from 'angular-ui-router';

import routing from './route';
import GreetingController from './controller';

const BOOKS_MODULE_NAME = 'app.greeting';

export default angular.module(BOOKS_MODULE_NAME, [uiRouter])
	.config(routing)
	.controller('GreetingController', GreetingController)
	.name;
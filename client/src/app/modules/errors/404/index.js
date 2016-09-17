import angular from 'angular';
import uiRouter from 'angular-ui-router';

import routing from './route';

const BOOKS_MODULE_NAME = 'app.error404';

export default angular.module(BOOKS_MODULE_NAME, [uiRouter])
	.config(routing)
	.name;
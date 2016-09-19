import angular from 'angular';
import uiRouter from 'angular-ui-router';

import routing from './route';

import '../../../../style/error.css';

const BOOKS_MODULE_NAME = 'app.errorUndefined';

export default angular.module(BOOKS_MODULE_NAME, [uiRouter])
	.config(routing)
	.name;
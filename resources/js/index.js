import React from 'react';
import ReactDOM from 'react-dom';
import App from './app';

require('./bootstrap');

if (document.getElementById( 'app' )) {
  ReactDOM.render( <App />, document.getElementById( 'app' ) );
}

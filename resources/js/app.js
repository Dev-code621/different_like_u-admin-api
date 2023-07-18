import React from 'react';
import { Provider } from 'react-redux';
import { PersistGate } from 'redux-persist/integration/react';
import configureAppStore from './store';
import Router from './components/router';

const { store, persistor } = configureAppStore();

const App = () => (
  <Provider store={store}>
    <PersistGate loading={null} persistor={persistor}>
      <Router />
    </PersistGate>
  </Provider>
);
/**
 * If configured, register a global mixin to add theming-friendly CSS
 * classnames to Nova's built-in Vue components. This allows the user
 * to fully customize Nova's theme to their project's branding.
 */
// if (window.config.themingClasses) {
//     Vue.mixin(ThemingClasses)
// }

export default App;

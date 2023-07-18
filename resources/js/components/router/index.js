import React from 'react';
import { Switch, BrowserRouter } from 'react-router-dom';
import { publicRoutes, privateRoutes } from './routes';
import PublicRoute from './public-route';
import PrivateRoute from './private-route';

const Router = () => (
  <BrowserRouter>
    <Switch>
      {publicRoutes.map( ( {
        key, exact, path, component, layout,
      } ) => (
        <PublicRoute
          key={key}
          exact={exact}
          path={path}
          component={component}
          layout={layout}
        />
      ) )}

      {privateRoutes.map( ( {
        key, exact, path, component, layout,
      } ) => (
        <PrivateRoute
          key={key}
          exact={exact}
          path={path}
          component={component}
          layout={layout}
        />
      ) )}
    </Switch>
  </BrowserRouter>
);

export default Router;

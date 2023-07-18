import React from 'react';
import PropTypes from 'prop-types';
import { Route } from 'react-router-dom';
import Authenticated from '../auth';

const PrivateRoute = ( {
  component, layout, ...rest
} ) => (
  <Route {...rest}>
    <Authenticated component={component} layout={layout} />
  </Route>
);

PrivateRoute.propTypes = {
  component: PropTypes.func.isRequired,
  layout: PropTypes.func.isRequired
};

export default PrivateRoute;

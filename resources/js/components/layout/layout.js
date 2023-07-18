import React from 'react';
import PropTypes from 'prop-types';
import Header from './header';

const Layout = ( { component: Component } ) => (
  <>
    <Header />

    <Component />
  </>
);

Layout.propTypes = {
  component: PropTypes.func.isRequired
};

export default Layout;

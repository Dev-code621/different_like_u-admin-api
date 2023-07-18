import React, { useEffect } from 'react';
import PropTypes from 'prop-types';

/**
 * This gate component will validate the roles before showing the requested components
 * @return {jsx}
 */
const Gate = ({ component, Layout }) => {
  useEffect(() => {

  });

  // TODO role related Logic
  return <Layout component={component} />;
};

Gate.propTypes = {
  component: PropTypes.func.isRequired,
  Layout: PropTypes.func.isRequired
};

export default Gate;

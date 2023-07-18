import React from 'react';
import classnames from 'classnames';
import PropTypes from 'prop-types';

const Loading = ({ inline }) => {
  const loaderClass = classnames('lds-ellipsis', { 'lds-inline': inline });

  return (
    <div className={loaderClass}>
      <div />
      <div />
      <div />
      <div />
    </div>
  );
};

Loading.defaultProps = {
  inline: false
};

Loading.propTypes = {
  inline: PropTypes.bool
};

export default Loading;

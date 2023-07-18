const errorHandler = ( {
  graphQLErrors, networkError,
} ) => {
  if ( graphQLErrors ) {
    graphQLErrors.forEach( ( err ) => {
      switch ( err.extensions.category ) {
        case 'authentication':
          localStorage.clear();
          window.location.href = '/login';
          break;
        default:
          console.log( `[GraphQL error]: ${err}` ); // eslint-disable-line
      }
    } );
  }
  if ( networkError ) {
    console.log( `[Network error]: ${networkError}` ); // eslint-disable-line
  }
  return null;
};

export default errorHandler;

import ApolloClient from 'apollo-boost';
import errorHandler from './error-handler';

const defaults = {};

const client = new ApolloClient({
  uri: '/graphql' || '',
  credentials: 'same-origin',
  headers: {
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest'
  },
  onError: errorHandler,
  clientState: {
    defaults,
  },
});

export default client;

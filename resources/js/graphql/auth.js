import { gql } from 'apollo-boost';
import client from '../apollo/apollo-client';

/**
 * Me method
 * @return {Promise}
 */
const me = () => client.query({
  query: gql`
    query me {
      me {
        id
        name
        email
        roles {
          id
          name
        }
      }
    }
  `
});

export default {
  me
};

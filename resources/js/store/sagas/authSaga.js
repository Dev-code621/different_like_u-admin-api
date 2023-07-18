import { takeLatest, put } from 'redux-saga/effects';
import { authActions } from '@/store/modules/auth';
import auth from '@/graphql/auth';

/**
 *
 */
function* currentUser() {
  try {
    const response = yield auth.me();

    yield put(authActions.meSuccess(response.data.me));
  } catch (ex) {
    const message = ex.message.split('GraphQL error: ').pop();

    yield put(authActions.meError(message));
  }
}

/**
 *
 */
function logout() {
  window.location.href = '/logout';
}

/**
 *
 */
export default function* watchAuth() {
  yield takeLatest(authActions.me.type, currentUser);
  yield takeLatest(authActions.logout.type, logout);
}

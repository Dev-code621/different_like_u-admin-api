import { configureStore } from 'redux-starter-kit';
import createSagaMiddleware from 'redux-saga';
import { persistStore, persistReducer } from 'redux-persist';
import storage from 'redux-persist/lib/storage';
import createRootReducer from './modules';
import rootSaga from './sagas';

const sagaMiddleware = createSagaMiddleware();

/**
 *
 * @param {*} preloadedState
 */
export default function configureAppStore(preloadedState) {
  const persistConfig = {
    key: 'root',
    storage,
  };
  const rootReducer = createRootReducer();
  const persistedReducer = persistReducer(persistConfig, rootReducer);
  const store = configureStore({
    reducer: persistedReducer,
    middleware: [sagaMiddleware],
    preloadedState,
    enhancers: []
  });

  if (process.env.NODE_ENV !== 'production' && module.hot) {
    module.hot.accept('./modules', () => store.replaceReducer(rootReducer));
  }

  sagaMiddleware.run(rootSaga);

  const persistor = persistStore(store);
  return { store, persistor };
}

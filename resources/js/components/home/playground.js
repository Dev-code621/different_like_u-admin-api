import React from 'react';

const Playground = () => (
  <main className="container">
    <h1>h1</h1>
    <h2>h2</h2>
    <h3>h3</h3>

    <div className="my-2">
      <button type="button" className="btn primary">
        Primary
      </button>
    </div>

    <div className="my-2">
      <button type="button" className="btn secondary">
        Secondary
      </button>
    </div>

    <div className="my-2">
      <button type="button" className="btn primary ghost">
        Ghost primary
      </button>
    </div>

    <div className="my-2">
      <button type="button" className="btn secondary ghost">
        Ghost secondary
      </button>
    </div>

    <div className="my-2">
      <button type="button" className="btn secondary" disabled>
        Disabled
      </button>
    </div>

    <div className="my-2">
      <button type="button" className="btn primary sm">
        Sm Primary
      </button>
    </div>

    <div className="my-2">
      <button type="button" className="btn secondary sm">
        Sm Secondary
      </button>
    </div>

    <div className="my-2">
      <button type="button" className="btn primary ghost sm">
        Sm Ghost primary
      </button>
    </div>

    <div className="my-2">
      <button type="button" className="btn secondary sm" disabled>
        Sm Secondary
      </button>
    </div>
  </main>
);

export default Playground;

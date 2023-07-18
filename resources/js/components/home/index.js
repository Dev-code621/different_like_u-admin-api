import React from 'react';

const Home = () => (
  <main>
    <div class="row">
      <div class="mx-auto">
        <div class="md:flex">
          <div class="p-left">
            <h3>Hi! Let’s find your business first</h3>
              <p class="py-5">Using valuable feedback, data and educational resources Sacki can help you gain an advantage over competitors</p>
              <div class="input-business-name">
                <label class="pure-material-textfield-outlined" for="business-name">
                    <input placeholder=" " class="" id="business-name" type="business-name" name="business-name" required></input>
                    <span>Enter your business name</span>
                </label>
                <div class="py-5">
                  <button class="btn btn-default btn-primary continue-btn" type="submit">Continue</button>
                </div>
              </div>
              </div>
              <div class="md:flex-shrink-0">
                  <img class=" w-full object-cover " src="/images/dashboard/good-vibes-image.png" alt="Man looking at item at a store"></img>
              </div>
          </div>
        </div>
      </div>
  </main>
);

export default Home;

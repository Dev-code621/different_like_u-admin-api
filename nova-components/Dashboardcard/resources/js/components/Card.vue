<template>
  <div class="flex justify-center items-centers">
    <div class="w-full max-w-xl">
      <heading class="flex mb-3">Sacki Admin Dashboard</heading>
      

      <card>
        <table class="w-full" cellpadding="0" cellspacing="0">
          <tr>
            <td class="align-top w-1/2 border-r border-b border-50">
              <a :href="resources" class="no-underline flex p-6">
                <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg class="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 56 56"><g fill="none" stroke="var(--primary)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><path d="M24 44c11.046 0 20-8.954 20-20a19.937 19.937 0 0 0-5.845-14.13A19.938 19.938 0 0 0 24 4A19.938 19.938 0 0 0 9.845 9.87A19.937 19.937 0 0 0 4 24c0 11.046 8.954 20 20 20z"/><path d="M4 24h4"/><path d="M9.845 9.87l3.13 3.13"/><path d="M24 4v4"/><path d="M44 24h-4"/><path d="M38.155 9.87L35.025 13"/><path d="M24 20v12"/><path d="M39.852 36.196C36.197 40.942 30.456 44 24 44s-12.195-3.058-15.852-7.804A31.853 31.853 0 0 1 24 32a31.854 31.854 0 0 1 15.852 4.196z"/></g></svg>
                </div>

                <div>
                  <heading :level="3" class="mb-3">Users Admin</heading>
                  <p class="text-90 leading-normal">
                    This is where you can manage all Sacki users. You can ban, unban and reset the passwords of app and merchant users, and you can add admin users to the system.
                  </p>
                </div>
              </a>
            </td>
            <td class="align-top w-1/2 border-r border-b border-50">
              <a :href="resources" class="no-underline flex p-6">
                <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg class="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g stroke-width="1.5" fill="none"><path d="M20.485 3h-3.992l.5 5s1 1 2.5 1a3.23 3.23 0 0 0 2.139-.806a.503.503 0 0 0 .15-.465L21.076 3.5A.6.6 0 0 0 20.485 3z" stroke="var(--primary)"/><path d="M16.493 3l.5 5s-1 1-2.5 1s-2.5-1-2.5-1V3h4.5z" stroke="var(--primary)"/><path d="M11.993 3v5s-1 1-2.5 1s-2.5-1-2.5-1l.5-5h4.5z" stroke="var(--primary)"/><path d="M7.493 3H3.502a.6.6 0 0 0-.592.501L2.205 7.73c-.029.172.02.349.15.465c.328.29 1.061.806 2.138.806c1.5 0 2.5-1 2.5-1l.5-5z" stroke="var(--primary)"/><path d="M3 9v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9" stroke="var(--primary)"/><path d="M14.833 21v-6a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v6" stroke="var(--primary)" stroke-miterlimit="16"/></g></svg>
                </div>

                <div>
                  <heading :level="3" class="mb-3">Content Manager</heading>
                  <p class="text-90 leading-normal">
                    This is where you manage all of the content on the Sacki merchant dashboard and user app. You can add and delete blog posts, "Sacki says" educational content and training resources.
                  </p>
                </div>
              </a>
            </td>
          </tr>

          <tr>
            <td class="align-top w-1/2 border-r border-b border-50">
              <a :href="filters" class="no-underline flex p-6">
                <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg class="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 40 40"><path d="M22 22v6H6V4h10V2H6a2 2 0 0 0-2 2v24a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6z" fill="var(--primary)"/><path d="M29.54 5.76l-3.3-3.3a1.6 1.6 0 0 0-2.24 0l-14 14V22h5.53l14-14a1.6 1.6 0 0 0 0-2.24zM14.7 20H12v-2.7l9.44-9.45l2.71 2.71zM25.56 9.15l-2.71-2.71l2.27-2.27l2.71 2.71z" fill="var(--primary)"/></svg>
                </div>

                <div>
                  <heading :level="3" class="mb-3">Claim Requests</heading>
                  <p class="text-90 leading-normal">
                    Come here to manage all claim requests from Merchants. if you see a red dot flashing, that means a new claim request is ready for your review. You can accept and reject requests here.
                  </p>
                </div>
              </a>
            </td>

            <td class="align-top w-1/2 border-r border-b border-50">
              <a :href="lenses" class="no-underline flex p-6">
                <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg class="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="var(--primary)"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z"/></g></svg>
                </div>

                <div>
                  <heading :level="3" class="mb-3">Flagged Content</heading>
                  <p class="text-90 leading-normal">
                    This is where you can manage flagged content, you can delete, dismiss or ban users from here.
                  </p>
                </div>
              </a>
            </td>
          </tr>

        </table>
      </card>
    </div>
  </div>
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    mounted() {
        //
    },
}
</script>

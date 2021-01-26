<template>
    <div>
        <form class="mt-8 space-y-6" method="POST" action="#" @submit.prevent="handleLogin">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input v-model="formData.email"
                            id="email" name="email" type="email"
                           required autocomplete="email" autofocus
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm  @error('email') border-red-800 @enderror"
                           placeholder="Email address">
                </div>

                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input v-model="formData.password" id="password" type="password"
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('password') border-red-800 @enderror"
                           name="password" required autocomplete="current-password" placeholder="Password">
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <!-- Heroicon name: lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                    clip-rule="evenodd"/>
            </svg>
          </span>
                    Sign in
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "LoginComponent",
    data() {
        return {
            formData: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        handleLogin() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                console.log(this.formData)
                axios.post('api/login', this.formData).then(response => {
                    localStorage.setItem('user', JSON.stringify(userData));
                    axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
                }).catch(error => console.log(error)); // credentials didn't match
            });
        }
    }
}
</script>

<style scoped>

</style>

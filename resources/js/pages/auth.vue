<template>
    <div class="flex flex-col md:flex-row h-screen items-center">
        <div class="bg-indigo-600 h-36 md:h-full w-full md:w-3/12 lg:9/12 xl:w-9/12 h-screen">
            <img v-bind:src="bgImage01" alt="" class="w-full h-full object-cover">
        </div>
        <div class="bg-white w-full max-w-full md:mx-auto md:mx-0 md:w-9/12 lg:3/12 xl:w-3/12 h-screen px-6 lg:px-16 xl:px-8 flex items-center justify-center">
            <div class="w-full h-100">
                <h1 class="text-xl md:text-2xl font-bold leading-tight">Log in to your account</h1>
                <form class="mt-6" action="#" method="POST" @submit.prevent="handleLogin">
                    <div class="text-red-500 bg-red-200 px-3 py-2 mb-3 rounded-md" v-if="formData.error">{{formData.error}}</div>
                    <div>
                        <label class="block text-gray-700">Email Address</label>
                        <input type="email" name="" id="" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete v-model="formData.email" required />
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700">Password</label>
                        <input type="password" name="" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" v-model="formData.password" required />
                    </div>
                    <div class="text-right mt-2">
                        <a href="#" class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700">Forgot Password?</a>
                    </div>
                    <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6" :disabled="formData.loading">Log In</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import router from '../router';
import { handleLogin } from '../services';

const bgImage01 = '/assets/images/backgrounds/bg-01.jpg';
export default {
    name: 'Auth',
    data() {
        return {
            secrets: [],
            bgImage01,
            formData: {
                email: 'admin@imanager.com',//'moaj257@gmail.com',
                password: 'password',//'||==||moaj257@gmail.com-secret',
                error: '',
                loading: false
            },
        };
    }, methods: {
        async handleLogin() {
            this.formData.loading = true;
            this.formData.error = '';
            await handleLogin(this.formData)
                    .then(({data}) => {
                        const {token, user} = data.data;
                        localStorage.setItem('user', JSON.stringify(user));
                        localStorage.setItem('_token', token);
                        router.push({name: 'store'});
                    })
                    .catch(() => {
                        this.formData.loading = false;
                        this.formData.error = 'Credentials does not match!';
                    });
        }
    }
}
</script>
<template>
    <div class="auth-layout">
        <div class="flex flex-row h-screen w-screen overflow-hidden">
            <div class="h-full w-16 bg-blue-800">
                <div class="flex flex-col items-center justify-between h-full">
                    <div class="flex items-center justify-center py-2 w-full">
                        <img src="/assets/images/avatar/profile.jpg" alt="logo" class="h-10 w-10 rounded-full overflow-hidden bg-blue-900 border border-blue-900">
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div class="p-2 my-1 rounded-lg hover:bg-blue-900">
                            <i data-eva="grid-outline" data-eva-fill="#fff" data-eva-height="24" data-eva-width="24"></i>
                        </div>
                        <div class="p-2 my-1 rounded-lg bg-blue-900">
                            <i data-eva="briefcase-outline" data-eva-fill="#fff" data-eva-height="24" data-eva-width="24"></i>
                        </div>
                        <div class="p-2 my-1 rounded-lg hover:bg-blue-900">
                            <i data-eva="people-outline" data-eva-fill="#fff" data-eva-height="24" data-eva-width="24"></i>
                        </div>
                        <div class="p-2 my-1 rounded-lg hover:bg-blue-900">
                            <i data-eva="bell-outline" data-eva-fill="#fff" data-eva-height="24" data-eva-width="24"></i>
                        </div>
                        <div class="p-2 my-1 rounded-lg hover:bg-blue-900">
                            <i data-eva="settings-2-outline" data-eva-fill="#fff" data-eva-height="24" data-eva-width="24"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <button @click="() => handleLogout()" class="p-2 my-1 rounded-lg hover:bg-blue-900">
                            <i data-eva="log-out-outline" data-eva-fill="#fff" data-eva-height="24" data-eva-width="24"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-full flex-grow">
                <div class="p-2 h-screen overflow-y-scroll">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import * as eva from 'eva-icons';
import router from '../router';
import { handleLogout } from '../services';
export default {
    mounted() {
        eva.replace();
    }, methods: {
        async handleLogout() {
            await handleLogout()
                    .then(res => {
                        localStorage.setItem('user', JSON.stringify({}));
                        localStorage.setItem('_token', '');
                        router.push({name: 'auth'});
                    }).catch(e => {
                        router.push({name: 'auth'});
                    })
        }
    }
}
</script>
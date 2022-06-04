import axios from 'axios';

const instance = axios.create();
const token = localStorage.getItem('_token');
instance.defaults.withCredentials = false;
if(token) {
    instance.defaults.headers.Authorization = `Bearer ${token}`;
}

export const handleLogin = async (data) => await instance.post('api/auth/login', data);
export const handleLogout = async () => await instance.post('api/auth/logout');
export const mydata = async () => await instance.get('api/me');

// manufacturers
export const getManufacturersList = async (page = 1) => await instance.get(`api/manufacturer?page=${page}`);
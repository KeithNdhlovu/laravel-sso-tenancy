import './bootstrap'

import { createApp } from "vue"

import MainApp from "./components/passport/MainApp.vue"

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

const app = createApp(MainApp)
app.mount("#app")
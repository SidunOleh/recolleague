import './bootstrap'
import * as bootstrap from 'bootstrap'
import { createApp } from 'vue'
import adminPanelApp from './components/admin-panel/App.vue'
import adminPanelRouter from './routes/admin-panel'
import './scripts/admin-panel'

const adminPanel = createApp(adminPanelApp)
adminPanel.use(adminPanelRouter)
adminPanel.mount('#admin-panel-app')

console.log(1)
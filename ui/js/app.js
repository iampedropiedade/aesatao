import { createApp } from 'vue'
import ImageGallery from './vue/components/Gallery/Main.vue';
import HubspotForm from './vue/components/Hubspot/Main.vue';
import EventCalendar from './vue/components/Calendar/Main.vue';
import ItemList from './vue/components/ItemList/Main.vue';
import NavAuthentication from './vue/components/Authentication/Main.vue';
import GoogleDrive from './vue/components/GoogleDrive/Main.vue';
import FuzzySearch from './vue/components/FuzzySearch/Main.vue';
import GoogleForm from './vue/components/GoogleForm/Main.vue';
import dayjs from 'dayjs'
import relativeTime from "dayjs/plugin/relativeTime"
import pt from 'dayjs/locale/pt'
import router from './vue/router/router.js'
import { createPinia } from 'pinia'
import VueTyped from 'vue3-typed-js';

dayjs.extend(relativeTime).locale(pt)
const pinia = createPinia()

const app = createApp({
    components: {
        ImageGallery,
        HubspotForm,
        ItemList,
        EventCalendar,
        GoogleDrive,
        GoogleForm,
        FuzzySearch,
    },
    pinia
})
dayjs.locale('pt')
app.config.globalProperties.$dayjs = dayjs
app.use(pinia)
app.use(VueTyped)
app.use(router)
app.mount('#website-app')

const observer = new MutationObserver(() => {
    document.querySelectorAll('.navbar .navbar-other .navbar-nav').forEach(targetElement => {
        if (!targetElement.dataset.vueMounted) {

            const authButton = createApp(NavAuthentication);
            // const aiModalButton = createApp(AiModalButton);
            // const aiModalButtonInstance = aiModalButton.mount(document.createElement('div'));
            const authButtonInstance = authButton.mount(document.createElement('div'));
            targetElement.appendChild(authButtonInstance.$el);
            if (targetElement.lastElementChild) {
                //targetElement.insertBefore(aiModalButtonInstance.$el, targetElement.lastElementChild);
                targetElement.insertBefore(authButtonInstance.$el, targetElement.lastElementChild);
            } else {
                //targetElement.appendChild(aiModalButtonInstance.$el);
                targetElement.appendChild(authButtonInstance.$el);
            }
            targetElement.dataset.vueMounted = "true";
        }
    });
});
observer.observe(document.body, { childList: true, subtree: true });

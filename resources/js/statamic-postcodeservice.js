import Postcodeservice from "./fieldtypes/Postcodeservice.vue";

Statamic.booting(() => {
    Statamic.component('postcodeservice-fieldtype', Postcodeservice);
});
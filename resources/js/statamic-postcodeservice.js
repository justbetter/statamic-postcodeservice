import Postcodeservice from "./fieldtypes/Postcodeservice.vue";

Statamic.booting(() => {
    Statamic.$components.register('postcodeservice-fieldtype', Postcodeservice);
});

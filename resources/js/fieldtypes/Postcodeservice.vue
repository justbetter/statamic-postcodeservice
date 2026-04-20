<template>

    <div>
        <Input :model-value="value" @update:model-value="update" />
    </div>

</template>

<script setup>
import { Input } from '@statamic/cms/ui';
import { Fieldtype } from '@statamic/cms';

const emit = defineEmits(Fieldtype.emits);
const props = defineProps(Fieldtype.props);
const { expose, value, update } = Fieldtype.use(emit, props);
defineExpose(expose);
</script>

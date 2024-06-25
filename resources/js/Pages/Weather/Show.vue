<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    weather: Object,
});

const form = useForm({
    date: "",
});

const submit = () => {
    form.get(route("weather"));
};
</script>
<template>
    <Head title="Weather" />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form @submit.prevent="submit">
                        <div class="mt-4 flex items-center justify-between">
                            <TextInput
                                id="date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.date"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <PrimaryButton
                                :class="{
                                    'opacity-25 w-full': form.processing,
                                }"
                                :disabled="form.processing"
                            >
                                Get Weather
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

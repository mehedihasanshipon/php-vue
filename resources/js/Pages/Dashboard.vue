<template>
	<app-layout title="Dashboard">
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="max-w-2xl mx-auto bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<!-- <welcome /> -->

					<!-- <welcome /> -->
				</div>
			</div>
		</div>
	</app-layout>
</template>

<script>
import {defineComponent} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import Welcome from "@/Jetstream/Welcome.vue"
import {useForm} from "@inertiajs/inertia-vue3"

export default defineComponent({
	components: {
		AppLayout,
		Welcome,
	},
	setup() {
		const form = useForm({
			name: null,
			id: null,
			course: null,
		})
		const submit = () => {
			form.post(route("marksheets.store"), {
				preserveScroll: true,
				preserveState: true,
				onSuccess: () => form.reset("name", "id", "course"),
			})
		}
		return {
			submit,
			form,
		}
	},
})
</script>

<template>
	<app-layout title="Dashboard">
		<div>
			<div class="flex justify-between">
				<Breadcrumb
					:links="[
						{title: 'Application', url: '/'},
						{title: 'Marks', url: '/marks'},
					]"
				/>

				<Link :href="route('marks.create')" class="bg-cyan-300 px-2 py-2 text-white rounded-md"> Create </Link>
			</div>

			<!-- Activity table (small breakpoint and up) -->
			<div class="container mx-auto">
				<div class="flex flex-col mt-2">
					<div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-md sm:rounded-lg">
						<table class="min-w-full divide-y divide-gray-200">
							<thead>
								<tr>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mark</th>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								<tr v-for="(mark, index) in marks" :key="index" class="bg-white">
									<td class="px-3 py-2 lg:px-6 lg:py-3 whitespace-nowrap text-sm text-gray-900">
										{{ index + 1 }}
									</td>
									<td class="px-3 py-2 lg:px-6 lg:py-3 whitespace-nowrap text-sm text-gray-900">
										{{ mark.student.name }}
									</td>
									<td class="px-3 py-2 lg:px-6 lg:py-3 whitespace-nowrap text-sm text-gray-900">
										{{ mark.course.course_name }}
									</td>
									<td class="px-3 py-2 lg:px-6 lg:py-3 whitespace-nowrap text-sm text-gray-900">
										{{ mark.marks }}
									</td>
									<td class="px-3 py-2 lg:px-6 lg:py-3 text-right whitespace-nowrap text-sm text-gray-900">
										<div class="flex justify-end space-x-2 text-right">
											<Link :href="route('marks.edit', mark.id)">
												<PencilAltIcon class="h-5 w-5 text-primary" />
											</Link>
											<button @click="openModel(mark.id)">
												<TrashIcon class="h-5 w-5 text-red-500" />
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<TransitionRoot as="template" :show="open">
			<Dialog as="div" static class="fixed z-10 inset-0 overflow-y-auto" @close="open = false" :open="open">
				<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
						<DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
					</TransitionChild>

					<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
						<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
							<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
								<div class="sm:flex sm:items-start">
									<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
										<ExclamationIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
									</div>
									<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
										<DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">Delete Mark? </DialogTitle>
										<div class="mt-2">
											<p class="text-sm text-gray-500">Are you sure you want to delete the Mark? All of your data will be permanently removed. This action cannot be undone.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
								<button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="deleteRole()">Delete</button>
								<button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancel</button>
							</div>
						</div>
					</TransitionChild>
				</div>
			</Dialog>
		</TransitionRoot>
		<!--End Modal -->
	</app-layout>
</template>

<script>
import {defineComponent, reactive, ref, watch} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import Breadcrumb from "../Components/Breadcrumb.vue"
import {Link} from "@inertiajs/inertia-vue3"
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot, Switch} from "@headlessui/vue"
import {PencilAltIcon, TrashIcon, ExclamationIcon} from "@heroicons/vue/outline"
import {Inertia} from "@inertiajs/inertia"

export default defineComponent({
	components: {
		AppLayout,
		Breadcrumb,
		Link,
		PencilAltIcon,
		TrashIcon,
		Dialog,
		DialogOverlay,
		DialogTitle,
		TransitionChild,
		TransitionRoot,
		ExclamationIcon,
		Switch,
	},
	props: {
		marks: Array,
	},
	setup(props) {
		const open = ref(false)
		const mark = ref(null)

		function openModel(id) {
			mark.value = id
			open.value = true
		}

		function deleteRole() {
			Inertia.delete(route("marks.destroy", mark.value), {
				preserveState: true,
				preserveScroll: true,
				onSuccess: (page) => {
					open.value = false
				},
			})
		}

		return {
			open,
			openModel,
			deleteRole,
		}
	},
})
</script>

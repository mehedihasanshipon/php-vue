<template>
	<aside class="h-full">
		<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
		<transition enter-active-class="transition-all duration-800 ease-in-out" enter-from-class="transform w-0 opacity-0" enter-to-class="transform w-100 opacity-100" leave-active-class="transition-all duration-40 ease-in-out" leave-from-class="transform w-100 opacity-100" leave-to-class="transform w-0 opacity-0">
			<div v-if="sidebar" class="fixed inset-0 flex z-40 h-full" role="dialog" aria-modal="true">
				<div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
				<div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-50">
					<div class="absolute top-0 right-0 -mr-12 pt-2">
						<button @click="sidebar = false" type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
							<span class="sr-only">Close sidebar</span>
							<XIcon class="h-6 w-6 text-white" />
						</button>
					</div>

					<div class="flex-shrink-0 flex items-center px-4">
						<h1 class="text-xl font-semibold">{{ $page.props.organization.name }}</h1>
					</div>
					<div class="mt-5 flex-1 h-0 overflow-y-auto">
						<nav class="px-2 space-y-1">
							<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
							<!-- Menus for Admin -->
							<div>
								<Link v-for="(menu, index) in menus" :key="index" :href="menu.path" class="text-gray-500 hover:text-primary group flex items-center px-3 py-2 text-sm font-medium rounded-full transition duration-300">
									<component :is="menu.icon" class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5"></component>
									{{ menu.name }}
								</Link>
							</div>
						</nav>
					</div>
				</div>

				<div class="flex-shrink-0 w-14">
					<!-- Dummy element to force sidebar to shrink to fit close icon -->
				</div>
			</div>
		</transition>
		<!-- Static sidebar for desktop -->
		<div class="hidden md:flex md:flex-shrink-0 h-full">
			<div class="flex flex-col w-52">
				<!-- Sidebar component, swap this element with another sidebar if you like -->
				<div class="flex-1 flex flex-col min-h-0">
					<div class="flex flex-col gap-2 h-auto px-4 pt-2 bg-gray-50">Dashboard</div>

					<div class="flex-1 flex flex-col overflow-y-auto">
						<nav class="flex-1 px-2 py-4 bg-gray-50 space-y-1">
							<!-- Current: "bg-light text-primary", Default: "text-gray-500 hover:bg-light hover:text-primary" -->
							<div>
								<Link v-for="(menu, index) in menus" :key="index" :href="menu.path" class="text-gray-500 hover:text-primary group flex items-center px-3 py-2 text-sm font-medium rounded-full transition duration-300">
									<component :is="menu.icon" class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5"></component>
									{{ menu.name }} <span class="flex-1 flex items-center justify-center ml-2 bg-cyan-400 text-white text-sm px-1 py-1 rounded-full" v-show="menu.path == '/pre-registers'">{{ $page.props.preRegistrationCount }}</span>
								</Link>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</aside>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3"
import {CogIcon, ChevronDownIcon, ChevronUpIcon, XIcon, HomeIcon, OfficeBuildingIcon, TemplateIcon, PuzzleIcon, BadgeCheckIcon, UserGroupIcon, UserCircleIcon} from "@heroicons/vue/outline"

const menus = [
	{
		name: "Dashboard",
		path: "/dashboard",
		icon: HomeIcon,
	},
	{
		name: "Student",
		path: "/students",
		icon: CogIcon,
	},
	{
		name: "Courses",
		path: "/courses",
		icon: CogIcon,
	},
	{
		name: "Marks",
		path: "/marks",
		icon: CogIcon,
	},
]

export default {
	name: "Sidebar",
	components: {
		Link,
		CogIcon,
		ChevronDownIcon,
		ChevronUpIcon,
		XIcon,
	},
	props: {
		sidebar: {
			type: Boolean,
			required: true,
		},
	},
	data() {
		return {
			dropdownNav: null,
			hideMobileSidebar: false,
			menus,
		}
	},
	methods: {
		toggleNavs(val) {
			this.dropdownNav = val
		},
		closeSidebar() {
			props.sidebar = this.hideMobileSidebar
		},
	},
}
</script>

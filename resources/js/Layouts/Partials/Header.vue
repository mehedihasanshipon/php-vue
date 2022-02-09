<template>
	<div class="relative z-10 flex-shrink-0 flex items-center h-24 bg-white shadow">
		<button type="button" @click="showSideBar" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
			<span class="sr-only">Open sidebar</span>
			<MenuAlt2Icon class="h-6 w-6" />
		</button>

		<div class="flex-1 px-4 flex justify-between py-4">
			<div class="ml-auto flex gap-x-3 items-center">
				<!-- Profile dropdown -->
				<div class="relative">
					<div>
						<button @click="toggleMenu" type="button" class="bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false" aria-haspopup="true">
							<!-- <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.logo ? $page.props.auth.user.logo : '/images/demo-profile.png'" alt="Profile photo" /> -->
						</button>
					</div>

					<!--
                      Dropdown menu, show/hide based on menu state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
					<div v-if="showMenu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
						<!-- Active: "bg-gray-100", Not Active: "" -->
						<Link :href="route('profile.show')" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Your Profile </Link>

						<Link :href="route('logout')" method="post" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Sign out </Link>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3"
import {ref} from "@vue/reactivity"
import {MenuAlt2Icon, HomeIcon} from "@heroicons/vue/outline"

export default {
	name: "Header",
	components: {
		Head,
		Link,
		MenuAlt2Icon,
		HomeIcon,
	},
	setup(props, {emit}) {
		const showNotification = ref(false)
		const toggleNotification = () => {
			showNotification.value = !showNotification.value
			showMenu.value = false
		}
		const showMenu = ref(false)
		const toggleMenu = () => {
			showMenu.value = !showMenu.value
			showNotification.value = false
		}

		const showSideBar = () => {
			emit("toggleSidebar")
		}

		return {
			showMenu,
			toggleMenu,
			showSideBar,
			showNotification,
			toggleNotification,
		}
	},
}
</script>

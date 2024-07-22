<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import UsersOutline from "@/Components/Svg/UsersOutline.vue";
import HomeOutline from "@/Components/Svg/HomeOutline.vue";
import BuildingOffice2Outline from "@/Components/Svg/BuildingOffice2Outline.vue";
import ClipboardDocumentListOutline from "@/Components/Svg/ClipboardDocumentListOutline.vue";

defineProps({
    title: String,
});

const toggleNavigation = ref(false);
const toggleResponsiveNavigation = ref(false);

const switchToTeam = (team) => {
    router.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const logout = () => {
    router.post(route("logout"));
};

const triggerLink = (event) =>  {
    // Prevent the default behavior if necessary
    event.preventDefault();

    // Find the `a` tag within the `li` tag
    const link = event.currentTarget.querySelector('a');

    // Programmatically trigger the `a` tag click
    if (link) {
    link.click();
    }
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen flex bg-gray-100 dark:bg-gray-900">
            <aside
                :class="toggleNavigation ? 'w-[50px]' : 'w-72' "
                class="lg:flex hidden min-h-screen w-72 bg-indigo-600 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 transition-all"
            >
                <!-- Primary Navigation Menu -->
                <div
                    :class="toggleNavigation ? 'sm:py-2 sm:px-2' : 'sm:py-4 sm:px-4'"
                    class="px-4 py-4 sm:px-4 sm:py-4 w-full"
                    >
                    <div
                        :class="{
                            'flex justify-center mt-4': toggleNavigation
                        }"
                        class="w-full"
                    >
                        <Link :href="route('dashboard')" class="flex items-center">
                            <ApplicationMark
                                :class="{
                                    '!h-6': toggleNavigation
                                }"
                                class="block h-9 w-auto"
                            />
                            <span v-if="!toggleNavigation" class="ms-2 text-lg text-white font-extrabold dark:text-white">LRE Co.</span>
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="min-h-screen py-4 mt-4 overflow-y-auto">
                        <ul class="space-y-2 font-medium">
                            <li
                                @click="triggerLink($event)"
                                :class="{
                                    'bg-indigo-700 dark:bg-gray-900' : route().current('dashboard'),
                                    'justify-center !py-1' : toggleNavigation
                                }"
                                class="hover:bg-indigo-700 py-2 px-2 w-full cursor-pointer rounded-md dark:hover:bg-gray-900 flex items-center dark:text-white text-white"
                            >
                                <NavLink
                                    class="text-white w-full"
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    <HomeOutline
                                        :class="toggleNavigation ? 'size-5 font-extrabold' : 'size-6 me-2' "
                                    />
                                    <span v-if="!toggleNavigation">Dashboard</span>
                                </NavLink>
                            </li>
                            <li
                                @click="triggerLink($event)"
                                :class="{
                                    'bg-indigo-700 dark:bg-gray-900' : route().current('articles*'),
                                    'justify-center !py-1' : toggleNavigation
                                }"
                                class="hover:bg-indigo-700 py-2 px-2 w-full cursor-pointer rounded-md dark:hover:bg-gray-900 flex items-center dark:text-white text-white"
                            >
                                <NavLink
                                    class="text-white w-full"
                                    :href="route('articles.index')"
                                    :active="route().current('articles*')"
                                >
                                    <ClipboardDocumentListOutline
                                        :class="toggleNavigation ? 'size-5 font-extrabold' : 'size-6 me-2' "
                                    />
                                    <span v-show="!toggleNavigation">All Media</span>
                                </NavLink>
                            </li>
                            <li
                                @click="triggerLink($event)"
                                v-if="$page.props.auth.user.type == $page.props.user_types.EDITOR"
                                :class="{
                                    'bg-indigo-700 dark:bg-gray-900' : route().current('users*'),
                                    'justify-center !py-1' : toggleNavigation
                                }"
                                class="hover:bg-indigo-700 py-2 px-2 w-full cursor-pointer rounded-md dark:hover:bg-gray-900 flex items-center dark:text-white text-white"
                            >
                                <NavLink
                                    class="text-white w-full"
                                    :href="route('users.index')"
                                    :active="route().current('users*')"
                                >
                                    <UsersOutline
                                        :class="toggleNavigation ? 'size-5 font-extrabold' : 'size-6 me-2' "
                                    />
                                    <span v-show="!toggleNavigation">Users</span>
                                </NavLink>
                            </li>
                            <li
                                @click="triggerLink($event)"
                                v-if="$page.props.auth.user.type == $page.props.user_types.EDITOR"
                                :class="{
                                    'bg-indigo-700 dark:bg-gray-900' : route().current('companies*'),
                                    'justify-center !py-1' : toggleNavigation
                                }"
                                class="hover:bg-indigo-700 py-2 px-2 w-full cursor-pointer rounded-md dark:hover:bg-gray-900 flex items-center dark:text-white text-white"
                            >
                                <NavLink
                                    class="text-white w-full"
                                    :href="route('companies.index')"
                                    :active="route().current('companies*')"
                                >
                                    <ClipboardDocumentListOutline
                                        :class="toggleNavigation ? 'size-5 font-extrabold' : 'size-6 me-2' "
                                    />
                                    <span v-show="!toggleNavigation">Companies</span>
                                </NavLink>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>

             <!-- Responsive Navigation Menu -->
            <div v-if="toggleResponsiveNavigation" class="bg-black/50 z-50 fixed w-full">
                <aside
                    class="min-h-screen  w-72 bg-indigo-600 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 transition-all"
                >
                    <!-- Primary Navigation Menu -->
                    <div
                        :class="toggleNavigation ? 'sm:py-2 sm:px-2' : 'sm:py-4 sm:px-4'"
                        class="px-4 py-4 sm:px-4 sm:py-4 w-full"
                        >
                        <div
                            :class="{
                                'flex justify-center mt-4': toggleNavigation
                            }"
                            class="w-full"
                        >
                            <Link :href="route('dashboard')">
                                <ApplicationMark
                                    :class="{
                                        '!h-6': toggleNavigation
                                    }"
                                    class="block h-9 w-auto"
                                />
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="min-h-screen py-4 mt-4 overflow-y-auto">
                            <ul class="space-y-2 font-medium">
                                <li
                                    @click="triggerLink($event)"
                                    :class="{
                                        'bg-indigo-700 dark:bg-gray-900' : route().current('dashboard'),
                                        'justify-center !py-1' : toggleNavigation
                                    }"
                                    class="hover:bg-indigo-700 py-2 px-2 w-full cursor-pointer rounded-md dark:hover:bg-gray-900 flex items-center dark:text-white text-white"
                                >
                                    <NavLink
                                        class="text-white w-full"
                                        :href="route('dashboard')"
                                        :active="route().current('dashboard')"
                                    >
                                        <HomeOutline
                                            :class="toggleNavigation ? 'size-5 font-extrabold' : 'size-6 me-2' "
                                        />
                                        <span v-if="!toggleNavigation">Dashboard</span>
                                    </NavLink>
                                </li>
                                <li
                                    @click="triggerLink($event)"
                                    :class="{
                                        'bg-indigo-700 dark:bg-gray-900' : route().current('articles*'),
                                        'justify-center !py-1' : toggleNavigation
                                    }"
                                    class="hover:bg-indigo-700 py-2 px-2 w-full cursor-pointer rounded-md dark:hover:bg-gray-900 flex items-center dark:text-white text-white"
                                >
                                    <NavLink
                                        class="text-white w-full"
                                        :href="route('articles.index')"
                                        :active="route().current('articles*')"
                                    >
                                        <ClipboardDocumentListOutline
                                            :class="toggleNavigation ? 'size-5 font-extrabold' : 'size-6 me-2' "
                                        />
                                        <span v-show="!toggleNavigation">All Media</span>
                                    </NavLink>
                                </li>
                                <li
                                    @click="triggerLink($event)"
                                    v-if="$page.props.auth.user.type == $page.props.user_types.EDITOR"
                                    :class="{
                                        'bg-indigo-700 dark:bg-gray-900' : route().current('users*'),
                                        'justify-center !py-1' : toggleNavigation
                                    }"
                                    class="hover:bg-indigo-700 py-2 px-2 w-full cursor-pointer rounded-md dark:hover:bg-gray-900 flex items-center dark:text-white text-white"
                                >
                                    <NavLink
                                        class="text-white w-full"
                                        :href="route('users.index')"
                                        :active="route().current('users*')"
                                    >
                                        <UsersOutline
                                            :class="toggleNavigation ? 'size-5 font-extrabold' : 'size-6 me-2' "
                                        />
                                        <span v-show="!toggleNavigation">Users</span>
                                    </NavLink>
                                </li>
                                <li
                                    @click="triggerLink($event)"
                                    v-if="$page.props.auth.user.type == $page.props.user_types.EDITOR"
                                    :class="{
                                        'bg-indigo-700 dark:bg-gray-900' : route().current('companies*'),
                                        'justify-center !py-1' : toggleNavigation
                                    }"
                                    class="hover:bg-indigo-700 py-2 px-2 w-full cursor-pointer rounded-md dark:hover:bg-gray-900 flex items-center dark:text-white text-white"
                                >
                                    <NavLink
                                        class="text-white w-full"
                                        :href="route('companies.index')"
                                        :active="route().current('companies*')"
                                    >
                                        <ClipboardDocumentListOutline
                                            :class="toggleNavigation ? 'size-5 font-extrabold' : 'size-6 me-2' "
                                        />
                                        <span v-show="!toggleNavigation">Companies</span>
                                    </NavLink>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
                <div class="absolute top-0 end-0 pr-5 md:pr-10 mt-5">
                    <button @click="toggleResponsiveNavigation = !toggleResponsiveNavigation" class="text-white font-extrabold">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-9">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Page Content -->
            <main class="w-full">
                <!-- Page Heading -->
                <nav class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between">
                        <!-- Hamburger -->
                        <div class="lg:flex hidden">
                            <div class="-me-2 flex items-center">
                                <button
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                                    @click="
                                        toggleNavigation =
                                            !toggleNavigation
                                    "
                                >
                                    <svg
                                        class="h-6 w-6"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            :class="{
                                                hidden: toggleNavigation,
                                                'inline-flex':
                                                    !toggleNavigation,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{
                                                hidden: !toggleNavigation,
                                                'inline-flex':
                                                toggleNavigation,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Responsive Hamburger -->
                        <div class="lg:hidden flex">
                            <div class="-me-2 flex items-center">
                                <button
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                                    @click="
                                        toggleResponsiveNavigation =
                                            !toggleResponsiveNavigation
                                    "
                                >
                                    <svg
                                        class="h-6 w-6"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            :class="{
                                                hidden: toggleNavigation,
                                                'inline-flex':
                                                    !toggleNavigation,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{
                                                hidden: !toggleNavigation,
                                                'inline-flex':
                                                toggleNavigation,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex sm:items-center sm:ms-6">
                            <div class="ms-3 relative">
                                <!-- Teams Dropdown -->
                                <Dropdown
                                    v-if="$page.props.jetstream.hasTeamFeatures"
                                    align="right"
                                    width="60"
                                >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150"
                                            >
                                                {{
                                                    $page.props.auth.user
                                                        .current_team.name
                                                }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-400"
                                            >
                                                Manage Team
                                            </div>

                                            <!-- Team Settings -->
                                            <DropdownLink
                                                :href="
                                                    route(
                                                        'teams.show',
                                                        $page.props.auth.user
                                                            .current_team
                                                    )
                                                "
                                            >
                                                Team Settings
                                            </DropdownLink>

                                            <DropdownLink
                                                v-if="
                                                    $page.props.jetstream
                                                        .canCreateTeams
                                                "
                                                :href="route('teams.create')"
                                            >
                                                Create New Team
                                            </DropdownLink>

                                            <!-- Team Switcher -->
                                            <template
                                                v-if="
                                                    $page.props.auth.user
                                                        .all_teams.length > 1
                                                "
                                            >
                                                <div
                                                    class="border-t border-gray-200 dark:border-gray-600"
                                                />

                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    Switch Teams
                                                </div>

                                                <template
                                                    v-for="team in $page.props
                                                        .auth.user.all_teams"
                                                    :key="team.id"
                                                >
                                                    <form
                                                        @submit.prevent="
                                                            switchToTeam(team)
                                                        "
                                                    >
                                                        <DropdownLink
                                                            as="button"
                                                        >
                                                            <div
                                                                class="flex items-center"
                                                            >
                                                                <svg
                                                                    v-if="
                                                                        team.id ==
                                                                        $page
                                                                            .props
                                                                            .auth
                                                                            .user
                                                                            .current_team_id
                                                                    "
                                                                    class="me-2 h-5 w-5 text-green-400"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none"
                                                                    viewBox="0 0 24 24"
                                                                    stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                    />
                                                                </svg>

                                                                <div>
                                                                    {{
                                                                        team.name
                                                                    }}
                                                                </div>
                                                            </div>
                                                        </DropdownLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                        >
                                            <img
                                                class="h-8 w-8 rounded-full object-cover"
                                                :src="
                                                    $page.props.auth.user
                                                        .profile_photo_url
                                                "
                                                :alt="
                                                    $page.props.auth.user.name
                                                "
                                            />
                                            <span

                                                class="inline-flex rounded-md"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150"
                                                >
                                                    {{ $page.props.auth.user.name }}

                                                    <svg
                                                        class="ms-2 -me-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </button>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Manage Account
                                        </div>

                                        <DropdownLink
                                            :href="route('profile.show')"
                                        >
                                            Profile
                                        </DropdownLink>

                                        <DropdownLink
                                            v-if="
                                                $page.props.jetstream
                                                    .hasApiFeatures
                                            "
                                            :href="route('api-tokens.index')"
                                        >
                                            API Tokens
                                        </DropdownLink>

                                        <div
                                            class="border-t border-gray-200 dark:border-gray-600"
                                        />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Log Out
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </nav>
                <slot />
            </main>
        </div>
    </div>
</template>
